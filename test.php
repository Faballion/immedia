<?php session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immedia";

/*$locationId = '50ca9985e4b0e6c82f71e393';
$loggedEmail = $_SESSION['email'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT UserID FROM Users WHERE Email = '$loggedEmail'";
$result = $conn->query($sql);
$sql2 = "SELECT LocationID FROM Locations WHERE APILocationID = '$locationId'";
$result2 = $conn->query($sql2);

$sql3 = "INSERT INTO Users_Locations (
            UserID
          , LocationID
        )
        VALUES (
            {$result->fetch_array()['UserID']}
          , {$result2->fetch_array()['LocationID']}
        );";

$result3 = $conn->query($sql3);
$conn->close();*/

$conn = new mysqli($servername, $username, $password, $dbname);
$loggedEmail = $_SESSION['email'];

	$sql = "SELECT * 
			FROM Locations AS l 
			JOIN Users_Locations AS ul ON l.LocationID = ul.LocationID
			JOIN Users AS u ON u.UserID = ul.UserID
			WHERE u.Email = '".$loggedEmail."'
			ORDER BY l.LocationID DESC";
    $locations = mysqli_query($conn, $sql);


    $count = mysqli_num_rows($locations);
    
    if($count == 1) {
       echo 1;
    }
    else {
       echo 0;
    }
    
    $conn->close();


//break;

?>