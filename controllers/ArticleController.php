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

  public function sortArticles($sortBy, $asc, $limit)
  {
    $tmpArticles = $this->articles;
    usort($tmpArticles, function ($a, $b) use ($sortBy, $asc) {
      if ($asc == 0) {
        return strcmp($b[$sortBy], $a[$sortBy]);
      }
      return strcmp($a[$sortBy], $b[$sortBy]);
    });

    array_slice($tmpArticles, 0, $limit);

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

  public function getArticlesByVolumeAndIssueAndDate()
  {
    $volume = isset($_POST['volume']) ? (int)$_POST['volume'] : null;
    $issue = isset($_POST['issue']) ? (int)$_POST['issue'] : null;
    $date = isset($_POST['date']) ? $_POST['date'] : null;

    $tmpArticles = $this->articles;

    $rs = array_reduce($tmpArticles, function ($carry, $article) use ($volume, $issue, $date) {
      $formattedDate = $article['Journal']['PubDate']['Year'] . '-' . $article['Journal']['PubDate']['Month'] . '-' . $article['Journal']['PubDate']['Day'];
      if (
        (is_null($volume) || $volume === (int)$article['Journal']['Volume']) &&
        (is_null($issue) || $issue === (int)$article['Journal']['Issue']) &&
        (is_null($date) || $date === $formattedDate)
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

  public function search()
  {
    $tmpArticles = $this->articles;
    $content = $_POST['content'] ?? null;

    $rs = array_reduce($tmpArticles, function ($carry, $article) use ($content) {
      if (preg_match("/$content/i", $article['ArticleTitle'])) {
        $carry[] = self::createArticleObject($article);
      }
      return $carry;
    }, []);

    echo json_encode($rs);
  }


  function getAuthors($authors)
  {
    // Check if the first element is an array or an object
    $firstElement = reset($authors);
    $isAssociativeArray = is_array($firstElement) && array_keys($firstElement) !== range(0, count($firstElement) - 1);

    if ($isAssociativeArray) {
      // Handle associative arrays (objects)
      return implode(", ", array_map(function ($author) {
        return $author['FirstName'] . " " . $author['LastName'];
      }, $authors));
    } else {
      return $authors['FirstName'] . " " . $authors['LastName'];
    }
  }

  function getFilePath($root, $year, $volume, $issue, $title)
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

        if (strcmp($title, $candidateTitle) == 0 || str_contains($title, $candidateTitle)) return str_replace($root . '\public', '', $filename);
      }
    }

    return '';
  }

  // Helper function to create an article object
  private function createArticleObject($article)
  {
    $obj = new stdClass;
    $obj->title = $article['ArticleTitle'];
    $obj->author = self::getAuthors($article['AuthorList']['Author']);
    $obj->path = self::getFilePath(Application::$ROOT_DIR, $article['Journal']['PubDate']['Year'], $article['Journal']['Volume'], $article['Journal']['Issue'], $article['ArticleTitle']);
    $obj->doi = $article['ELocationID']['__text'];
    $obj->firstPage = $article['FirstPage'];
    $obj->lastPage = $article['LastPage'];
    $obj->volume = $article['Journal']['Volume'];
    $obj->issue = $article['Journal']['Issue'];
    $obj->pubDate = $article['Journal']['PubDate']['Day'] . '-' . $article['Journal']['PubDate']['Month'] . '-' . $article['Journal']['PubDate']['Year'];
    return $obj;
  }
}
