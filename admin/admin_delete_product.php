<?php
include __DIR__.'/../DBController.php';

$db = new DBController();

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    if($products = $db->updateDB("DELETE FROM product WHERE id = ?", [$id])){
        header('Location: Vizualizare.php');
    } else {
        echo "ERROR: Nu poate fi eliminat";
    }
    echo "Inregistrarea a fost stearsa";
}
echo "<p><a href='Vizualizare.php'>Index</a></p>";
?>