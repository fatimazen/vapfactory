<?php
	 require_once('functionSQL.php');
	 require_once('table.php');
	$action = $_GET["action"];
    

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
  
	require_once('functionSQL.php');
	require_once('table.php');

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
		echo "<a href='vap.php'>Liste des produits</a>";
		
	}
	
	if ($action == "UPDATE") {
		updateproduit($id, $reference, $nomArticle, $description, $prixAchat, $prixVente, $quantiter);
		echo "produit update <br>";
		 echo "<a href='vap.php'>modifier</a>";
       
	}
	if ($action == "DELETE") {
		deleteproduit($id);
		echo "produit delete <br>";
		echo "<a href='vap.php'>suprimer produits</a>";
	}
	
}
if(!empty($reference) && !empty($nomArticle) && !empty($description) && !empty($prixAchat) && !empty($prixVente) && !empty($quantiter)) {
    if(!empty($id)) {
        $sql = "UPDATE produit SET reference = '$reference', description = '$description', prixAchat = '$prixAchat', prixVente = `$prixVente`, quantier = `$quantiter`
		 =  WHERE produit.id = $id;";
    } else {
        $sql = "INSERT INTO produit (`id`, `reference`, `nomArticle`,`description`, `prixAchat`, `prixVente`, `quantiter`) VALUES (NULL, '$reference', '$nomArticle', '$description', '$prixAchat', '$prixVente' ,'$quantiter');";
    }
    
	require_once('functionSQL.php');
	require_once('table.php');
    header('Location: vap.php');
    exit;
}
?>
<h1>Modifier un produit</h1>
                <form method="post">
                    <div class="form-group">

                        <input type="hidden" name="id" value="<?php $produit['id'];  ?>" />
                        <input type="hidden" name="action" value="<?php echo $action;  ?>" />
                    </div>
                    <div>
                        <label for="reference">Référence</label>
                        <input type="text" id="reference" name="reference" class="form-control">
                    </div>
                    <div>
                        <label for="nomArticle">Nom de l'article</label>
                        <input type="text" id="nomArticle" name="nomArticle" class="form-control">
                    </div>
                    <div>
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control">
                    </div>
                    <div>
                        <label for="prixAchat">Prix d'achat unitaire</label>
                        <input type="number" id="prixAchat" name="prixAchat" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="prixVente">Prix de vente unitaire</label>
                        <input type="number" id="prixVente" name="prixVente" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="quantiter">Quantité de stock</label>
                        <input type="number" id="quantiter" name="quantiter" class="form-control">
                    </div>
                  
                </form>
            </section>
        </div>
    </main>
</body>

</html>