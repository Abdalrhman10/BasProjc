<html>
<body>
<h1>Dropdown Klant</h1>

<?php
include "classes/klanten.php";

// Maak een object Klant
$klant = new Klant;
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $klantId=$_POST['klantid'] : $klantId=-1;
		$klant->dropDownKlant($klantId);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$klant->id = $_POST['klantid'];
	$row = $klant->getKlant();
	
	echo "Gekozen waarde: id: $_POST[klantid] $row[klantnaam] $row[klantemail] $row[klantadres] $row[klantpostcode] $row[klantWoonplaats]"; 
}
?>

</body>
</html>