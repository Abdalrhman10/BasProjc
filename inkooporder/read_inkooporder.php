<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<h1>CRUD Inkooporder</h1>
	<nav>
		<a href='insert_inkooporder.php'>Toevoegen nieuwe inkooporder</a><br>


		<a href="../index.php">Terug</a><br>
	</nav>
	
<?php

// De classe definitie
include_once "classes/inkooporders.php";
//$conn = dbConnect();

// Maak een object Inkooporder
$inkooporder = new Inkooporder;

// Haal alle inkooporders op uit de database mbv de method getInkooporders()
$lijst = $inkooporder->getInkooporders();

// Print een HTML tabel van de lijst	
$inkooporder->showTable($lijst);
?>
</body>
</html>