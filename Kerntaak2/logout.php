<?php
	session_start();
	session_destroy();

	if(!isset($_SESSION['username'])){
		echo "Kon niet worden uitgelogd";
	}
		
		 header("Location: home.php");

?>