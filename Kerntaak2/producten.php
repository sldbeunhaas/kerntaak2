<?php
session_start();

$title = "Welkom ". @$_SESSION['username'];

// Database connectie maken
include('db.php');


 $sql = 'SELECT * FROM producten ORDER BY titel ASC';
 $result = $dbcon->query($sql);
 
 function productweergeven($result) {
  if($result->num_rows > 0) {
   while($rec = $result->fetch_assoc()) {
   $results[] ='<div class ="productbox">
       <div class = "productinfo">
       <input type="hidden" name="product_id" value="'.$rec['id'].'" />
       <p class = "producttitle">'.$rec['titel'].'</p>
       <p class = "productprijs">Prijs: &euro;'.$rec['prijs'].'</p>
       <p class = "podructinfo"><a href="getproduct.php?Pid='.$rec['id'].'">Meer details</a></p>
      </div>
        <div class"productfoto">
        <img src ="http://www.happytown.nl/Amersfoort-Quino-Damen/1PKL.jpg" alt ="Foto" class="prodfoto"/>
        </div>
    </div>';
   }
   return $results;
  }
 }

 $content = '<div class = "padding">
  '. implode(",", productweergeven($result)) .'
  </div>';

 

	$sidebar = "";

	include('template.php');
?>