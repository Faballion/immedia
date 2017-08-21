<?php
session_start();
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
		if(strlen($searchTerm) > 0) {
			curl_setopt($curlhandle, CURLOPT_URL, "https://api.foursquare.com/v2/venues/search?near=".urlencode($searchTerm)."&client_id=EM1KDHK2V1ODUOI3JDEWF4VQ3PAFNAIIAIVB4EPHS2JE0CAW&client_secret=2MG0DBYG1YJT2YEUSC0RBBVPHAH23S2F44DEUP1MMPVXXDSQ&v=20170101");
		}
		else {
			curl_setopt($curlhandle, CURLOPT_URL, "https://api.foursquare.com/v2/venues/search?ll=".urlencode($latitude).",".urlencode($longitude)."&client_id=EM1KDHK2V1ODUOI3JDEWF4VQ3PAFNAIIAIVB4EPHS2JE0CAW&client_secret=2MG0DBYG1YJT2YEUSC0RBBVPHAH23S2F44DEUP1MMPVXXDSQ&v=20170101");
		}
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
		   $_SESSION["email"] = $email;
		   echo 1;
		}
		else {
		   echo 0;
		}
		
		$conn->close();
		break;

	case "saveMyImages":
		$locationId = $_POST['locationId'];
		$loggedEmail = $_SESSION['email'];
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT UserID FROM Users WHERE Email = '$loggedEmail'";
		$result = $conn->query($sql);
		$sql2 = "SELECT LocationID FROM Locations WHERE APILocationID = '$locationId'";
		$result2 = $conn->query($sql2);
		
		$sql3 = "INSERT IGNORE INTO Users_Locations (
					UserID
				  , LocationID
				)
				VALUES (
					{$result->fetch_array()['UserID']}
				  , {$result2->fetch_array()['LocationID']}
				) 
				/*WHERE NOT EXISTS (SELECT UserID, LocationID 
								  FROM Users_Locations 
								  WHERE UserID = {$result->fetch_array()['UserID']} 
								  AND LocationID = {$result2->fetch_array()['LocationID']}
								 )*/;";		
		$result3 = $conn->query($sql3);
		
		if($result3) {
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