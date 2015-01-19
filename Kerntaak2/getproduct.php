<?php
session_start();
require_once('db.php');

$sql = "SELECT * FROM producten WHERE id = '".intval($_GET['Pid'])."'";
$result = $dbcon->query($sql);

	function productget($result) {
		if($result->num_rows > 0) {
			while($rec = $result->fetch_assoc()) {	
			
			return	'<div class = "contact">
						<div class = "product">
							<form action="toevoegen.php" method="post">
							<input type="hidden" name="product_id" value="'.$rec['id'].'" />
							<p class = "adress"><b>'.$rec['titel'].'</b></p>
							<p class = "adress"><b>Prijs:</b> &euro;'.$rec['prijs'].'</p> 
							<p class = "adress"><b>Aantal: <input class="aantal_p" type="text" name="aantal" size="2" maxlength="2" value="1" /></b></p>
							<p class = "adress"><b>Omschrijving:</b></p>
							<p class = "adress">'.nl2br($rec['omschrijving']).'</p>
							<input class="submit_p" type="submit" value="Toevoegen Aan Winkelwagen" />
							</form>
						</div>
						<img src = "http://www.happytown.nl/Amersfoort-Quino-Damen/1PKL.jpg"" alt = "eerstewinkel" class = "winkelfoto"/>
					</div>';
							
			}
		}
	}
		$content = '<div class = "padding">
		'.productget($result).'
	</div>';


include ('template.php');

?>