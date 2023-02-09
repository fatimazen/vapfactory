<?php 


include 'functionSQL.php';
include 'table.php';

$id = $_GET["id"];
	if ($id == 0) {
		$produit = getNewProduit();
		$action = "CREATE";
		$libelle = "Creer";
	} else {
		$user = readProduit($id);
		$action = "UPDATE";
		$libelle = "Mettre a jour";
	}
	

?>