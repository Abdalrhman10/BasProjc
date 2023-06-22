<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<h1>CRUD Artikel</h1>
	<nav>
		<a href='insert_artikel.php'>Toevoegen nieuwe artikel</a><br>


		<a href="../index.php">Terug</a><br>
	</nav>
	
<?php

// De classe definitie
include_once "classes/artikelen.php";
//$conn = dbConnect();

// Maak een object Artikel
$artikel = new Artikel;

// Haal alle artikelen op uit de database mbv de method getArtikel()
$lijst = $artikel->getArtikelen();

// Print een HTML tabel van de lijst	
$artikel->showTable($lijst);
?>
</body>
</html>