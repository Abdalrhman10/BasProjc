<html>
<body>
<h1>Dropdown Artikel</h1>

<?php
include "classes/artikelen.php";

// Maak een object Artikel
$artikel = new Artikel;
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $artikelId=$_POST['artikelid'] : $artikelId=-1;
		$artikel->dropDownArtikel($artikelId);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$artikel->id = $_POST['artikelid'];
	$row = $artikel->getArtikel();
	
	echo "Gekozen waarde: id: $_POST[artikelid] $row[artOmschrijving] $row[artInkoop] $row[artVerkoop] $row[artVoorraad] $row[artMinVoorraad] $row[artMaxVoorraad] $row[artLocatie]"; 
}
?>

</body>
</html>