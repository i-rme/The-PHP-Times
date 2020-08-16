<?php
require_once("News.php");

class NewsRepository
{
  public function getAll() {
    // Read configuration
    $config = require("config.php");
    $server = $config["db"]["server"];
    $database = $config["db"]["database"];
    $username = $config["db"]["username"];
    $password = $config["db"]["password"];

    try {
      // Create connection
      $connectionString = "mysql:host=$server;dbname=$database";
      $db = new PDO($connectionString, $username, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Execute statement
      $statement = $db->prepare("SELECT * FROM news");
      $statement->execute();

      // Load news in array
      $news = $statement->fetchAll(PDO::FETCH_CLASS, "News");

      // Close connection
      $db = null;

      // Return result
      return $news;
    } catch (PDOException $exception) {
      echo $exception->getMessage();
    }
  }

    public function getCategory($category) {
    // Read configuration
    $config = require("config.php");
    $server = $config["db"]["server"];
    $database = $config["db"]["database"];
    $username = $config["db"]["username"];
    $password = $config["db"]["password"];

    try {
      // Create connection
      $connectionString = "mysql:host=$server;dbname=$database";
      $db = new PDO($connectionString, $username, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Execute statement
      $statement = $db->prepare("SELECT * FROM news WHERE category = :category");
      $statement->execute([ ":category" => $category ]);

      // Load news in array
      $news = $statement->fetchAll(PDO::FETCH_CLASS, "News");

      // Close connection
      $db = null;

      // Return result
      return $news;
    } catch (PDOException $exception) {
      echo $exception->getMessage();
    }
  }

  public function get($id) {
    // Read configuration
    $config = require("config.php");
    $server = $config["db"]["server"];
    $database = $config["db"]["database"];
    $username = $config["db"]["username"];
    $password = $config["db"]["password"];

    try {
      // Create connection
      $connectionString = "mysql:host=$server;dbname=$database";
      $db = new PDO($connectionString, $username, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      // Execute statement
      $statement = $db->prepare("SELECT * FROM news WHERE id = :id");
      $statement->execute([ ":id" => $id ]);

      // Get newspiece
      $newspiece = $statement->fetchObject("News");

      // Close connection
      $db = null;

      // Return result
      return $newspiece;
    } catch (PDOException $exception) {
      echo $exception->getMessage();
    }
  }


  public function update($updatedNews) {
    // Read configuration
    $config = require("config.php");
    $server = $config["db"]["server"];
    $database = $config["db"]["database"];
    $username = $config["db"]["username"];
    $password = $config["db"]["password"];

    try {
      // Create connection
      $connectionString = "mysql:host=$server;dbname=$database";
      $db = new PDO($connectionString, $username, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      // Execute statement
      $statement = $db->prepare("REPLACE INTO news (id,title,summary,text,picture,category)
VALUES (:id, :title, :summary, :text, :picture, :category)");
      $statement->execute([ ":id" => $updatedNews['id'], ":title" => $updatedNews['title'], ":summary" => $updatedNews['summary'], ":text" => $updatedNews['text'], ":picture" => $updatedNews['picture'], ":category" => $updatedNews['category'] ]);

      // Close connection
      $db = null;

      // Return result
      return true;
    } catch (PDOException $exception) {
      echo $exception->getMessage();
    }
  }

public function getNewId() {
    // Read configuration
    $config = require("config.php");
    $server = $config["db"]["server"];
    $database = $config["db"]["database"];
    $username = $config["db"]["username"];
    $password = $config["db"]["password"];

    try {
      // Create connection
      $connectionString = "mysql:host=$server;dbname=$database";
      $db = new PDO($connectionString, $username, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      // Execute statement
      $statement = $db->prepare("SELECT MAX(id) FROM news");
      $statement->execute();

      // Get newspiece
      $result = $statement->fetch();

      // Close connection
      $db = null;

      // Return result
      return $result[0]+1;
    } catch (PDOException $exception) {
      echo $exception->getMessage();
    }
  }

public function getCategories() {
    // Read configuration
    $config = require("config.php");
    $server = $config["db"]["server"];
    $database = $config["db"]["database"];
    $username = $config["db"]["username"];
    $password = $config["db"]["password"];

    try {
      // Create connection
      $connectionString = "mysql:host=$server;dbname=$database";
      $db = new PDO($connectionString, $username, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      // Execute statement
      $statement = $db->prepare("SELECT DISTINCT category FROM news WHERE 1 ORDER BY category");
      $statement->execute();

      // Get newspiece
      $result = $statement->fetchAll();

      // Close connection
      $db = null;

      // Return result
      return $result;
    } catch (PDOException $exception) {
      echo $exception->getMessage();
    }
  }

    public function delete($id) {
    // Read configuration
    $config = require("config.php");
    $server = $config["db"]["server"];
    $database = $config["db"]["database"];
    $username = $config["db"]["username"];
    $password = $config["db"]["password"];

    try {
      // Create connection
      $connectionString = "mysql:host=$server;dbname=$database";
      $db = new PDO($connectionString, $username, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      // Execute statement
      $statement = $db->prepare("DELETE FROM news WHERE id = :id");
      $statement->execute([ ":id" => $id ]);

      // Get newspiece
      $newspiece = $statement->fetch();

      // Close connection
      $db = null;

      // Return result
      return true;
    } catch (PDOException $exception) {
      echo $exception->getMessage();
    }
  }

}
