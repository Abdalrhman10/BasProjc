<?php 

if(isset($_POST["verwijderen"])){
	include 'classes/Verkooporders.php';
	
	// Maak een object Verkooporder
	$verkooporder = new Verkooporder;
	
	// Delete Verkooporder op basis van NR
	$verkooporder->deleteVerkooporder($_GET["klantid"], $_GET["artid"]);
	echo '<script>alert("Verkooporder verwijderd")</script>';
	echo "<script> location.replace('read_verkooporder.php'); </script>";
}
?>



