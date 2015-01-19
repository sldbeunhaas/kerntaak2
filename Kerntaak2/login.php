<?php
	session_start();
	$title = "FlowerPower Login";

	$content = '<div class="login-form">
				<form action="login.php" method="post">
              		<label>Gebruikersnaam</label>
                     <input type="text" name="username" />
             		 <label>Wachtwoord</label>
                     <input type="password" name="password"  /></br>
                     <input type="submit" value="Inloggen" name="submit" class="submit"/> <a href="register.php">Registeren</a> 
				</form> 
				</div>
				';
	

	$sidebar = "test";

	

	if(isset($_POST['submit'])){

		include('db.php');


		$username = escapeString($_POST['username'], $dbcon);
		$password = escapeString($_POST['password'], $dbcon);

		if(!empty($username) && !empty($password)){

		$sql = "SELECT id, username, password, adres FROM users WHERE username = '$username' and activated = '1' LIMIT 1";
		$query = $dbcon->query($sql);
		$row = $query->fetch_row();
		$uid = $row[0];
		$usernameDB = $row[1];
		$passwordDB = $row[2];
		$adresDB = $row[3];

		if($username == $usernameDB && $password == password_verify($password, $passwordDB)){

			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $uid; 
			$_SESSION['adres'] = $adresDB; 

			header("location: users.php");
		}else{
			echo "Username OR password incorrect! try again";
		}

		}
	}

	include('template.php');
?>