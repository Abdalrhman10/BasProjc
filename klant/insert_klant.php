<?php

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
		include_once 'classes/Klanten.php';
		
		$klant = new Klant;
		//$klant->setObject(0, $_POST['klantNaam'], $_POST['klantEmail, $_POST['klantAdres'], $_POST['klantPostcode'], $_POST['klantWoonplaats']);
		//$klant->insertKlant();
		$klant->insertKlant2($_POST['klantnaam'], $_POST['klantemail'], $_POST['klantadres'], $_POST['klantpostcode'], $_POST['klantWoonplaats']);
			
		echo "<script>alert('Klant: $_POST[klantnaam] $_POST[klantemail] $_POST[klantadres] $_POST[klantpostcode] $_POST[klantWoonplaats] is toegevoegd')</script>";
		echo "<script> location.replace('read_klant.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

	<h1>CRUD Klant</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="kn">Klantnaam:</label>
   <input type="text" id="kn" name="klantnaam" placeholder="Klantnaam" required/>
   <br>   
   <label for="ke">Klant e-mail:</label>
   <input type="text" id="ke" name="klantemail" placeholder="Klant e-mail" required/>
   <br>
   <label for="ka">Klant adres:</label>
   <input type="text" id="ka" name="klantadres" placeholder="Klant adres" required/>
   <br>   
   <label for="kp">Klant postcode:</label>
   <input type="text" id="kp" name="klantpostcode" placeholder="Klant postcode" required/>
   <br>
   <label for="kw">Klant woonplaats:</label>
   <input type="text" id="kw" name="klantWoonplaats" placeholder="Klant woonplaats" required/>
   <br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read_klant.php'>Terug</a>

</body>
</html>