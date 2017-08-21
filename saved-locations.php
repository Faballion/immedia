<?php include 'header.php' ?> 

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "immedia";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM Locations ORDER BY LocationID DESC";
	$locations = $conn->query($sql);
?>

<main class="text-center py-5">
	<br><br><br><br><br>
	<h1>Saved Locations</h1>
	<div id="saved-locations-container">
		<?php	
			if ($locations->num_rows > 0) {	
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
					echo '<button class="btn purple darken-3 waves-effect waves-light add-my-locations">Add to My Locations</button>';
					echo '</div></div>';
				}
			}
			else {
				echo "There are currently no saved locations";
			}
			$conn->close();
		?>
	</div>
</main>

<?php include 'footer.php' ?>