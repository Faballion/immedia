<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immedia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$email = 'faballion@gmail.com';
$password = 'Cybrans77';

$sql = "SELECT UserID FROM Users WHERE Email = '$email' and Password = '$password'";
$result = $conn->query($sql);

$count = mysqli_num_rows($result);

if($count == 1) {
   session_start();
   $_SESSION['email'] = $email;
   echo 1;
}
else {
   echo 0;
}

$conn->close();

//break;

?>