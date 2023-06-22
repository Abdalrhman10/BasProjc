<?php

include_once '../database.php';

class Klant extends Database{
	public $klantId;
	public $klantNaam;
	public $klantEmail;	
	public $klantAdres;
	public $klantPostcode;
	public $klantWoonplaats;
	
	// Methods
	
	public function setObject($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats){
		//self::$conn = $db;
		$this->klantId = $klantId;
		$this->klantNaam = $klantNaam;
		$this->klantEmail = $klantEmail;
		$this->klantAdres = $klantAdres;
		$this->klantPostcode = $klantPostcode;
		$this->klantWoonplaats = $klantWoonplaats;
	}

		
	/**
	 * Summary of getKlanten
	 * @return mixed
	 */
	public function getKlanten(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from 	klant")->fetchAll();
		return $lijst;
	}

	// Get klant
	public function getKlant($klantId){

		$sql = "select * from klant where klantid = '$klantId'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownKlant($row_selected = -1){
	
		// Haal alle klanten op uit de database mbv de method getKlanten()
		$lijst = $this->getKlanten();
		
		echo "<label for='Klanten'>Kies een klant:</label>";
		echo "<select name='klantid'>";
		foreach ($lijst as $row){
			if($row_selected == $row["klantid"]){
				echo "<option value='$row[klantid]' selected='selected'> $row[klantnaam] $row[klantemail]</option>\n";
			} else {
				echo "<option value='$row[klantid]'> $row[klantnaam] $row[klantemail]</option>\n";
			}
		}
		echo "</select>";
	}

 /**
  * Summary of showTable
  * @param mixed $lijst
  * @return void
  */
	public function showTable($lijst){

		$txt = "<table border=1px>";
		$txt .= "<tr>";
		$txt .= "<th>Klant id</th>";
		$txt .= "<th>Klantnaam</th>";
		$txt .= "<th>Klant e-mail</th>";
		$txt .= "<th>Klant straat</th>";
		$txt .= "<th>Klant postcode</th>";
		$txt .= "<th>Klant woonplaats</th>";
		$txt .= "<th>Wijzigen</th>";
		$txt .= "<th>Verwijderen</th>";
		$txt .= "</tr>";
		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td>" . $row["klantid"] . "</td>";
			$txt .=  "<td>" . $row["klantnaam"] . "</td>";
			$txt .=  "<td>" . $row["klantemail"] . "</td>";
			$txt .=  "<td>" . $row["klantadres"] . "</td>"; 
			$txt .=  "<td>" . $row["klantpostcode"] . "</td>"; 
			$txt .=  "<td>" . $row["klantWoonplaats"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='update_klant.php?klantid=$row[klantid]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='delete.php?klantid=$row[klantid]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete klant
 /**
  * Summary of deleteKlant
  * @param mixed $klantId
  * @return bool
  */
	public function deleteKlant($klantId){

		$sql = "delete from klant where klantid = '$klantId'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateKlant2($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats){

		$sql = "update klant 
			set klantnaam = '$klantNaam', klantemail = '$klantEmail', klantadres = '$klantAdres', klantpostcode = '$klantPostcode', klantWoonplaats = '$klantWoonplaats' 
			WHERE klantid = '$klantId'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;				
	}
	
	public function updateKlantSanitized($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats){

		$sql = "update klant
			set klantnaam = :klantnaam, klantemail = :klantemail, klantadres = :klantadres, klantpostcode = :klantpostcode, klantWoonplaats = :klantWoonplaats
			WHERE klantId = :klantId";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'klantnaam' => $klantNaam,
			'klantemail' => $klantEmail,
			'klantadres' => $klantAdres, 
			'klantpostcode' => $klantPostcode, 
			'klantWoonplaats' => $klantWoonplaats,
			'klantid'=> $klantId
		]);  
	}
	public function updateKlant(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update klant 
		set klantnaam = :klantnaam, klantemail = :klantemail, klantadres = :klantadres, klantpostcode = :klantpostcode, klantWoonplaats = :klantWoonplaats
		WHERE klantid = :klantid";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute((array)$this);
		return ($stmt->rowCount() == 1) ? true : false;		
	}
	
	/**
	 * Summary of BepMaxklantId
	 * @return int
	 */
	private function BepMaxklantId() : int {
		
	// Bepaal uniek nummer
	$sql="SELECT MAX(klantid)+1 FROM klant";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	public function insertKlant(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		//
		$this->klantId = $this->BepMaxklantId();
		
		$sql = "INSERT INTO klant (klantid, klantnaam, klantemail, klantadres, klantpostcode, klantWoonplaats)
		VALUES (:klantid, :klantnaam, :klantemail, :klantadres, :klantpostcode, :klantWoonplaats)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute((array)$this);
			
	}
	
	/**
	 * Summary of insertKlant2
	 * @param mixed $klantNaam
	 * @param mixed $klantEmail
	 * @param mixed $klantAdres
	 * @param mixed $klantPostcode
	 * @param mixed $klantWoonplaats
	 * @return void
	 */
	public function insertKlant2($klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats){
		
		// query
		$klantId = $this->BepMaxklantId();
		$sql = "INSERT INTO klant (klantid, klantnaam, klantemail, klantadres, klantpostcode, klantWoonplaats)
		VALUES (:klantid, :klantnaam, :klantemail, :klantadres, :klantpostcode, :klantWoonplaats)";
		
		// Prepare
		$stmt = self::$conn->prepare($sql);
		
		// Execute
		$stmt->execute([
			'klantid'=>$klantId,
			'klantnaam'=>$klantNaam,
			'klantemail'=>$klantEmail,
			'klantadres'=>$klantAdres, 
			'klantpostcode'=>$klantPostcode, 
			'klantWoonplaats'=>$klantWoonplaats
		]);
			
	}

	public function searchklant($klantId)
	{
		try {
			// Query uitvoeren om klantgegevens op te halen
			$sql = "SELECT * FROM klant WHERE klantid = :klantid";
			$stmt = $this::$conn->prepare($sql);
			$stmt->bindParam(':klantid', $klantId);
			$stmt->execute();
	
			// Controleren of er resultaten zijn
			if ($stmt->rowCount() > 0) {
				// Resultaten tonen op het scherm
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "Klant id: " . $row["klantid"] . "<br>";
					echo "Klant naam: " . $row["klantnaam"] . "<br>";
					echo "Klant e-mail: " . $row["klantemail"] . "<br>";
					echo "Klant adres: " . $row["klantadres"] . "<br>";
					echo "Klant postcode: " . $row["klantpostcode"] . "<br>";
					echo "Klant woonplaats: " . $row["klantWoonplaats"] . "<br>";                   
				}
			} else {
				echo "Geen resultaten gevonden voor het opgegeven klantId.";
			}
		} catch (PDOException $e) {
			die("Fout bij het uitvoeren van de query: " . $e->getMessage());
		}
	}
	
}
?>