<?php


include 'functionSQL.php';
include 'table.php';

$id = $_GET["id"];
if ($id == 0) {
    $produit = getNewProduit();
    $action = "CREATE";
    $libelle = "Creer";
} else {
    $produit = readProduit($id);
    $action = "UPDATE";
    $libelle = "Mettre a jour";
}



?>
<html>
<header>
    <link rel="stylesheet" href="style.css">
</header>

<body>


    <form action="createUpdate.php" method="get">
        <p>
            <a href="index.php">Liste des produits</a>

            <input type="hidden" name="id" value="<?php echo $produit['id'];  ?>" />
            <input type="hidden" name="action" value="<?php echo $action;  ?>" />
        <div>
            <label for="reference">reference :</label>
            <input type="text" id="reference" name="reference" value="<?php echo $produit['reference'];  ?>">
        </div>
        <div>
            <label for="nomArticle">nomArticle</label>
            <input type="text" id="nomArticle" name="nomArticle" value="<?php echo $produit['nomArticle'];  ?>">
        </div>

        <div>
            <label for="description">description:</label>
            <input type="text" id="description" name="description" value="<?php echo $produit['description'];  ?>">
        </div>

        <div>
            <label for="prixAchat">prixAchat:</label>
            <input type="text" id="prixAchat" name="prixAchat" value="<?php echo $produit['prixAchat'];  ?>">
        </div>

        <div>
            <label for="prixVente">prixVente:</label>
            <input type="text" id="prixVente" name="prixVente" value="<?php echo $produit['prixVente'];  ?>">
        </div>

        <div>
            <label for="quantiter">quantiter :</label>
            <textarea id="quantiter" name="quantiter" placeholder="<?php echo $produit['quantiter'];  ?>"></textarea>
        </div>


        <div class="button">
            <button type="submit"><?php echo $libelle;  ?></button>
        </div>
        </p>
    </form>
    <br>

    <?php if ($action != "CREATE") { ?>
        <form action="createUpdate.php" method="get">
            <input type="hidden" name="action" value="DELETE" />
            <input type="hidden" name="id" value="<?php echo $produit['id'];  ?>" />
            <p>
            <div class="button">
                <button type="submit">Supprimer</button>

            </div>
            </p>
        </form>
    <?php } ?>

</body>

</html>