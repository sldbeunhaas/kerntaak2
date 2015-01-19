<?php  

//connect to the database 
include("db.php");
// 

    //get the csv file 
    $file = 'test.csv'; 
    $handle = fopen($file,"r"); 
     
     $data = fgetcsv($handle,1000,",","'");
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            $sql = "INSERT INTO producten (voorraad, titel, afbeelding, omschrijving, prijs) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."', 
     '".addslashes($data[1])."',
     '".addslashes($data[1])."'
                ) 
            ";
   $dbcon->query($sql);
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    echo 'completed';
 die;


?>