<?php

$errors = array();
$form_data = array();

/* Validate the form on the server side */
/*if (empty($_POST['name'])) { //Name cannot be empty
    $errors['name'] = 'Name cannot be blank';
}*/

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


/*if (!empty($errors)) { //If errors in validation
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
}
else { //If not, process the form, and return true on success
    $form_data['success'] = true;
    $form_data['posted'] = 'Data Was Posted Successfully';
}

//Return the data back to form.php
echo json_encode($form_data);*/
?>