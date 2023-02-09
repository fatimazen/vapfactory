<?php

// fonction de connextion
function getDataBaseConnexion()
{
    // definir des constante environnement
    define("DBHOST", "localhost");
    define("DBUSER", "admin");
    define("DBPASS", "adminpwd");
    define("DBNAME", "vapfactory");

    // pour pdo il faut avoir une dsn data source name de connexion

    $dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

    // on ce connecte à la base
    try {
        // on crée un elemnet de pdo que l ont met dans une variable en instancie PDO
        $db = new PDO($dsn, DBUSER, DBPASS);

        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // on s' assure d ' envoyer les données UTF8
        $db->exec("SET NAMES utf8");
        return $db;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// fonction pour selectionner ts les produits
function getAllProduit()
{
    $con = getDataBaseConnexion();
    $requete = 'SELECT * FROM produit';
    $rows = $con->query($requete);
    return $rows;
}

// fonction pour un produit
function readProduit($id)
{

    $con = getDataBaseConnexion();
    $requete = "SELECT * FROM produit WHERE id ='$id'";
    $stmt = $con->query($requete);
    $row = $stmt->fetchAll();
    if (!empty($row)) {
        return $row[0];
    }
}

// fonction ajouter les produits
function createProduit($reference, $nomArticle, $description, $prixAchat, $prixVente, $quantiter)
{



    try {
        $con = getDataBaseConnexion();
        $sql = "INSERT INTO produit (reference, nomArticle, description, prixAchat, prixVente, quantiter)
        VALUES ('$reference', '$nomArticle', '$description', '$prixAchat', '$prixVente' , '$quantiter')";
        $con->exec($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

// mise a jour des produits
function updateProduit($id, $reference, $nomArticle, $description, $prixAchat, $prixVente, $quantiter)
{
    try {
        $con = getDataBaseConnexion();
        $requete = "UPDATE produit SET
                    reference ='$reference', 
                    nomArticle = '$nomArticle', 
                    description = '$description', 
                    prixAchat = '$prixAchat', 
                    prixVente ='$prixVente' , 
                    quantiter = '$quantiter'
                    WHERE id = '$id'";
        $stmt = $con->query($requete);
        return $stmt;

    } catch (PDOException $e) {
        echo $requete . "<br>" . $e->getMessage();
    }
}
// fonction pour supprimer les produits
function deleteProduit($id)
{
    try {
        $con = getDataBaseConnexion();
        $requete = "DELETE from produit where id = '$id'";

        $stmt = $con->query($requete);
        return $stmt;
    } catch (PDOException $e) {
        echo $requete . "<br>" . $e->getMessage();

    }
}

function getNewProduit() {
    $produit['id'] = "";
    $produit['reference'] = "";
    $produit['nomArticle'] = "";
    $produit['PrixAchat'] = "";
    $produit['description'] = "";
    $produit['prixVente'] = "";
    $produit['quantiter'] = "";

    return $produit;

    
}
