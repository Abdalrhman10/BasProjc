<?php

    include_once 'classes/Verkooporders.php';

    $verkooporder = new Verkooporder;

    include "../klant/classes/Klanten.php";
    include "../artikel/classes/Artikelen.php";

    // Maak een object Klant
    $klant = new Klant;

    // Maak een object Artikel
    $artikel = new Artikel;


    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){
        $verkooporder->updateVerkooporder2($_POST['klantid'], $_POST['artid'], $_POST['verkOrdDatum'], $_POST['verkOrdBestAantal'], $_POST['verkOrdStatus']);
        echo '<script>alert("Verkooporder is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['klantid'], $_GET["artid"])){
        $row = $verkooporder->getVerkooporder($_GET['klantid'], $_GET["artid"]);
    }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

    <h1>CRUD Verkooporder</h1>
    <h2>Wijzigen</h2>
	<form method="post">
	<?php
		isset($_POST['Wijzigen']) ? $klantId=$_POST['klantid'] : $klantId=-1;
		$klant->dropDownKlant($klantId);
		echo "<br>";
		isset($_POST['Wijzigen']) ? $klantId=$_POST['artid'] : $artId=-1;
		$artikel->dropDownArtikel($artId);

	?>
   <br>   
   <label for="vod">Verkoop order datum:</label>
   <input type="date" id="vod" name="verkOrdDatum" placeholder="Verkoop order datum" required/>
   <br>   
   <label for="voba">Verkoop order besteld aantal:</label>
   <input type="number" id="voba" name="verkOrdBestAantal" placeholder="Verkoop order besteld aantal" required/>
   <br>
   <label for="vos">Kies verkoop order status:</label>
   <select id="vos" name="verkOrdStatus">
		<option value="1">1: Genoteerd in tabel.</option>
		<option value="2">2: Magazijnmedewerker verzamelt het artikel.</option>
		<option value="3">3: Tas met artikel is bij de bezorger.</option>
		<option value="4">4: Tas met artikel is afgeleverd bij de klant.</option>
    </select>  
   <br><br>
	<input type='submit' name='update' value='Wijzigen'>
	</form></br>
    

<a href='read_verkooporder.php'>Terug</a>

</body>
</html>



