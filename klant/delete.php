<?php 

if(isset($_POST["verwijderen"])){
	include 'classes/Klanten.php';
	
	// Maak een object Klant
	$klant = new Klant;
	
	// Delete Klant op basis van NR
	$klant->deleteKlant($_GET["klantid"]);
	echo '<script>alert("Klant verwijderd")</script>';
	echo "<script> location.replace('../read_klant.php'); </script>";
}
?>



