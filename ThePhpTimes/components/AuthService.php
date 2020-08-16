<?php
require("UserRepository.php");

// MYSQL SERVER CONFIGURATION IS LOCATED IN Config.php

class AuthService {

	public $userRepository;

	function __construct() {
		$this->userRepository = new UserRepository();
	}
   
	function signin($_username, $_password) {
		$response = $this->userRepository->get($_username);

		if($response!=NULL){
			$user = $response;
			return $user->checkPassword($_password);
		}else{
			return false;
		}

	}

	function signup($_username, $_password, $_fullName) {

		$response = $this->userRepository->save($_username, $_password, $_fullName);

		return $response;

	}

	function getFullName($_username) {

		$user = $this->userRepository->get($_username);

		if($user!=NULL){
			return $user->getFullName($_username);
		}else{
			return false;
		}

	}

}