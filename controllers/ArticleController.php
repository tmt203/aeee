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
        if ($asc == 0)
          return ($b[$sortBy] < $a[$sortBy]) ? -1 : 1;
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
    $postId = (int) filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    foreach ($this->articles as $key => $article) {
      $articleId = (int) end(explode(".", $article['ELocationID']['__text']));

      if ($articleId === $postId) {
        // increase views
        $this->articles[$key]['views']++;
        break;
      }
    }

    // write file
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
        (is_null($volume) || $volume === (int) $article['Journal']['Volume']) &&
        (is_null($issue) || $issue === (int) $article['Journal']['Issue']) &&
        (is_null($date) || str_contains($formattedDate, $date))
      ) {
        $carry[] = self::createArticleObject($article);
      }

      return $carry;
    }, []);

    return $rs;
  }

  public function getArticleById($id)
  {
    // Get article info
    foreach ($this->articles as $article) {
      $articleId = end(explode(".", $article['ELocationID']['__text']));

      if ($articleId === $id) {
        return self::getFilePath(Application::$ROOT_DIR, $article['Journal']['PubDate']['Year'], $article['Journal']['Volume'], $article['Journal']['Issue'], $article['ArticleTitle']);
      }
    }

    return null;
  }

  // API
  public function getArticlesByVolumeAndIssueAndDate()
  {
    $volume = isset($_POST['volume']) ? (int) $_POST['volume'] : null;
    $issue = isset($_POST['issue']) ? (int) $_POST['issue'] : null;
    $date = isset($_POST['date']) ? $_POST['date'] : null;

    $rs = array_reduce($this->articles, function ($carry, $article) use ($volume, $issue, $date) {
      $formattedDate = $article['Journal']['PubDate']['Year'] . '-' . $article['Journal']['PubDate']['Month'] . '-' . $article['Journal']['PubDate']['Day'];
      if (
        (is_null($volume) || $volume == (int) $article['Journal']['Volume']) &&
        (is_null($issue) || $issue == (int) $article['Journal']['Issue']) &&
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

  public function extractMetadataByVolumeAndIssue()
  {
    $volume = $_POST['volume'];
    $issue = $_POST['issue'];

    $volume = isset($_POST['volume']) ? (int) $_POST['volume'] : null;
    $issue = isset($_POST['issue']) ? (int) $_POST['issue'] : null;

    $filteredArticles = array_reduce($this->articles, function ($carry, $article) use ($volume, $issue) {
      if (
        (is_null($volume) || $volume == (int) $article['Journal']['Volume']) &&
        (is_null($issue) || $issue == (int) $article['Journal']['Issue'])
      ) {
        $carry[] = self::createMetadataObject($article);
      }

      return $carry;
    }, []);

    $formattedTimestamp = date("U", time());

    $output = [
      "doi_batch" => [
        "head" => [
          "doi_batch_id" => "AEEE_" . $formattedTimestamp,
          "timestamp" => $formattedTimestamp,
          "depositor" => [
            "name" => "Lam-Thanh Tu",
            "email_address" => "tulamthanh@tdtu.edu.vn",
          ],
          "registrant" => "Faculty of Electrical Engineering and Computer Science",
        ],
        "body" => [
          "journal" => $filteredArticles,
        ],
      ],
    ];

    echo json_encode($output, JSON_PRETTY_PRINT);
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
        if (basename($filename)[0] == '.')
          continue;
        $tmp = strtolower(basename($filename));
        $candidateTitle = substr($tmp, 0, strpos($tmp, ".pdf"));

        // str_replace($root . '\public', '', $filename);
        if (strcmp($title, $candidateTitle) == 0 || str_contains($title, $candidateTitle))
          return str_replace($root . DIRECTORY_SEPARATOR . 'public', '', $filename);
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

  private function getMetadataAuthors($authors)
  {
    // Check if the first element is an array or an object
    $firstElement = reset($authors);
    $isAssociativeArray = is_array($firstElement) && array_keys($firstElement) !== range(0, count($firstElement) - 1);

    if ($isAssociativeArray) {
      // Handle associative arrays (objects)
      return array_map(function ($author) {
        return array(
          "given_name" => $author['FirstName'],
          "surname" => $author['LastName']
        );
      }, $authors);
    } else {
      return array(
        "given_name" => $authors['FirstName'],
        "surname" => $authors['LastName']
      );
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

  private function createMetadataObject($article)
  {
    $outputArray = [
      "journal_metadata" => [
        "full_title" => $article["Journal"]["JournalTitle"],
        "abbrev_title" => "AEEE",
        "issn" => ["1804-3119", $article["Journal"]["Issn"]],
      ],
      "journal_issue" => [
        "publication_date" => [
          "month" => intval($article["Journal"]["PubDate"]["Month"]),
          "day" => intval($article["Journal"]["PubDate"]["Day"]),
          "year" => intval($article["Journal"]["PubDate"]["Year"]),
        ],
        "journal_volume" => [
          "volume" => intval($article["Journal"]["Volume"]),
        ],
        "issue" => intval($article["Journal"]["Issue"]),
      ],
      "journal_article" => [
        "titles" => [
          "title" => $article["ArticleTitle"],
        ],
        "contributors" => [
          "person_name" => self::getMetadataAuthors($article['AuthorList']['Author']),
        ],
        "publication_date" => [
          "month" => intval($article["Journal"]["PubDate"]["Month"]),
          "day" => intval($article["Journal"]["PubDate"]["Day"]),
          "year" => intval($article["Journal"]["PubDate"]["Year"]),
        ],
        "publisher_item" => [
          "item_number" => $article["FirstPage"] . "-" . $article["LastPage"],
        ],
        "doi_data" => [
          "doi" => $article["ELocationID"]["__text"],
          "resource" => "http://advances.utc.sk/index.php/AEEE/article/view/" . end(explode(".", $article["ELocationID"]["__text"])),
        ],
      ],
    ];

    return $outputArray;
  }

  private function arrayToXML($data, $xml)
  {
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $subnode = $xml->addChild($key);
        self::arrayToXML($value, $subnode);
      } else {
        $xml->addChild($key, htmlspecialchars($value));
      }
    }

    return $xml;
  }

  private function convertToXML($data)
  {
    $xml = new \SimpleXMLElement('<doi_batch xmlns="http://www.crossref.org/schema/4.3.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="4.3.0" xsi:schemaLocation="http://www.crossref.org/schema/4.3.0 http://www.crossref.org/schema/4.3.0/crossref4.3.0.xsd"></doi_batch>');

    // Get the modified XML object
    $metadata = self::arrayToXML($data, $xml);
    echo $metadata->saveXML();
  }
}
