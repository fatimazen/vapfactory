<!DOCTYPE html>
<html lang="fr">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="vap.css">
        <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>VAP FACTORY</title>
</head>

<body>
        <div class="header_top">
                <header class="nomSite">
                        <h1>VAP FACTORY</h1>
                </header>

                <div class="titreTab">
                        <h2>INVENTAIRE</h2>
                </div>
        </div>

        <div class="backTab">
                <div class="frontTab">

                        <?php

                        require_once('functionSQL.php');
                        require_once('table.php');

                        $headers = getHeaderTable();
                        $rows = getAllProduit();
                        table($rows, getHeaderTable());


                        $id = $_GET["id"] ?? 0;
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


                        <form action="createUpdate.php" method="get">
                                <p>
                                        <input type="hidden" name="id" value="<?php echo $produit['id'];  ?>" />
                                        <input type="hidden" name="action" value="<?php echo $action;  ?>" />
                                </p>
                        </form>
                        <br>

                        <?php if ($action != "CREATE") { ?>
                                <form action="createUpdate.php" method="get">
                                        <input type="hidden" name="action" value="DELETE" />
                                        <input type="hidden" name="id" value="<?php echo $produit['id'];  ?>" />
                                        <p>
                                        <div class="button">
                                                <button type="submit">Modifier</button>
                                                <button type="submit" class="btn btn-primary w-100"><?= !empty($id) ? "Modifier" : "Ajouter" ?></button>
                                                <div>
                                                </div>
                                        </div>
                                        </p>
                                </form>
                        <?php } ?>

                </div>
        </div>
</body>

</html>