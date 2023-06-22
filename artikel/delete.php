<?php 

if(isset($_POST["verwijderen"])){
	include 'classes/artikelen.php';
	
	// Maak een object Artikel
	$artikel = new Artikel;
	
	// Delete Artikel op basis van NR
	$artikel->deleteArtikel($_GET["artikelid"]);
	echo '<script>alert("Artikel verwijderd")</script>';
	echo "<script> location.replace('../read_artikel.php'); </script>";
}
?>



