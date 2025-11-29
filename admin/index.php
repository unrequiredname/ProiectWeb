<?php
session_start();
require_once __DIR__.'/../DBController.php';

$db = new DBController();

//preluam produsele din baza de date
$products = $db->getDBResult("SELECT * FROM product");

echo "<h1>Produse disponibile</h1>";
echo "<ul>";
foreach ($products as $product) {
    echo "<li>" . htmlspecialchars($product['name']) . " - $" . htmlspecialchars($product['price'])
        . " <a href='addToCart.php?product_id=" . $product['id'] . "'>Adaugă în coș</a></li>";
}
echo "<br>";
echo "<a href=Vizualizare.php>>>Mergi pentru a edita produsele<<</a></br>";

echo "<a href=admin_home.php> HOME </a></br>";

echo "</ul>";
