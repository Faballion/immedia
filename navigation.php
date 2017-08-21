<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">

	<a class="navbar-brand" href="index.php">
		<img id="immedia-logo" src="img/immedia.png" alt="immedia logo">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">

		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="saved-locations.php">Saved Locations</a>
			</li>
			<?php session_start();
			if (isset($_SESSION['email'])) {
				echo '<li class="nav-item">';
				echo '	<a class="nav-link" href="my-locations.php">My Locations</a>';
				echo '</li>';
			}
			?>
		</ul>

		<ul class="navbar-nav ml-auto nav-flex-icons">
			<li class="nav-item">
				<a class="nav-link" href="https://www.linkedin.com/in/daniel-pearson-25046010b/" target="_blank" title="My Linkedin Profile"><i class="fa fa-linkedin"></i></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="https://github.com/Faballion" target="_blank" title="My Github Profile"><i class="fa fa-github"></i></a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> 
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-unique" aria-labelledby="navbarDropdownMenuLink">
					<?php 
					if (isset($_SESSION['email'])) {
						echo '<a class="dropdown-item" href="logout.php">Logout</a>';
					}
					else {
						echo '<a class="dropdown-item" href="login.php">Login</a>';
						echo '<a class="dropdown-item" href="register.php">Register</a>';
					}
					?>					
				</div>
			</li>
		</ul>
		
	</div>

</nav>