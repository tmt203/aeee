<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Application;
use stdClass;

class ArticleController extends Controller
{
  private $articles;

  public function __construct()
  {
    $this->articles = json_decode(file_get_contents(Application::$ROOT_DIR . "/public/data/articles.json", FILE_USE_INCLUDE_PATH), true);
  }


  // FE
  public function getAllArticles()
  {
    return array_map(function ($article) {
      return self::createArticleObject($article);
    }, $this->articles);
  }

  public function getArticlesByYear($year)
  {
    $filteredArticles = array_filter($this->articles, function ($article) use ($year) {
      return $article['Journal']['PubDate']['Year'] == $year;
    });

    return array_map(function ($article) {
      return self::createArticleObject($article);
    }, $filteredArticles);
  }

  public function formatDate($pubDate)
  {
    $date = new \DateTime($pubDate);
    return $date->format("l, M j, Y");
  }

  public function sortArticles($sortBy, $asc, $limit, $isStrcmp)
  {
    $tmpArticles = $this->articles;

    if ($isStrcmp == 1) {
      usort($tmpArticles, function ($a, $b) use ($sortBy, $asc) {
        if ($asc == 0) {
          return strcmp($b[$sortBy], $a[$sortBy]);
        }
        return strcmp($a[$sortBy], $b[$sortBy]);
      });
    } else {
      usort($tmpArticles, function ($a, $b) use ($sortBy, $asc) {
        if ($a[$sortBy] == $b[$sortBy]) {
          return 0;
        }
        if ($asc == 0) return ($b[$sortBy] < $a[$sortBy]) ? -1 : 1;
        return ($a[$sortBy] < $b[$sortBy]) ? -1 : 1;
      });
    }

    $tmpArticles = array_slice($tmpArticles, 0, $limit);

    return array_map(function ($article) {
      return self::createArticleObject($article);
    }, $tmpArticles);
  }

  public function getRandomArticles()
  {
    $randomKeys = array_rand($this->articles, 10);
    $randomArticles = array_map(function ($key) {
      $article = $this->articles[$key];

      return self::createArticleObject($article);
    }, $randomKeys);

    return $randomArticles;
  }

  function increaseArticleViews()
  {
    $articleId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $this->articles[$articleId - 1]['views'] = $this->articles[$articleId - 1]['views'] + 1;
    file_put_contents(Application::$ROOT_DIR . "/public/data/articles.json", json_encode($this->articles));
  }

  public function getCurrentIssues()
  {
    $volume = 21;
    $issue = 3;
    $date = '2023';

    $rs = array_reduce($this->articles, function ($carry, $article) use ($volume, $issue, $date) {
      $formattedDate = $article['Journal']['PubDate']['Year'] . '-' . $article['Journal']['PubDate']['Month'] . '-' . $article['Journal']['PubDate']['Day'];
      if (
        (is_null($volume) || $volume === (int)$article['Journal']['Volume']) &&
        (is_null($issue) || $issue === (int)$article['Journal']['Issue']) &&
        (is_null($date) || str_contains($formattedDate, $date))
      ) {
        $carry[] = self::createArticleObject($article);
      }

      return $carry;
    }, []);

    return $rs;
  }

  // API
  public function getArticlesByVolumeAndIssueAndDate()
  {
    $volume = isset($_POST['volume']) ? (int)$_POST['volume'] : null;
    $issue = isset($_POST['issue']) ? (int)$_POST['issue'] : null;
    $date = isset($_POST['date']) ? $_POST['date'] : null;

    $rs = array_reduce($this->articles, function ($carry, $article) use ($volume, $issue, $date) {
      $formattedDate = $article['Journal']['PubDate']['Year'] . '-' . $article['Journal']['PubDate']['Month'] . '-' . $article['Journal']['PubDate']['Day'];
      if (
        (is_null($volume) || $volume == (int)$article['Journal']['Volume']) &&
        (is_null($issue) || $issue == (int)$article['Journal']['Issue']) &&
        (is_null($date) || str_contains($formattedDate, $date))
      ) {
        $carry[] = self::createArticleObject($article);
      }

      return $carry;
    }, []);

    echo json_encode($rs);
  }

  public function filterArticles()
  {
    $tmpArticles = $this->articles;
    // HTTP Request
    $sortBy = $_POST['sortBy'] ?? 'ArticleTitle';
    $show = $_POST['show'] ?? 10;
    $arrange = $_POST['arrange'] ?? 1;

    usort($tmpArticles, function ($a, $b) use ($sortBy, $arrange) {
      if ($arrange == 0) {
        return strcmp($b[$sortBy], $a[$sortBy]);
      }
      return strcmp($a[$sortBy], $b[$sortBy]);
    });

    $rs = array_map(function ($article) {
      return self::createArticleObject($article);
    }, $tmpArticles);

    echo json_encode(array_slice($rs, 0, $show));
  }

  public function searchAndFilterArticles()
  {
    $content = $_POST['content'] ?? null;
    $searchBy = $_POST['searchBy'] ?? null;
    $pastYear = $_POST['pastYear'] ?? null;

    if ($searchBy && $content) {
      $tmpArticles = self::searchArticles($searchBy, $content);     
    }

    if ($pastYear) {
      $pastYear = date("Y") - $pastYear + 1;
      $tmpArticles = $tmpArticles ?? $this->articles;

      $tmpArticles = array_reduce($tmpArticles, function ($carry, $article) use ($pastYear) {
        if ($article['Journal']['PubDate']['Year'] >= $pastYear) {
          $carry[] = $article;
        }
        return $carry;
      }, []);
    }

    if ($tmpArticles) {
      $tmpArticles = array_reduce($tmpArticles, function ($carry, $article) {
        $carry[] = self::createArticleObject($article);
        return $carry;
      }, []);

      echo json_encode($tmpArticles);
      exit;
    }
    echo json_encode("Not found articles");
    exit;
  }

  // Helper functions
  private function searchArticles($searchBy, $content)
  {
    if ($searchBy === 'DOI') {
      $rs = array_reduce($this->articles, function ($carry, $article) use ($content) {
        if (strstr($article['ELocationID']['__text'], $content)) {
          $carry[] = $article;
        }
        return $carry;
      }, []);

      return $rs;
    }

    if ($searchBy === 'AuthorName') {
      $rs = array_reduce($this->articles, function ($carry, $article) use ($content) {
        if (preg_match("/$content/i", self::getAuthors($article['AuthorList']['Author']))) {
          $carry[] = $article;
        }
        return $carry;
      }, []);

      return $rs;
    }

    $rs = array_reduce($this->articles, function ($carry, $article) use ($content, $searchBy) {
      if (strstr($article[$searchBy], $content) || preg_match("/$content/i", $article[$searchBy])) {
        $carry[] = $article;
      }
      return $carry;
    }, []);

    return $rs;
  }

  private function getFilePath($root, $year, $volume, $issue, $title)
  {
    $title = str_replace(':', '', $title);
    $title = str_replace('/', '-', $title);
    $title = strtolower($title);
    $path = realpath($root . '/public/data/articles/' . $year . '/Vol ' . $volume . ', No ' . $issue);

    if (file_exists($path)) {
      foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)) as $filename) {
        if (basename($filename)[0] == '.') continue;
        $tmp = strtolower(basename($filename));
        $candidateTitle = substr($tmp, 0, strpos($tmp, ".pdf"));

        // str_replace($root . '\public', '', $filename);
        if (strcmp($title, $candidateTitle) == 0 || str_contains($title, $candidateTitle)) return str_replace($root . DIRECTORY_SEPARATOR . 'public', '', $filename);
      }
    }

    return '';
  }

  private function getAuthors($authors)
  {
    // Check if the first element is an array or an object
    $firstElement = reset($authors);
    $isAssociativeArray = is_array($firstElement) && array_keys($firstElement) !== range(0, count($firstElement) - 1);

    if ($isAssociativeArray) {
      // Handle associative arrays (objects)
      return implode(", ", array_map(function ($author) {
        return $author['FirstName'] . " " . $author['MiddleName'] . " " . $author['LastName'];
      }, $authors));
    } else {
      return $authors['FirstName'] . " " . $authors['MiddleName'] . " " . $authors['LastName'];
    }
  }

  private function createArticleObject($article)
  {
    $obj = new stdClass;
    $obj->id = $article['id'];
    $obj->views = $article['views'];
    $obj->title = ucwords(strtolower($article['ArticleTitle']));
    $obj->author = self::getAuthors($article['AuthorList']['Author']);
    $obj->path = self::getFilePath(Application::$ROOT_DIR, $article['Journal']['PubDate']['Year'], $article['Journal']['Volume'], $article['Journal']['Issue'], $article['ArticleTitle']);
    $obj->doi = $article['ELocationID']['__text'];
    $obj->firstPage = $article['FirstPage'];
    $obj->lastPage = $article['LastPage'];
    $obj->volume = $article['Journal']['Volume'];
    $obj->issue = $article['Journal']['Issue'];
    $obj->pubDate = $article['Journal']['PubDate']['Day'] . '-' . $article['Journal']['PubDate']['Month'] . '-' . $article['Journal']['PubDate']['Year'];
    $obj->restrictTo = isset($article['restrictTo']) ? $article['restrictTo'] : [];
    return $obj;
  }
}
