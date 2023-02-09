<?php
	include 'functionSQL.php';
	include 'table.php';
	$action = $_GET["action"];

	if ($action == "DELETE") {
		$id = $_GET["id"];
	} else {
		$id = $_GET["id"];
		$reference = $_GET["reference"];
		$nomArticle = $_GET["nomArticle"];
		$description = $_GET["description"];
		$prixAchat = $_GET["prixAchat"];
        $prixVente = $_GET["prixVente"];
        $quantiter = $_GET["quantiter"];
		
	}
	

	if ($action == "CREATE") {
		createProduit($reference, $nomArticle, $description, $prixAchat, $prixVente, $quantiter);

		echo "produit cree <br>";
		echo "<a href='index.php'>Liste des produits</a>";
		
	}
	
	if ($action == "UPDATE") {
		updateproduit($id, $reference, $nomArticle, $description, $prixAchat, $prixVente, $quantiter);
		echo "produit update <br>";
		echo "<a href='index.php'>Liste des produits</a>";
	}
	if ($action == "DELETE") {
		deleteproduit($id);
		echo "user delete <br>";
		echo "<a href='index.php'>Liste des produits</a>";
	}
	

	
?>