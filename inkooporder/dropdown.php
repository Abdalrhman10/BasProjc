<html>
<body>
<h1>Dropdown Inkooporder</h1>

<?php
include "classes/inkooporders.php";

// Maak een object Inkooporder
$inkooporder = new Inkooporder;
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $levId=$_POST['levid'] : $levId=-1;
		$inkooporder->dropDownInkooporder($levId);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$inkooporder->id = $_POST['levid'];
	$row = $inkooporder->getInkooporder();
	
	echo "Gekozen waarde: id: $_POST[levid] $row[levnaam] $row[inkOrdDatum] $row[levAdres] $row[levPostcode] $row[levWoonplaats]"; 
}
?>

</body>
</html>

