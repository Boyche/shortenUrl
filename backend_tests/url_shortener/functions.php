<?php

	function connectToDatabase(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "urlshortener";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $database);

		// Check connection
		if ($conn->connect_error) {
			//die("Connection failed: " . $conn->connect_error);
		} 
		else return  $conn;
	}

	/**
		Function that will create and return random created string of length 10 made of letters and digits.
	*/
	function makeShortUrl(){
		
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//string of avaliable chars
		$allCharsLen = strlen($chars);//length of string
		$str = ''; //resulting string.
		for ($i = 0; $i < 10; $i++) { //10 times
			$str .= $chars[rand(0, $allCharsLen)];//gets random char from avaliable chars, and append it to the string.
		}
		return $str;//returns radnom string.
	}
	
	//function returns hash value made from given $url using adler32 hash algorithm. it should be 8 chars long string.
	function makeShortUrlHash($url){
		return hash('adler32', $url);
	}
	
?>