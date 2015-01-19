<?php
// delete_cart.php
session_start();

// Als er iets in de winkelwagen zit
if(empty($_SESSION['winkelwagen']))
{
    // Terug sturen
    header('Location: Winkelwagen.php');
}
// Anders
else
{
    // Leeg de winkwelwagen
    session_unset($_SESSION['winkelwagen']);

    // Terug sturen
    header('Location: cart.php');
}
?>