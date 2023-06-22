<?php

    include_once 'classes/Inkooporders.php';

    $inkooporder = new Inkooporder;

    include "../leverancier/classes/leveranciers.php";
    include "../artikel/classes/Artikelen.php";

    // Maak een object leverancier
    $leverancier = new leverancier;

    // Maak een object Artikel
    $artikel = new Artikel;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){
        $inkooporder->updateInkooporder2($_POST['levid'], $_POST['artid'], $_POST['inkOrdDatum'], $_POST['inkOrdBestAantal'], $_POST['inkOrdStatus']);
        echo '<script>alert("Inkooporder is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['levid'], $_GET["artid"])){
        $row = $inkooporder->getInkooporder($_GET['levid'], $_GET["artid"]);
    }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

    <h1>CRUD Inkooporder</h1>
    <h2>Wijzigen</h2>
	<form method="post">
	<?php
		isset($_POST['Wijzigen']) ? $levId=$_POST['levid'] : $levId=-1;
		$leverancier->dropDownleverancier($levId);
		echo "<br>";
		isset($_POST['Wijzigen']) ? $levId=$_POST['artid'] : $artId=-1;
		$artikel->dropDownArtikel($artId);

	?>
   <br>   
   <label for="vod">Inkoop order datum:</label>
   <input type="date" id="vod" name="inkOrdDatum" placeholder="Inkoop order datum" required/>
   <br>   
   <label for="voba">Inkoop order besteld aantal:</label>
   <input type="number" id="voba" name="inkOrdBestAantal" placeholder="Inkoop order besteld aantal" required/>
   <br>
   <label for="vos">Kies inkoop order status:</label>
   <select id="vos" name="inkOrdStatus">
   <option value="1">1: Bestelling besteld en Genoteerd in tabel.</option>
		<option value="2">2: Artikel is verzonden naar de bezorger.</option>
		<option value="3">3: Artikel is bij de bezorger.</option>
		<option value="4">4: artikel is afgeleverd.</option>
    </select>  
   <br><br>
	<input type='submit' name='update' value='Wijzigen'>
	</form></br>

<a href='read_inkooporder.php'>Terug</a>

</body>
</html>



