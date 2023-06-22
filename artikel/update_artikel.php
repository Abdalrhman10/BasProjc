<?php
    include_once 'classes/artikelen.php';
    $artikel = new Artikel;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){
        $artikel->updateArtikel2($_POST['artid'], $_POST['artOmschrijving'], $_POST['artInkoop'], $_POST['artVerkoop'], $_POST['artVoorraad'], $_POST['artMinVoorraad'], $_POST['artMaxVoorraad'], $_POST['artLocatie']);
        echo '<script>alert("Artikel is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['artId'])){
        $row = $artikel->getArtikel($_GET['artid']);
    }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

    <h1>CRUD Artikel</h1>
    <h2>Wijzigen</h2>
    <form method="post">
    <input type='hidden' name='artid' value='<?php echo $row["artid"];?>'>
    <label>Artikel omschrijving:</label>
    <input type='text' name='artOmschrijving' required value='<?php echo $row["artOmschrijving"];?>'> *</br>
    <label>Artikel inkoop:</label>
    <input type='text' name='artInkoop' required value='<?php echo $row["artInkoop"];?>'> *</br>
    <label>Artikel verkoop:</label>
    <input type='text' name='artVerkoop' required value='<?php echo $row["artVerkoop"];?>'> *</br>
    <label>Artikel voorraad:</label>
    <input type='text' name='artVoorraad' required value='<?php echo $row["artVoorraad"];?>'> *</br>
    <label>Artikel minimale voorraad:</label>
    <input type='text' name='artMinVoorraad' required value='<?php echo $row["artMinVoorraad"];?>'> *</br>
    <label>Artikel maximale voorraad:</label>
    <input type='text' name='artMaxVoorraad' required value='<?php echo $row["artMaxVoorraad"];?>'> *</br>
    <label>Artikel locatie:</label>
    <input type='text' name='artLocatie' required value='<?php echo $row["artLocatie"];?>'> *</br></br> 
    <input type='submit' name='update' value='Wijzigen'>
    </form></br>

<a href='read_artikel.php'>Terug</a>

</body>
</html>



