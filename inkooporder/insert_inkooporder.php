<?php

		include "../leverancier/classes/leveranciers.php";
		include "../artikel/classes/Artikelen.php";

		// Maak een object leverancier
		$leverancier = new Leverancier;

		// Maak een object Artikel
		$artikel = new Artikel;

	if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
		include_once 'classes/Inkooporders.php';
		
		$inkooporder = new Inkooporder;
		//$inkooporder->setObject(0, $_POST['levId'], $_POST['artId, $_POST['inkOrdDatum'], $_POST['inkOrdBestAantal'], $_POST['inkOrdStatus']);
		//$inkooporder->insertInkooporder();
		$inkooporder->insertInkooporder2($_POST['levid'], $_POST['artid'], $_POST['inkOrdDatum'], $_POST['inkOrdBestAantal'], $_POST['inkOrdStatus']);
			
		echo "<script>alert('Inkooporder: $_POST[levid] $_POST[artid] $_POST[inkOrdDatum] $_POST[inkOrdBestAantal] $_POST[inkOrdStatus] is toegevoegd')</script>";
		echo "<script> location.replace('read_inkooporder.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

	<h1>CRUD Inkooporder</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<?php
		isset($_POST['Toevoegen']) ? $levId=$_POST['levid'] : $levId=-1;
		$leverancier->dropDownLeverancier($levId);
		echo "<br>";
		isset($_POST['Toevoegen']) ? $levId=$_POST['artid'] : $artId=-1;
		$artikel->dropDownArtikel($artId);

	?>
   <br>   
   <label for="iod">Inkoop order datum:</label>
   <input type="date" id="iod" name="inkOrdDatum" placeholder="Inkoop order datum" required/>
   <br>   
   <label for="ioba">Inkoop order besteld aantal:</label>
   <input type="number" id="ioba" name="inkOrdBestAantal" placeholder="Inkoop order besteld aantal" required/>
   <br>
   <label for="ios">Kies inkoop order status:</label>
   <select id="ios" name="inkOrdStatus">
		<option value="1">1: Bestelling besteld en Genoteerd in tabel.</option>
		<option value="2">2: Artikel is verzonden naar de bezorger.</option>
		<option value="3">3: Artikel is bij de bezorger.</option>
		<option value="4">4: artikel is afgeleverd.</option>
    </select>  
   <br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read_inkooporder.php'>Terug</a>

</body>
</html>

<?php

if (isset($_POST['Toevoegen'])){
	$inkooporder->id = $_POST['levid'];
	$row = $inkooporder->getInkooporder();
	
	//echo "Gekozen waarde: id: $_POST[levId] $row[levNaam] $row[levEmail] $row[levAdres] $row[levPostcode] $row[levWoonplaats]"; 
}

if (isset($_POST['Toevoegen'])){
	$inkooporder->id = $_POST['artid'];
	$row = $inkooporder->getInkooporder();
	
	//echo "Gekozen waarde: id: $_POST[artId] $row[levNaam] $row[levEmail] $row[levAdres] $row[levPostcode] $row[levWoonplaats]"; 
}

?>