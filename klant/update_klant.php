<?php

    include_once 'classes/klanten.php';
    $klant = new Klant;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){
        $klant->updateKlant2($_POST['klantid'], $_POST['klantnaam'], $_POST['klantemail'], $_POST['klantadres'], $_POST['klantpostcode'], $_POST['klantWoonplaats']);
        echo '<script>alert("Klant is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['klantId'])){
        $row = $klant->getKlant($_GET['klantid']);
    }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

    <h1>CRUD Klant</h1>
    <h2>Wijzigen</h2>
    <form method="post">
    <input type='hidden' name='klantid' value='<?php echo $row["klantid"];?>'>
    <label>Klantnaam:</label>
    <input type='text' name='klantnaam' required value="<?php echo $row["klantnaam"];?>"> *</br>
    <label>Klant e-mail:</label>
    <input type='text' name='klantemail' required value='<?php echo $row["klantemail"];?>'> *</br>
    <label>Klant adres:</label>
    <input type='text' name='klantadres' required value="<?php echo $row["klantadres"];?>"> *</br>
    <label>Klant postcode:</label>
    <input type='text' name='klantpostcode' required value='<?php echo $row["klantpostcode"];?>'> *</br>
    <label>Klant woonplaats:</label>
    <input type='text' name='klantWoonplaats' required value='<?php echo $row["klantWoonplaats"];?>'> *</br></br> 
    <input type='submit' name='update' value='Wijzigen'>
    </form></br>

<a href='read_klant.php'>Terug</a>

</body>
</html>



