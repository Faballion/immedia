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
$locationId = '53a6547d498e7d4828890ec8';
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
$conn->close();


//break;

?>