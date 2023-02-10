<?php

function table($rows, $headers)
{
?>
    <table >

        <?php
        if (!empty($_SESSION['erreur'])) {
            echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
            $_SESSION['erreur'] = "";
        }
        ?>
        <?php
        if (!empty($_SESSION['message'])) {
            echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
            $_SESSION['message'] = "";
        }
        ?>


        <tr class="headerTab">
            <?php foreach ($headers as $header) : ?>
                <th><?php echo $header; ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($rows as $row) : ?>
            <tr>
                <?php for ($i = 0; $i < count($headers); $i++) : ?>
                    <?php if ($i == 0) { ?>
                        <td><?php echo '<a href=formulaire.php?id=' . $row[$i] . '>' . $row[$i] . '</a>'; ?></td>
                    <?php } else { ?>
                        <td><?php echo $row[$i]; ?></td>
                    <?php } ?>
                <?php endfor; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
    <a href="editer.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Modifier</a>
    <a href="delete.php?id=<?=$row['id']?>" class="btn btn-primary">supprimer </a>

<?php
}
?>
<?php
function getHeaderTable()
{
    $headers = array();
    $headers[] = "id";
    $headers[] = "reference";
    $headers[] = "nomArticle";
    $headers[] = "description";
    $headers[] = "prixAchat";
    $headers[] = "prixVente";
    $headers[] = "quantiter";


    return $headers;
}
?>