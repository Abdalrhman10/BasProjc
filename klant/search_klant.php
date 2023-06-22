<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<h1>CRUD Klant</h1>
    <h2>Zoeken op klantId</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        KlantId: <input type="text" name="klantid">
        <input type="submit" value="Zoeken">
    </form>
    <?php
        include_once 'classes/klanten.php';
        $klant = new Klant;

   // Controleren of het formulier is ingediend
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Klant-ID ophalen uit de POST-data
    $klantId = $_POST['klantid'];

    // ZoekKlant-object aanmaken en zoekKlant-functie aanroepen
    
    $klant->searchKlant($klantId);
    }
    ?>

    <a href='read_klant.php'>Terug</a>

</body>
</html>