<?php

session_start();


require('fpdf/fpdf.php');

//Connect to your database
include("db.php");

if (!empty($_SESSION['winkelwagen']) && isset($_SESSION['username'])){
    //Create new pdf file
    $pdf=new FPDF();

    //Disable automatic page break
    $pdf->SetAutoPageBreak(false);

    //Add first page
    $pdf->AddPage();

    //set initial y axis position per page
    $y_axis_initial = 25;

    //print column titles
    // Page header
        // Logo
       // $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $pdf->SetFont('Arial','B',15);
        // Move to the right
        $pdf->Cell(80);
        // Title
        $pdf->Cell(30,10,'Factuur',1,0,'C');
        // Line break
        $pdf->Ln(50);
    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetY($y_axis_initial);
    $pdf->SetX(25);
    $pdf->Cell(50,10,'Product:',1,0,'L',1);
    $pdf->Cell(50,10,'Omschrijving:',1,0,'L',1);
    $pdf->Cell(30,10,'Aantal:',1,0,'L',1);
    $pdf->Cell(30,10,'Prijs:',1,0,'L',1);
    $pdf->Ln(40);
    $pdf->SetFont('Times','',12);
    $pdf->SetX(25);

    $sql1 = 'SELECT u.naam, u.achternaam, u.adres, u.huisnr, u.postcode, u.plaats, u.email, u.telefoonnr, bs.datum FROM users u INNER JOIN bestelling bs on u.id = bs.klant_id where u.id = '. $_SESSION["user_id"] .'';
    $result1 = $dbcon->query($sql1);
 

    $userData = $result1->fetch_array(MYSQLI_ASSOC);

    $pdf->Cell(0,10,'Naam: '. ucfirst($userData['naam']) .'',0,1);
    $pdf->SetX(25);
    $pdf->Cell(0,10,'Achternaam: '. ucfirst($userData['achternaam']) .'',0,1);
    $pdf->SetX(25);
    $pdf->Cell(0,10,'Adres: '. ucfirst($userData['adres']) .'',0,1);
    $pdf->SetX(25);
    $pdf->Cell(0,10,'Huisnummer: '. $userData['huisnr'] .'',0,1);
    $pdf->SetX(25);
    $pdf->Cell(0,10,'Postcode: '. $userData['postcode'] .'',0,1);
    $pdf->SetX(25);
    $pdf->Cell(0,10,'Plaats: '. ucfirst($userData['plaats']) .'',0,1);
    $pdf->SetX(25);
    $pdf->Cell(0,10,'Telefoonnummer: '. $userData['telefoonnr'] .'',0,1);
    $pdf->SetX(25);
    $pdf->Cell(0,10,'Email: '. ucfirst($userData['email']) .'',0,1);
    $pdf->SetX(25);
    $pdf->Cell(0,10,'Datum: '. $userData['datum'] .'',0,1);


    $y_axis = $y_axis_initial + 10;

    //Select the Products you want to show in your PDF file
    $sql2 = 'SELECT u.id, br.bestel_id, br.product_id, br.aantal, pro.titel, pro.omschrijving, pro.prijs FROM users u INNER JOIN bestelling bs on u.id = bs.klant_id INNER JOIN bestelregel br on bs.id = br.bestel_id INNER JOIN producten pro on br.product_id = pro.id where u.id = '. $_SESSION["user_id"] .' and br.bestel_id = '. $_SESSION["bestel_id"] .'';
    $result2 = $dbcon->query($sql2);


    //initialize counter
    $i = 0;

    //Set maximum rows per page
    $max = 25;

    //Set Row Height
    $row_height = 10;
    $eindbedrag = 0;
    while($row = $result2->fetch_array())
    {
        //If the current row is the last one, create new page and print column title
        if ($i == $max)
        {
            $pdf->AddPage();

            //print column titles for the current page
            $pdf->SetY($y_axis_initial);
            $pdf->SetX(25);
            $pdf->Cell(50,10,'titel',1,0,'L',1);
            $pdf->Cell(50,10,'omschrijving:',1,0,'L',1);
            $pdf->Cell(30,10,'aantal',1,0,'R',1);
            $pdf->Cell(30,10,'prijs',1,0,'R',1);
            
            //Go to next row
            $y_axis = $y_axis + $row_height;
            
            //Set $i variable to 0 (first row)
            $i = 0;
        }

        $naam = $row['titel'];
        $omschrijving = $row['omschrijving'];
    if ( mb_strlen( $omschrijving, 'utf8' ) > 25 ) {
       $last_space = strrpos( substr( $omschrijving, 0, 25 ), ' ' ); // find the last space within 35 characters
       $omschrijving = substr( $omschrijving, 0, $last_space ) . '...';
    }
        
        $aantal = $row['aantal'];
        $prijs = $row['prijs'];
        $totaalprijs = $aantal * $prijs;
        $pdf->SetY($y_axis);
        $pdf->SetX(25);
        $pdf->Cell(50,10,$naam,1,0,'L',1);
        $pdf->Cell(50,10,$omschrijving,1,0,'L',1);
        $pdf->Cell(30,10,$aantal,1,0,'R',1);
        $pdf->Cell(30,10,$totaalprijs.' Euro',1,0,'R',1);
        
        $eindbedrag = $eindbedrag + $totaalprijs;
        //Go to next row
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
    }
    $pdf->SetY(150);
    $pdf->SetX(155);
    $pdf->Cell(30,10,'Totaal: '. $eindbedrag .' Euro',1,0,'L',1);
    $dbcon->close();

    //Send file
    $pdf->Output();
    
} else {
    header('Location: cart.php');
}
?>
