<?php

function table($rows, $headers)
{
?>
    <table border="1">
        <tr>
            <?php foreach ($headers as $header): ?>
                <th><?php echo $header; ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($rows as $row): ?>
            <tr>
                <?php for ($i = 0; $i < count($headers); $i++): ?>
                    <?php if ($i == 0){ ?>
                        <td><?php echo '<a href=formulaire.php?id='.$row[$i].'>'.$row[$i].'</a>'; ?></td>
                    <?php } else { ?>
                        <td><?php echo $row[$i]; ?></td>
                    <?php } ?>
                <?php endfor; ?>
            </tr>
        <?php endforeach; ?>
    </table>


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