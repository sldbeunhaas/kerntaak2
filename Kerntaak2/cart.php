<?php
  // Sessie starten
session_start();

$title = "test";
	


// Database connectie maken
include('db.php');

// Style pagina invoegen
echo '<link rel="stylesheet" type="text/css" href="Winkelwagen.css" />';

// Javascript voor updaten en deleten winkelwagen invoegen
echo '<script type="text/javascript" src="Winkelwagen.js"></script>';

function winkelwagen($dbcon) {
 // Kijk of er iets in de winkelwagen zit
 
 $results = '';
 
 if (empty($_SESSION['username'])) {
    $results .= '<p class="error">Je bent niet ingelogt!</p>';
    session_destroy();
    return $results;
  }
 if(empty($_SESSION['winkelwagen']))
 {
  $results .= '<p class="error">Uw winkelwagen is momenteel leeg.</p>';
  return $results;
 }
 // Anders
 else
 {
  $results .= '<div class="wrapper">';
   $results .= '<div class="row">';
    $results .= '<p class="small"><b>Aantal:</b></p>';
    $results .= '<p class="small"><b>Art. nr.:</b></p>';
    $results .= '<p class="big"><b>Product:</b></p>';
    $results .= '<p class="small"><b>Actie:</b></p>';
    $results .= '<p class="small"><b>Prijs:</b></p>';
   $results .= '</div>';
  
   // Exploden
   $cart = explode('|', $_SESSION['winkelwagen']);

   // Begin formulier
   $results .= '<form action="Upd_winkelwagen.php" method="post">'; 
    // Show winkelwagen
    $i = 0;
    foreach($cart as $products)
    {
     // Split
     /*
     $product[x] -->
      x == 0 -> product id
      x == 1 -> hoeveelheid
     */
     $product = explode(',', $products);
   
     // Get product info
     $sql = "SELECT * FROM producten WHERE id = '".intval($product[0])."'";
     $result = $dbcon->query($sql);
     // Als query gelukt is
     if($result)
     {
      // Als er items zijn
      if($result->num_rows > 0)
      {
       // Alle items echoën
       $rec = $result->fetch_assoc();
       $i++;
   
       // Verborgen vars
       $results .= '<input type="hidden" name="productnummer_'.$i.'" value="'.$product[0].'" />';
       
       $results .= '<div class="row">';
        // Aantal
        $results .= '<p class="small">';
         $results .= '<input type="text" class="aantal_w" name="hoeveelheid_'.$i.'" value="'.$product[1].'" size="2" maxlength="2" onKeyPress="return submitenter(this,event)" />';
        $results .= '</p>';
        
        // Artikel nummer
        $results .= '<p class="small">';
         if($rec['voorraad'] < $product[1])
         {
          $results .= '<font style="color: #FF0000;">'.$product[0].'</font>';
          $error = TRUE;
         }
         else
         {
          $results .= $product[0];
         }
        $results .= '</p>';
        
        // titel
        $results .= '<p class="big">';
         $results .= $rec['titel'];
        $results .= '</p>';
        
        // Acties
        $results .= '<p class="small">';
         $results .= '<a href="javascript:removeItem('.$i.')">Del</a>';
        $results .= '</p>';
        
        // Prijs
        $results .= '<p class="small">';
         $results .= '&euro; '.($rec['prijs'] * $product[1]);
        $results .= '</p>';
       $results .= '</div>';
      }
      // Anders
      else
      {
       // Fout weergeven
       $results .= '<p class="error">Dit product is er niet meer.</p>';
      }
     }
     // Anders
     else
     {
      // Mysql error opvangen
      $results .= 'Er is een fout opgetreden in de query. <br />';
      echo mysql_error();
     }
    }
   $results .= '</form>';
   
   //if($error == TRUE)
   //{
   // $results .= '<p class="error">';
   //  $results .= 'Van artikelen waarvan het artikelnummer rood is gekleurd hebben we niet voldoende op voorraad om je bestelling direct uit te kunnen leveren.';
   // $results .= '</p>';
   //}
  $results .= '</div>';
  
  // Winkelwagen leeghalen & Afrekenen
  $results .= '<a href="javascript:removeCart()">Winkelwagen leeghalen</a><br />';
  $results .= '<a href="verwerken.php">Verwerken</a></p>';
 }
 return $results;
}

$content = winkelwagen($dbcon);
	
	$sidebar = "test";


	include('template.php');
?>