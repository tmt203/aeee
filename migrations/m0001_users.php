<?php 
use app\core\Application;

class m0001_users {
  public function up() {
    $db = Application::$app->db;
    $SQL = "CREATE TABLE tbl_users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstName VARCHAR(20) NOT NULL,
            lastName VARCHAR(20) NOT NULL,
            username VARCHAR(20) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;";
    $db->pdo->exec($SQL);
  }

  public function down() {
    $db = Application::$app->db;
    $SQL = "DROP TABLE tbl_users;";
    $db->pdo->exec($SQL);
  }
}
?>