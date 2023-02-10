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
        $reference = strip_tags($_POST['reference']);
        $nomArticle = strip_tags($_POST['nomArticle']);
        $description = strip_tags($_POST['description']);
        $prixAchat = strip_tags($_POST['prixAchat']);
        $prixVente = strip_tags($_POST['prixVente']);
        $quantiter = strip_tags($_POST['quantiter']);
        

        $sql = 'INSERT INTO `produit` (`reference`, `nomArticle`, `description`, `prixAchat`, `prixVente`, `quantiter`) VALUES (:reference, :nomArticle, :description, :prixAchat, :prixVente, :quantiter);';
        $db= getDataBaseConnexion();
        $query = $db->prepare($sql);
        
        $query->bindValue('reference', $reference, PDO::PARAM_STR);
        $query->bindValue('nomArticle', $nomArticle, PDO::PARAM_STR);
        $query->bindValue('description', $description, PDO::PARAM_INT);
        $query->bindValue('prixAchat', $prixAchat, PDO::PARAM_INT);
        $query->bindValue('prixVente', $prixVente, PDO::PARAM_INT);
        $query->bindValue('quantiter', $quantiter, PDO::PARAM_INT);

        $query->execute();

        if ($_POST) {
            if (
                isset($_POST['id']) && !empty($_POST['id'])
                && isset($_POST['produit']) && !empty($_POST['produit'])
                && isset($_POST['prix']) && !empty($_POST['prix'])
                && isset($_POST['nombre']) && !empty($_POST['nombre'])
            ) {
                // On inclut la connexion à la base
                require_once('functionSQL.php');
                require_once('table.php');

                // On nettoie les données envoyées
                $id = strip_tags($_POST['id']);
                $produit = strip_tags($_POST['produit']);
                $prix = strip_tags($_POST['prix']);
                $nombre = strip_tags($_POST['nombre']);

                $sql = 'UPDATE `produit` SET `produit`=:produit, `prix`=:prix, `nombre`=:nombre WHERE `id`=:id;';

                $query = $row->prepare($sql);

                $query->bindValue('id', $id, PDO::PARAM_INT);
                $query->bindValue('produit', $produit, PDO::PARAM_STR);
                $query->bindValue('prix', $prix, PDO::PARAM_STR);
                $query->bindValue('nombre', $nombre, PDO::PARAM_INT);

                $query->execute();

                $_SESSION['message'] = "Produit modifié";

                header('Location: vap.php');
            } else {
                $_SESSION['erreur'] = "Le formulaire est incomplet";
            }
        }

        // Est-ce que l'id existe et n'est pas vide dans l'URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            require_once('connect.php');

            // On nettoie l'id envoyé
            $id = strip_tags($_GET['id']);

            $sql = 'SELECT * FROM `produit` WHERE `id` = :id;';

            // On prépare la requête
            $query = $row->prepare($sql);

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
         
         
<?php
        $_SESSION['message'] = "Produit ajouté";

        include 'functionSQL.php';
        include 'table.php';
        header('Location: vap.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>            

  
    <title>Ajouter un produit</title>

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
                <h1>Ajouter un produit</h1>
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
                    <button class="btn btn-primary">Envoyer</button>
                    <a href="vap.php" class="btn btn-primary">retour</a>
                </form>
            </section>
        </div>
    </main>
</body>

</html>