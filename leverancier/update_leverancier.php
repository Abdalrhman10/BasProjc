<?php

    include_once 'classes/Leveranciers.php';
    $leverancier = new Leverancier;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){
        $leverancier->updateLeverancier2($_POST['levid'], $_POST['levnaam'], $_POST['levcontact'], $_POST['levemail'], $_POST['levAdres'], $_POST['levPostcode'], $_POST['levWoonplaats']);
        echo '<script>alert("Leverancier is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['levid'])){
        $row = $leverancier->getLeverancier($_GET['levid']);
    }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

    <h1>CRUD Leverancier</h1>
    <h2>Wijzigen</h2>
    <form method="post">
    <input type='hidden' name='levid' value='<?php echo $row["levid"];?>'>
    <label for="lc">Leverancier naam:</label>
    <input type='text' name='levnaam' required value='<?php echo $row["levnaam"];?>'> *</br>
    <label for="lc">Leverancier contactpersoon:</label>
    <input type='text' name='levcontact' required value='<?php echo $row["levcontact"];?>'> *</br>
    <label for="lc">Leverancier e-mail:</label>
    <input type='text' name='levemail' required value='<?php echo $row["levemail"];?>'> *</br>
    <label for="lc">Leverancier adres:</label>
    <input type='text' name='levAdres' required value='<?php echo $row["levAdres"];?>'> *</br>
    <label for="lc">Leverancier postcode:</label>
    <input type='text' name='levPostcode' required value='<?php echo $row["levPostcode"];?>'> *</br>
    <label for="lc">Leverancier woonplaats:</label>
    <input type='text' name='levWoonplaats' required value='<?php echo $row["levWoonplaats"];?>'> *</br></br> 
    <input type='submit' name='update' value='Wijzigen'>
    </form></br>

<a href='read_leverancier.php'>Terug</a>

</body>
</html>



