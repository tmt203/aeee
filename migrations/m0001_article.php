<?php 
use app\core\Application;

class m0001_article {
  public function up() {
    $db = Application::$app->db;
    $SQL = "CREATE TABLE articles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            publisherName VARCHAR(100) NOT NULL, 
            journalTitle VARCHAR(100) NOT NULL,
            issn VARCHAR(9) NOT NULL,
            volume TINYINT NOT NULL,
            pubDate DATE NOT NULL,
            pubStatus VARCHAR(8) NOT NULL,
            articleTitle VARCHAR(100) NOT NULL,
            firstPage SMALLINT NOT NULL,
            lastPage SMALLINT NOT NULL,
            ELocationIDType VARCHAR(3) NOT NULL,
            ELocationIDText VARCHAR(24) NOT NULL,
            language VARCHAR(2) NOT NULL,
            historyReceivedDate DATE,
            historyAcceptedDate DATE,
            historyRevisedDate DATE,
            abstract TEXT,
            status TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;";
    $db->pdo->exec($SQL);
  }

  public function down() {
    $db = Application::$app->db;
    $SQL = "DROP TABLE articles;";
    $db->pdo->exec($SQL);
  }
}
?>