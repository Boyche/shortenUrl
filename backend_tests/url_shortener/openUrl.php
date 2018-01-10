<?php

	
	if(isset($_GET['shortUrl'])){//if valid data is send with GET reaquest
	
		$url = $_GET['shortUrl']; //put data to variable $url
		
		require_once('functions.php'); //import functions
		
		$conn = connectToDatabase(); //connecting to database.
		
		//preparing query that will find real url hidding behind short url.
		$stmt = $conn->prepare('SELECT * FROM `requests` WHERE SHORTURL = ? ');
		
		//this way we protect us from any sql injection
		if(!$stmt->bind_param('s', $url)){ //if there is any error it will be displayed with 404 respond
			header("404 Not Found", true, 404);
			die( 'Error in query: '.$conn->error);
		}
		
		//we execute query
		if(!$stmt->execute()){  //if there is any error it will be displayed with 404 respond
			header("404 Not Found", true, 404);
			die( 'Error in query: '.$conn->error);
		}
		

		$result = $stmt->get_result();//we take result table.
		if ($row = $result->fetch_assoc()) { //fetching first row from table into associative array
			// with htmlentities we prevent any kind of cross site scripting attack.
			header("Location: ".htmlentities($row['FULLURL']),TRUE,301);
		}else{
			//if there is no shorten link, we return 404 not found
			header("404 Not Found", TRUE, 404);
		}
	}

?> 

