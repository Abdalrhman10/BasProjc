<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<h1>CRUD Leverancier</h1>
	<nav>
		<a href='insert_leverancier.php'>Toevoegen nieuwe leverancier</a><br>


		<a href="../index.php">Terug</a><br>
	</nav>
	
<?php

// De classe definitie
include_once "classes/leveranciers.php";
//$conn = dbConnect();

// Maak een object Leverancier
$leverancier = new Leverancier;

// Haal alle leveranciers op uit de database mbv de method getLeveranciers()
$lijst = $leverancier->getLeveranciers();

// Print een HTML tabel van de lijst	
$leverancier->showTable($lijst);
?>
</body>
</html>