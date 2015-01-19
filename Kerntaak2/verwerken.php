<?php
// Sessie starten
session_start();

// Database connectie maken
include('db.php');


// Order invoegen 
$sql1 = "INSERT INTO bestelling ( klant_id,datum
                            )
                    VALUES
                        (
                        '".intval($_SESSION['user_id'])."',
                        NOW()
                        )
                    ";
$result1 = $dbcon->query($sql1);
// Als query gelukt is
if($result1)
{
    // Winkelwagen openen
    $cart = explode('|', $_SESSION['winkelwagen']);
    
    // $bestel id aanmaken
    $bestel_id = $dbcon->insert_id;
    $_SESSION['bestel_id'] = $bestel_id;
    
    
    // Voor elk product
    $i = 1;
    foreach($cart as $products)
    {
        // Split
        /*
            $product[x] -->
                x == 0 -> product id
                x == 1 -> hoeveelheid
        */
        // Product eigenschappen splitsen
        $product = explode(',', $products);
        
        // Bestelde producten in db zetten
		$sql2 = 'INSERT INTO
                                bestelregel
                                    (
                                    bestel_id,
                                    product_id,
                                    aantal
                                    )
                            VALUES
                                (
                                '.intval($bestel_id).',
                                '.$product[0].',
                                '.$product[1].'
                                )';
		$result2 = $dbcon->query($sql2);
		
        // Als de query gelukt is
        if($result2)
        {
            if($i == 1)
            {

                header('location: factuur.php');
                 
                 
            }
        }
        // Anders
        else
        {
            // Mysql error opvangen
            echo 'Er is een fout opgetreden in query nr: 2 <br />';
        //    echo $conn->error();
        }
    $i++;
    }
}
// Anders
else
{
    // Mysql error opvangen
    echo 'Er is een fout opgetreden in query nr: 1 <br />';
  //  echo $conn->error();
}
?>