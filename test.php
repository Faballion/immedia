<?php

//Get locations via API
$curlhandle = curl_init();
curl_setopt($curlhandle, CURLOPT_URL, "https://api.foursquare.com/v2/venues/search?near=Durban&client_id=EM1KDHK2V1ODUOI3JDEWF4VQ3PAFNAIIAIVB4EPHS2JE0CAW&client_secret=2MG0DBYG1YJT2YEUSC0RBBVPHAH23S2F44DEUP1MMPVXXDSQ&v=20170101");
curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlhandle, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curlhandle);
curl_close($curlhandle);

//Insert locations into database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immedia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$json_output = json_decode($response);

foreach ($json_output->response->venues as $items) {
	echo "$items->name";
	echo "<br>";
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

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

}

$conn->close();

//break;

?>