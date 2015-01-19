<?php

session_start();
	
	include('db.php');

	$sql = 'SELECT * FROM users WHERE id ='.$_SESSION['user_id'].'';
	$result = $dbcon->query($sql);

	$userData = $result->fetch_array(MYSQLI_ASSOC);


	$title = "Welkom ". $_SESSION['username'];

	$sidebar = "";

	$content = '<div class="userWelkom">Welkom '.$_SESSION['username'].'</div>
				<div class="usertabel">
				<div class="user-info">
				<p>Gebruikersnaam: '. $userData['username'] .' </p>
				<p>Naam: '. $userData['naam'] .'</p>
				<p>Achternaam: '. $userData['achternaam'] .'</p>
				<p>Adres: '. $userData['adres'] .'</p>
				<p>Huisnr: '. $userData['huisnr'] .'</p>
				<p>Postcode: '. $userData['postcode'] .'</p>
				<p>Plaats: '. $userData['plaats'] .'</p>
				<p>Email: '. $userData['email'] .'</p>
				<p>Telefoon: '. $userData['telefoonnr'] .'</p>
				</div>
				<div class="user-result"></div>
				
				</div>
			';

	

	include('template.php');
?>



<?php

/***
if (isset($_SESSION['id'])) {
	    // Put stored session variables into local PHP variable
	    $uid = $_SESSION['id'];
	    $username = $_SESSION['username'];
	    $adres = $_SESSION['adres'];
	    $result = "<br /> Username: ".$username. "<br /> Id: ".$uid. "<br /> Adres: ".$adres;
	    $logout = "<br/>Welcome ".$username." (<a href=logout.php>Logout</a>)";
	} else {
	    $result = "<h2>404 ERROR! You are not logged in yet</h2>";
	    $logout = '';
	}


	if(isset($result) & !empty($result)){
		echo $result;
		echo "</br> ". $logout;
	}
	*/


?>