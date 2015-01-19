<?php
// update_cart.php
session_start();

// Kijk of er iets in de winkelwagen zit
if(empty($_SESSION['winkelwagen']))
{
    echo 'Uw winkelwagen is momenteel leeg.';
}
// Anders
else
{
    // Exploden
    $cart = explode('|', $_SESSION['winkelwagen']);

    // Tellen
    $count = count($cart);

    // Alle producten langslopen
    foreach($cart as $products)
    {
        // Split
        /*
          $product[x] -->
             x == 0 -> product id
             x == 1 -> hoeveelheid
        */
        $product = explode(',', $products);
        $i++;

        $postedProduct = 'productnummer_'.$i;     // Deze twee om later de geposte waarde te 'spoofen'
        $postedQuantity = 'hoeveelheid_'.$i;

        // Post waarden spoofen
        if($product[0] == $_POST[$postedProduct] && $_POST[$postedQuantity] > 0)
        {
            // Update pro
            $inNewCart = $product[0].','.$_POST[$postedQuantity];
            $newCart = $newCart.'|'.$inNewCart;
        }
    }
  
  // En weer die luiheid, dus die eerste | eraf...
  $newCart = substr($newCart, 1);

  // Oude winkelwagen weg, nieuwe terug
  session_unset($_SESSION['winkelwagen']);
  $_SESSION['winkelwagen'] = $newCart;

  // En weer terugsturen
  header('Location: cart.php');
}
?>