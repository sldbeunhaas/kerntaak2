<?php
	session_start();
	
	$title = "FlowerPower Registratie";

	$content = '<div class="register-form">
				<form action="" method="post">
              		 <label>Gebruikersnaam</label>
                     <input type="text" name="username" required />
             		 <label>Wachtwoord</label>
                     <input type="password" name="password" required  />
                     <label>Herhaal wachtwoord</label>
                     <input type="password" name="password2" required  />
                      <label>Naam</label>
                     <input type="text" name="naam" required />
             		 <label>Achternaam</label>
                     <input type="text" name="achternaam" required />
                      <label>Adres</label>
                     <input type="text" name="adres" required />
             		 <label>Plaats</label>
                     <input type="text" name="plaats" required />
                      <label>Postcode</label>
                     <input type="text" name="postcode" required/>
             		 <label>Huisnummer</label>
                     <input type="text" name="huisnummer" required />
                     <label>E-mail</label>
                     <input type="text" name="email" required />
                      <label>Telefoon</label>
                     <input type="text" pattern="[0-9]{10}" name="telefoon" required/>
                     <input type="submit" value="Registreer" name="submit"/>
                     <div class="error"></div>
				</form>
				</div>
				';

	$sidebar = "Nog bedenken";

	if(isset($_POST['username']) && isset($_POST['password'])){
		if($_POST['password'] == $_POST['password2']){

			include_once('db.php');

			$username = $_POST['username'];
			$password = setBcrypt($_POST['password']);
			$naam = $_POST['naam'];
			$achternaam = $_POST['achternaam'];
			$adres = $_POST['adres'];
			$plaats = $_POST['plaats'];
			$postcode = $_POST['postcode'];
			$huisnummer = $_POST['huisnummer'] ;
			$email = $_POST['email'];
			$telefoon = $_POST['telefoon'];

				$sql = "select username from users where username = '$username'";
				$result = $dbcon->query($sql);
		
				if ($result->num_rows >= 1) {
				echo "Username bestaat al!";
				header("location: register.php");
				die;
				}
			
				$sql = "select email from users where email = '$email'";
				$result = $dbcon->query($sql);
			
				if ($result->num_rows >= 1) {
				echo "Email bestaat al!";
				header("location: register.php");
				die;
				}

			$query = "INSERT INTO users (username, password, naam, achternaam, adres, plaats, postcode, huisnr, email, telefoonnr, activated) VALUES ('$username', '$password', '$naam', '$achternaam', '$adres', '$plaats', '$postcode', '$huisnummer', '$email', '$telefoon', '1')"; 
			$result = $dbcon->query($query);
			if ($result->num_rows >= 1) {
			echo "Username bestaat al!";
			die;
		}
			if($result){
				header("location: login.php");
			}else{
				echo "Query fout!";
			}
		}
	}


	include('template.php');
?>