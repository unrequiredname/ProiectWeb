<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" conntent="text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela de produse</h1>
<p><b>Toate inregistrarile din tabela de produse</b></p>

<?php
include __DIR__.'/../DBController.php';

$db = new DBController();

try{
    $products = $db->getDBResult("SELECT * FROM product ORDER BY id");

    if(!empty($products)){
        echo "<table border ='1' cellpadding='10'>";
        echo "<tr>
                <th>ID</th>
                <th>Nume Produs</th>
                <th>Cod Produs</th>
                <th>Imagine</th>
                <th>Descriere</th>
                <th>Categorie</th>
                <th></th>
                <th></th>
             </tr>";

        foreach($products as $row){
            echo "<tr>";
            echo "<td>".htmlspecialchars($row['id'])."</td>";
            echo "<td>".htmlspecialchars($row['name'])."</td>";
            echo "<td>".htmlspecialchars($row['code'])."</td>";
            echo "<td><img scr='".htmlspecialchars($row['image'])."'alt='Imagine' width='100'</td>";
            echo "<td>".htmlspecialchars($row['price'])."</td>";
            echo "<td>".htmlspecialchars($row['descriere'])."</td>";
            echo "<td>".htmlspecialchars($row['categorie'])."</td>";
            echo "<td><a href='admin_edit_product.php?id=".htmlspecialchars($row['id'])."'>Modificare</a></td>";
            echo "<td><a href='admin_delete_product.php?id=".htmlspecialchars($row['id'])."'>Stergere</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nu sunt inregistrari in tabela";
    }
} catch(PDOException $e){
    echo "Eroare la interogate:".htmlspecialchars($e->getMessage());
}
?>
</body>
</html>

<?php
