<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">

		<link rel="stylesheet" type="text/css" href="style/style.css">
	</head>
	<title><?= $title ?></title>
	<body>
		<div class="container">
			<div class="header">
				<div class="error">
					<?= @$error ?>
				</div>
			</div>

			<div class="menu">
				<ul>
					<li><a href="home.php">Home</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="producten.php">Producten</a></li>
					<li><a href="cart.php">Winkelwagen</a></li>
					<?php
					if(isset($_SESSION['username'])){
						echo'<li><a href="users.php">Mijn Account</a></li>
							<li><a href="logout.php">Uitloggen</a></li>';
					}else{
						echo '<li><a href="login.php">Inloggen</a></li>';
					}
					?>
					
					
				</ul>

			</div>

			
				
				<div class="content-text">
					<?= $content ?>
				</div>
				
				<div class="sidebar">
					<?= $sidebar ?>
				</div>
			

			<div class="footer"><P>© 2015 by RSA</P></div>
		</div>
	</body>
</html>