<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immedia";

$postType = $_POST['postType'];

switch ($postType) {

	case "searchLocations":
		$searchTerm = $_POST['search-term'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		
		//Get locations via API
		$curlhandle = curl_init();
		curl_setopt($curlhandle, CURLOPT_URL, "https://api.foursquare.com/v2/venues/search?near=".$searchTerm."&client_id=EM1KDHK2V1ODUOI3JDEWF4VQ3PAFNAIIAIVB4EPHS2JE0CAW&client_secret=2MG0DBYG1YJT2YEUSC0RBBVPHAH23S2F44DEUP1MMPVXXDSQ&v=20170101");
		curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlhandle, CURLOPT_SSL_VERIFYPEER, false);
		
		$response = curl_exec($curlhandle);
		curl_close($curlhandle);

		//Insert locations into database
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$json_output = json_decode($response);

		foreach ($json_output->response->venues as $items) {
			if(isset($items->location->address)) {
				$insertAddress = $items->location->address;
			}
			else {
				$insertAddress = NULL;
			}

			if(isset($items->contact->phone)) {
				$insertPhone = $items->contact->phone;
			}
			else {
				$insertPhone = NULL;
			}

			if(isset($items->location->state)) {
				$insertState = $items->location->state;
			}
			else {
				$insertState = NULL;
			}

			if(isset($items->location->country)) {
				$insertCountry = $items->location->country;
			}
			else {
				$insertCountry = NULL;
			}

			$sql = "INSERT INTO Locations (
					  APILocationID
					, Name
					, Address
					, Phone
					, State
					, Country
					)
					VALUES (
					  '{$items->id}'
					, '{$items->name}'
					, '{$insertAddress}'
					, '{$insertPhone}'
					, '{$insertState}'
					, '{$insertCountry}'
					);";

			$conn->query($sql);
		}	

		$conn->close();
		echo ($response);
		break;

	case "fetchImages":
		$locationId = $_POST['locationId'];
		
		$curlhandle = curl_init();
		curl_setopt($curlhandle, CURLOPT_URL, "https://api.foursquare.com/v2/venues/".$locationId."/photos?near=Durban&client_id=EM1KDHK2V1ODUOI3JDEWF4VQ3PAFNAIIAIVB4EPHS2JE0CAW&client_secret=2MG0DBYG1YJT2YEUSC0RBBVPHAH23S2F44DEUP1MMPVXXDSQ&v=20170101");
		curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlhandle, CURLOPT_SSL_VERIFYPEER, false);
		
		$response = curl_exec($curlhandle);
		curl_close($curlhandle);
		
		echo ($response);	
		break;

	case "registerUser":
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$email = $_POST['register-email'];
		$password = $_POST['register-password'];
		
		$sql = "INSERT INTO Users (
					Email
				  , Password
			    )
				VALUES (
					'{$email}'
				  , '{$password}'
			    );";

		if ($conn->query($sql) === TRUE) {
			echo 1;
		} 
		else {
			echo 0;
		}
		$conn->close();
		break;

	case "loginUser":

		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$email = $_POST['login-email'];
		$password = $_POST['login-password'];

		$sql = "SELECT UserID FROM Users WHERE Email = '$email' and Password = '$password'";
		$result = $conn->query($sql);
		
		$count = mysqli_num_rows($result);
		
		if($count == 1) {
		   session_start();
		   $_SESSION["email"] = $email;
		   echo 1;
		}
		else {
		   echo 0;
		}
		
		$conn->close();
		break;

	default:
        echo "Something went wrong.";
}

?>