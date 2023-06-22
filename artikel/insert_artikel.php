<?php

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
		include_once 'classes/artikelen.php';
		
		$artikel = new Artikel;
		//$artikel->setObject(0, $_POST['artOmschrijving'], $_POST['artInkoop, $_POST['artVerkoop'], $_POST['artVoorraad'], $_POST['artMinVoorraad'], $_POST['artMaxVoorraad'], $_POST['artLocatie']);
		//$artikel->insertKlant();
		$artikel->insertArtikel2($_POST['artOmschrijving'], $_POST['artInkoop'], $_POST['artVerkoop'], $_POST['artVoorraad'], $_POST['artMinVoorraad'], $_POST['artMaxVoorraad'], $_POST['artLocatie']);
			
		echo "<script>alert('Artikel: $_POST[artOmschrijving] $_POST[artInkoop] $_POST[artVerkoop] $_POST[artVoorraad] $_POST[artMinVoorraad] $_POST[artMaxVoorraad] $_POST[artLocatie] is toegevoegd')</script>";
		echo "<script> location.replace('read_artikel.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

	<h1>CRUD Artikel</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="ao">Artikel omschrijving:</label>
   <input type="text" id="ao" name="artOmschrijving" placeholder="Artikel omschrijving" required/>
   <br>   
   <label for="ai">Artikel inkoop:</label>
   <input type="text" id="ai" name="artInkoop" placeholder="Artikel inkoop" required/>
   <br>
   <label for="ave">Artikel verkoop:</label>
   <input type="text" id="ave" name="artVerkoop" placeholder="Artikel verkoop" required/>
   <br>   
   <label for="avo">Artikel voorraad:</label>
   <input type="text" id="avo" name="artVoorraad" placeholder="Artikel voorraad" required/>
   <br>
   <label for="amiv">Artikel minimale voorraad:</label>
   <input type="text" id="amiv" name="artMinVoorraad" placeholder="Artikel minimale voorraad" required/>
   <br>   
   <label for="amav">Artikel maximale voorraad:</label>
   <input type="text" id="amav" name="artMaxVoorraad" placeholder="Artikel maximale voorraad" required/>
   <br>
   <label for="al">Artikel locatie:</label>
   <input type="text" id="al" name="artLocatie" placeholder="Artikel locatie" required/>
   <br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read_artikel.php'>Terug</a>

</body>
</html>



