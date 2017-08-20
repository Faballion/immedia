<?php

$postType = $_POST['postType'];

switch ($postType) {
	case "searchLocations":
		$searchTerm = $_POST['search-term'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		
		$curlhandle = curl_init();
		curl_setopt($curlhandle, CURLOPT_URL, "https://api.foursquare.com/v2/venues/search?near=".$searchTerm."&client_id=EM1KDHK2V1ODUOI3JDEWF4VQ3PAFNAIIAIVB4EPHS2JE0CAW&client_secret=2MG0DBYG1YJT2YEUSC0RBBVPHAH23S2F44DEUP1MMPVXXDSQ&v=20170101");
		curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlhandle, CURLOPT_SSL_VERIFYPEER, false);
		
		$response = curl_exec($curlhandle);
		curl_close($curlhandle);
		
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
	default:
        echo "Something went wrong";
}

?>