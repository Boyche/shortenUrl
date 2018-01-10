 <?php
	
	if(isset($_POST['url'])){//if valid data is send with POST reaquest
	
		$url = $_POST['url']; //put that data to $url variable
		
		require_once('functions.php'); //import function.php
		
		$conn = connectToDatabase(); //connecting to database
		
		
		/*
		//repeating of creation of random string untill its not unique
		while(true){
			$shortUrl = makeShortUrl(); //make short url calling random function 
						
			//check if it exists in database
			$stmt = $conn->prepare('SELECT * FROM requests WHERE SHORTURL = ?');
			$stmt->bind_param('s', $shortUrl); // 's' specifies the variable type => 'string'

			$stmt->execute();

			$result = $stmt->get_result();
			//it it does not exists, leave loop.
			if($result->num_rows == 0){
				break;
			}
		}
		*/
		
		
		//But I would choose hashing algorithm, making hash from given url.
		
		$shortUrl = makeShortUrlHash($url);//make short url calling hash function with adler32 algorithm, it gives 8 chars long hash string.
			
		//first we check if we have that input in database
		$stmt = $conn->prepare('SELECT * FROM requests WHERE SHORTURL = ? AND FULLURL = ? ');
		$stmt->bind_param('ss', $shortUrl, $url); // 's' specifies the variable type => 'string'

		$stmt->execute();

		$result = $stmt->get_result();
		
		//if there is one, finish this.
		if($row = $result->fetch_assoc()){
			$obj = new stdClass();
			$obj->original_link = $url;
			$obj->short_link = $shortUrl;
			
			header("200 OK", true, 200);//return header
			die(json_encode($obj));//endcode it to json format from object
		}

		//if there is not the same entry
		//we have make sure that we avoid collision, although its low chanse.	
		while(true){
			//check if collision exists in database
			$stmt = $conn->prepare('SELECT * FROM requests WHERE SHORTURL = ? AND FULLURL <> ? ');
			$stmt->bind_param('ss', $shortUrl, $url); // 's' specifies the variable type => 'string'

			$stmt->execute();

			$result = $stmt->get_result();
			//it it does not exists, leave loop.
			if($result->num_rows == 0){
				break;
			}else{
				//if it exists add random number to short url [0,9] and try again.
				$shortUrl .= rand(0, 10);
			}
		}
		
		
		
		//add a row into database. 
		$stmt = $conn->prepare('INSERT INTO `requests`(`FULLURL`, `SHORTURL`) VALUES (?, ?)');
		$stmt->bind_param('ss', $url, $shortUrl);

		$stmt->execute();

		//creating object of standard Class and adding attributes to it
		$obj = new stdClass();
		$obj->original_link = $url;
		$obj->short_link = $shortUrl;
		
		header("200 OK", true, 200);//return header
		die(json_encode($obj));//endcode it to json format from object
	}

?>