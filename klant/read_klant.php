<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<h1>CRUD Klant</h1>
	<nav>
		<a href='insert_klant.php'>Toevoegen nieuwe klant</a><br>
		<a href='search_klant.php'>Zoeken klantid</a><br>

		<a href="../index.php">Terug</a><br>
	</nav>
	
<?php

// De classe definitie
include_once "classes/klanten.php";
//$conn = dbConnect();

// Maak een object Klant
$klant = new Klant;

// Haal alle klants op uit de database mbv de method getKlanten()
$lijst = $klant->getKlanten();

// Print een HTML tabel van de lijst	
$klant->showTable($lijst);
?>
</body>
</html>