<?php
require_once('functionSQL.php');
require_once('table.php');

if ($_POST) {
    if (
        isset($_POST['reference']) && !empty($_POST['reference'])
        && isset($_POST['nomArticle']) && !empty($_POST['nomArticle'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['prixAchat']) && !empty($_POST['prixAchat'])
        && isset($_POST['prixVente']) && !empty($_POST['prixVente'])
        && isset($_POST['quantiter']) && !empty($_POST['quantiter'])
    ) {
        // On inclut la connexion à la base
        require_once('functionSQL.php');
        require_once('table.php');

        // On nettoie les données envoyées
        $id = strip_tags($_GET['id']) ?? null;
        $reference = strip_tags($_POST['reference']) ?? null;
        $nomArticle = strip_tags($_POST['nomArticle']) ?? null;
        $description = strip_tags($_POST['description']) ?? null;
        $prixAchat = strip_tags($_POST['prixAchat']) ?? null;
        $prixVente = strip_tags($_POST['prixVente']) ?? null;
        $quantiter = strip_tags($_POST['quantiter']) ?? null;

        $sql = 'UPDATE `produit` SET `reference`=:reference, `nomArticle`=:nomArticle, `description`=:description, `prixAchat`=:prixAchat,`prixVente`=:prixVente,`quantiter`=:quantiter WHERE `id`=:id ;';
        $db = getDataBaseConnexion();
        $query = $db->prepare($sql);

        $query->bindValue('id', $id, PDO::PARAM_STR);
        $query->bindValue('reference', $reference, PDO::PARAM_STR);
        $query->bindValue('nomArticle', $nomArticle, PDO::PARAM_STR);
        $query->bindValue('description', $description, PDO::PARAM_INT);
        $query->bindValue('prixAchat', $prixAchat, PDO::PARAM_INT);
        $query->bindValue('prixVente', $prixVente, PDO::PARAM_INT);
        $query->bindValue('quantiter', $quantiter, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Produit modifié";
        require_once('functionSQL.php');
        require_once('table.php');

        header('Location: vap.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('functionSQL.php');
    require_once('table.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `produit` WHERE `id` = :id;';

    // On prépare la requête
    $db = getDataBaseConnexion();
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On vérifie si le produit existe
    if (!$produit) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: vap.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: vap.php');
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Modifier un produit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <h1>Modifier un produit</h1>
                <form method="post">
                    <div class="form-group">

                        <input type="hidden" name="id" value="<?php $produit['id'];  ?>" />
                        <input type="hidden" name="action" value="<?php echo $action;  ?>" />
                    </div>

                    <label for="reference">Référence</label>
                    <input type="text" id="reference" name="reference" class="form-control" value="<?= $produit['reference'] ?>">
        </div>
        <div class="form-group">
            <label for="nomArticle">Nom de l' article</label>
            <input type="text" id="nomArticle" name="nomArticle" class="form-control" value="<?= $produit['nomArticle'] ?>">

        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="<?= $produit['description'] ?>">

        </div>
        <div class="form-group">
            <label for="prixAchat">Prix d'achat unitaire</label>
            <input type="text" id="prixAchat" name="prixAchat" class="form-control" value="<?= $produit['prixAchat'] ?>">

        </div>

        <div class="form-group">
            <label for="prixVente">Prix de vente unitaire</label>
            <input type="text" id="prixVente" name="prixVente" class="form-control" value="<?= $produit['prixVente'] ?>">

        </div>

        <div class="form-group">
            <label for="quantiter">Quantité</label>
            <input type="text" id="quantiter" name="quantiter" class="form-control" value="<?= $produit['quantiter'] ?>">

        </div>

        <div>
            <button type="submit" class="btn btn-primary w-100"><?= !empty($id) ? "Modifier" : "Ajouter" ?></button>
        </div>
        </form>
        </section>
        </div>
    </main>
</body>

</html>