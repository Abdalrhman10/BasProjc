<?php

include_once '../database.php';

class Artikel extends Database{
	public $artId;
	public $artOmschrijving;
	public $artInkoop;	
	public $artVerkoop;
	public $artVoorraad;
	public $artMinVoorraad;
	public $artMaxVoorraad;
	public $artLocatie;
	
	// Methods
	
	public function setObject($artId, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie){
		//self::$conn = $db;
		$this->artId = $artId;
		$this->artOmschrijving = $artOmschrijving;
		$this->artInkoop = $artInkoop;
		$this->artVerkoop = $artVerkoop;
		$this->artVoorraad = $artVoorraad;
		$this->artMinVoorraad = $artMinVoorraad;
		$this->artMaxVoorraad = $artMaxVoorraad;
		$this->artLocatie = $artLocatie;
	}

		
	/**
	 * Summary of getArtikelen
	 * @return mixed
	 */
	public function getArtikelen(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from 	artikel")->fetchAll();
		return $lijst;
	}

	// Get artikel
	public function getArtikel($artId){

		$sql = "select * from artikel where artid = '$artId'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownArtikel($row_selected = -1){
	
		// Haal alle artikelen op uit de database mbv de method getArtikelen()
		$lijst = $this->getArtikelen();
		
		echo "<label for='Artikelen'>Kies een artikel:</label>";
		echo "<select name='artid'>";
		foreach ($lijst as $row){
			if($row_selected == $row["artid"]){		
				echo "<option value='$row[artid]' selected='selected'> $row[artOmschrijving] (&euro; $row[artVerkoop])</option>\n";
			} else {
				echo "<option value='$row[artid]'> $row[artOmschrijving] (&euro; $row[artVerkoop])</option>\n";
			}
		}
		$conn = null;
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
		$txt .= "<th>Artikel id</th>";
		$txt .= "<th>Artikel omschrijving</th>";
		$txt .= "<th>Artikel inkoop</th>";
		$txt .= "<th>Artikel verkoop</th>";
		$txt .= "<th>Artikel voorraad</th>";
		$txt .= "<th>Artikel minimale voorraad</th>";
		$txt .= "<th>Artikel maximale voorraad</th>";
		$txt .= "<th>Artikel locatie</th>";
		$txt .= "<th>Wijzigen</th>";
		$txt .= "<th>Verwijderen</th>";
		$txt .= "</tr>";
		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td>" . $row["artid"] . "</td>";
			$txt .=  "<td>" . $row["artOmschrijving"] . "</td>";
			$txt .=  "<td>" . $row["artInkoop"] . "</td>";
			$txt .=  "<td>" . $row["artVerkoop"] . "</td>"; 
			$txt .=  "<td>" . $row["artVoorraad"] . "</td>"; 
			$txt .=  "<td>" . $row["artMinVoorraad"] . "</td>";
			$txt .=  "<td>" . $row["artMaxVoorraad"] . "</td>"; 
			$txt .=  "<td>" . $row["artLocatie"] . "</td>";

			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='update_artikel.php?artid=$row[artid]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='delete.php?artid=$row[artid]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete artikel
 /**
  * Summary of deleteArtikel
  * @param mixed $artId
  * @return bool
  */
	public function deleteArtikel($artId){

		$sql = "delete from artikel where artid = '$artId'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateArtikel2($artId, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie){
		
		$sql = "UPDATE artikel 
				SET artOmschrijving = '$artOmschrijving', artInkoop = '$artInkoop', artVerkoop = '$artVerkoop', artVoorraad = '$artVoorraad', artMinVoorraad = '$artMinVoorraad', artMaxVoorraad = '$artMaxVoorraad', artLocatie = '$artLocatie' 
				WHERE artid = '$artId'";
	
		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;
	}
	
	
	public function updateArtikelSanitized($artId, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie){

		$sql = "update artikelen 
			set artOmschrijving = :artOmschrijving, artInkoop = :artInkoop, artVerkoop = :artVerkoop, artVoorraad = :artVoorraad, artMinVoorraad = :artMinVoorraad, artMaxVoorraad = :artMaxVoorraad, artLocatie = :artLocatie
			WHERE artid = :artid";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'artOmschrijving' => $artOmschrijving,
			'artInkoop' => $artInkoop,
			'artVerkoop' => $artVerkoop, 
			'artVoorraad' => $artVoorraad, 
			'artMinVoorraad' => $artMinVoorraad,
			'artMaxVoorraad' => $artMaxVoorraad,
			'artLocatie' => $artLocatie,
			'artid' => $artId
		]);  
	}
	public function updateArtikel(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update artikel
		set artOmschrijving = :artOmschrijving, artInkoop = :artInkoop, artVerkoop = :artVerkoop, artVoorraad = :artVoorraad, artMinVoorraad = :artMinVoorraad, artMaxVoorraad = :artMaxVoorraad, artLocatie = :artLocatie
		WHERE artid = :artid";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute((array)$this);
		return ($stmt->rowCount() == 1) ? true : false;		
	}
	
	/**
	 * Summary of BepMaxartikelId
	 * @return int
	 */
	private function BepMaxartikelId() : int {
		
	// Bepaal uniek nummer
	$sql="SELECT MAX(artid)+1 FROM artikel";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	public function insertArtikel(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		//
		$this->artId = $this->BepMaxartikelId();
		
		$sql = "INSERT INTO artikel (artid, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
		VALUES (:artid, :artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute((array)$this);
			
	}
	
	/**
	 * Summary of insertArtikel2
	 * @param mixed $artOmschrijving
	 * @param mixed $artInkoop
	 * @param mixed $artVerkoop
	 * @param mixed $artVoorraad
	 * @param mixed $artMinVoorraad
	 * @param mixed $artMaxVoorraad
	 * @param mixed $artLocatie
	 * @return void
	 */
	public function insertArtikel2($artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie){
		
		// query
		$artId = $this->BepMaxartikelId();
		$sql = "INSERT INTO artikel (artid, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
		VALUES (:artid, :artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
		
		// Prepare
		$stmt = self::$conn->prepare($sql);
		
		// Execute
		$stmt->execute([
			'artid'=>$artId,
			'artOmschrijving'=>$artOmschrijving,
			'artInkoop'=>$artInkoop,
			'artVerkoop'=>$artVerkoop, 
			'artVoorraad'=>$artVoorraad, 
			'artMinVoorraad'=>$artMinVoorraad,
			'artMaxVoorraad'=> $artMaxVoorraad,
			'artLocatie'=> $artLocatie
		]);
			
	}
}
?>