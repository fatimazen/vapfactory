<?php
   require_once('functionSQL.php');
   require_once('table.php');

$id = $_GET["id"] ?? null;

if(!empty($id)) {
    $sql = "DELETE FROM `produit` WHERE `produit`.`id` = $id;";
        $db = getDataBaseConnexion();
    $articleStmnt = $db->prepare($sql);
    $articleStmnt->execute();
}

header('Location: vap.php');
exit;

?>
