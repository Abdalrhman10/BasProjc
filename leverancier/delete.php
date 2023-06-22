<?php 

if(isset($_POST["verwijderen"])){
	include 'classes/Leveranciers.php';
	
	// Maak een object Leverancier
	$leverancier = new Leverancier;
	
	// Delete Leverancier op basis van NR
	$leverancier->deleteLeverancier($_GET["levid"]);
	echo '<script>alert("Leverancier verwijderd")</script>';
	echo "<script> location.replace('../read_leverancier.php'); </script>";
}
?>



