<?php
require("User.php");

class UserRepository {

	private $server;
	private $database;
	private $username;
	private $password;

	function __construct() {
		// MYSQL SERVER CONFIGURATION
    	$config = require("config.php");
	    $this->server = $config["db"]["server"];
	    $this->database = $config["db"]["database"];
	    $this->username = $config["db"]["username"];
	    $this->password = $config["db"]["password"];
	}

	function get($_username) {
	    try {
	      // Create connection
	      $connectionString = "mysql:host={$this->server};dbname={$this->database}";
	      $db = new PDO($connectionString, $this->username, $this->password);

	    	$data = [
			    'username' => $_username,
			];

	      // Execute statement
	      $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
	      $statement->execute($data);

	      // Load 
	      $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
	      $user = $statement->fetch();

	      // Close connection
	      $db = null;

	      // Return result
	      return $user;
	    } catch (PDOException $exception) {
	      echo $exception->getMessage();
	    }
	}

	function save($_username, $_password, $_fullName) {
 		try {
	      // Create connection
	      $connectionString = "mysql:host={$this->server};dbname={$this->database}";
	      $db = new PDO($connectionString, $this->username, $this->password);

	    	$data = [
			    'username' => $_username,
			    'password' => $_password,
			    'fullName' => $_fullName,
			];

	      // Execute statement
	      $statement = $db->prepare("INSERT INTO users (username, password, fullName) VALUES (:username, :password, :fullName)");
	      $statement->execute($data);

	     // Close connection
	      $db = null;

	      // Return result
	      return true;
	    } catch (PDOException $exception) {
	      echo $exception->getMessage();
	    }

	}

	function print() {
		print_r($this->users);
	}

}
