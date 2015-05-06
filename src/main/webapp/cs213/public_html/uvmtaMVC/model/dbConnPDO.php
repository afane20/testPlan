<?php 
	
	/*
	 * PDO Connection to the database
	 */
	function getDB() {
		$dsn = 'mysql:host=jordan;dbname=uvmta';
		$username = 'ercanbracks';
		$password = 'scotte';
		$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		
		try {
			$db = new PDO($dsn, $username, $password, $options);
			return $db;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			header('Location: ../login.php?error=3');
		}
	}
	
	/*
	 * Filtering and Sanitizing functions
	 */
	 
	function sanStr($string) {
		$string = filter_var(trim($string), FILTER_SANITIZE_STRING);
		return filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
	}
	
	function valInt($int) {
		$int = filter_var(trim($int), FILTER_SANITIZE_NUMBER_INT);
		
		if (filter_var($int, FILTER_VALIDATE_INT)) {
			return $int;
		} else {
			return false;
		}
	}
	
	function valFloat($float) {
		$float = filter_var(trim($float), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		
		if (filter_var($float, FILTER_VALIDATE_FLOAT)) {
			return $float;
		} else {
			return false;
		}
	}
	
	function valEmail($email) {
		$email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return $email;
		} else {
			return false;
		}
	}
	
	/*
	 * Password encryption functions
	 */
	 
	function encryptPassword($password) {
		$password = sanStr($password);
		$salt = '$5$rounds=24796$'.substr(md5(uniqid(rand(), true)), 0, 16).'$';
		return crypt($password, $salt);
	}
	
	function comparePasswords($password, $encrypted) {
		$password = sanStr($password);
		return crypt($password, $encrypted) == $encrypted;
	}
	
 ?>