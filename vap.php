<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
</head>

<body>
        <?php
        

        include 'functionSQL.php';
        include 'table.php';

        $headers = getHeaderTable();
        $rows = getAllProduit();
        table($rows, getHeaderTable());
        

        ?>

        <a href=formulaire.php?id=0 >Ajouter une vapoteuse</a> 

</body>

</html>