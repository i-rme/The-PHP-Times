<?php

class User {

	public $username;
	private $password;
	public $fullName;

  
	function checkPassword($_password) {
		return ($this->password == $_password);
	}

	function print() {
		return 'This is ' . $this->fullName;
	}

	function getFullName() {
		return $this->fullName;
	}
}
