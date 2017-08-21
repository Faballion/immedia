<?php include 'header.php' ?> 

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "immedia";

	$conn = new mysqli($servername, $username, $password, $dbname);
	$loggedEmail = $_SESSION['email'];

	$sql = "SELECT * 
			FROM Locations AS l 
			JOIN Users_Locations AS ul ON l.LocationID = ul.LocationID
			JOIN Users AS u ON u.UserID = ul.UserID
			WHERE u.Email = '".$loggedEmail."'
			ORDER BY l.LocationID DESC";

	$locations = mysqli_query($conn, $sql);
?>

<main class="text-center py-5">
	<br><br><br><br><br>
	<h1>My Locations</h1>
	<div id="my-locations-container">
		<?php	
			if (mysqli_num_rows($locations) > 0) {	
				while($row = $locations->fetch_assoc()) {
					echo '<div class="card location-card col-md-3">';
					echo '<img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%282%29.jpg" alt="Card image cap">';
					echo '<div class="card-body">';
					echo '<h4 class="card-title">' . $row['Name'] . '</h4>';
					echo '<p class="card-text">';
					echo $row['Address'] . ' ' . $row['Phone'] . '<br>' . $row['State'] . ', ' . $row['Country']; 
					echo '</p>';
					echo '<input type="hidden" name="location-id" value="'. $row['APILocationID'] .'">';
					echo '<button class="btn purple darken-3 waves-effect waves-light view-images">View Images</button>';
					echo '</div></div>';
				}
			}
			else {
				echo "You haven't added any locations yet.";
			}
			$conn->close();
		?>
	</div>
</main>

<?php include 'footer.php' ?>