<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<h1>CRUD Verkooporder</h1>
	<nav>
		<a href='insert_verkooporder.php'>Toevoegen nieuwe verkooporder</a><br>


		<a href="../index.php">Terug</a><br>
	</nav>
	
<?php

// De classe definitie
include_once "classes/verkooporders.php";
//$conn = dbConnect();

// Maak een object Verkooporder
$verkooporder = new Verkooporder;

// Haal alle verkooporders op uit de database mbv de method getVerkooporders()
$lijst = $verkooporder->getVerkooporders();

// Print een HTML tabel van de lijst	
$verkooporder->showTable($lijst);
?>
</body>
</html>