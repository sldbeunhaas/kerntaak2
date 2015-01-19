<?php
// Sessie starten
session_start();

// Als item nummeriek is
if(is_numeric($_GET['item']))
{
    $item = $_GET['item'];
}
// Anders
else
{
    // Error weergeven
    exit ('U wilt een item verwijderen dat niet bestaad.');
}


// Kijk of er iets in de winkelwagen zit
if(empty($_SESSION['winkelwagen']))
{
    echo 'Uw winkelwagen is momenteel leeg.';
}
// Anders
else
{
    // Winkelwagen uit elkaar plukken
    $cart = explode('|', $_SESSION['winkelwagen']);

    // Kijken of het in de winkelwagen staat
    foreach($cart as $products)
    {
        // Split
        /*
          $product[x] -->
             x == 0 -> productnummer
             x == 1 -> hoeveelheid
        */
        $product = explode(',', $products);
        $i++;
        
        // Als item niet toegevoegd moet worden.
        if($i != $item)
        {
            // Var toevoegen aan nieuwe winkelwagen
            $inNewCart = $product[0].','.$product[1];
            $newCart = $newCart.'|'.$inNewCart;
        }
    }
  
    // Luiheid, blijheid... er staat nog een | vooraan, even weghalen.
    $newCart = substr($newCart, 1);
}

// Verwijder winkelwagen
//session_unset($_SESSION['winkelwagen']);

// Maak nieuwe winkelwagen
$_SESSION['winkelwagen'] = $newCart;

// En terugsturen
header('Location: cart.php');
?>