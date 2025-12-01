<?php
session_start();
require_once __DIR__.'/../DBController.php';

$db = new DBController();

//preluam produsele din baza de date
$products = $db->getDBResult("SELECT * FROM product");

//echo "<h1>Produse disponibile</h1>";
//echo "<ul>";
//foreach ($products as $product) {
//    echo "<li>" . htmlspecialchars($product['name']) . " - $" . htmlspecialchars($product['price'])
//        . " <a href='addToCart.php?product_id=" . $product['id'] . "'>Adaugă în coș</a></li>";
//}?>
<!--//echo "<br>";-->
<!--//echo "<a href=Vizualizare.php>>>Mergi pentru a edita produsele<<</a></br>";-->
<!--//-->
<!--//echo "<a href=Vizualizare.php>Index</a><br/>-->
<!--//        <a href=admin_home.php>Home</a><br/><br/>-->
<!--//        <a href=logout_admin.php>Logout</a>";-->
<!--//-->
<!--//echo "</ul>";-->

<!DOCTYPE HTML>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Administrare Produse</title>
    <link rel="stylesheet" href="../CSS/interfataAdmin.css">
    <style>
    </style>
</head>
<body>

<div class="admin-header">
    <h2>🛠️ Panou Admin</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="Vizualizare.php">Produse</a>
            <a href="admin_add_product.php">Adauga un produs nou</a>
            <?php if(!isset($_SESSION['member_id'])) {?>
                <a href="login_admin.php">Logout</a>
            <?php }else{?>
                <a href="logout_admin.php">Logout</a>
            <?php }?>
        </nav>
</div>

    <div class="admin-container">
        <h1 class="admin-title">Produse disponibile</h1>

        <!-- BUTOANE GESTIUNE -->
        <div class="admin-toolbar">
            <a class="admin-toolbar-btn" href="admin_add_product.php">➕ Adaugă Produs</a>
        </div>

        <!-- GRID PRODUSE -->
        <div class="admin-products-grid">
            <?php foreach ($products as $product): ?>
                <div class="admin-product-card">
                    <div>
                        <div class="admin-product-img">
                            <?php if (!empty($product['image'])): ?>
                                <img src="<?= htmlspecialchars($product['image']) ?>"
                                     alt="Imagine produs"
                                     class="admin-product-image">
                            <?php else: ?>
                                <span class="no-image">📦Fără imagine</span>
                            <?php endif; ?>
                        </div>


                    <div class="admin-product-info">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="admin-product-category">Categorie: <?= htmlspecialchars($product['categorie']) ?></p>
                        <p class="admin-product-desc"><?= htmlspecialchars($product['descriere']) ?></p>
                        <div class="admin-product-price"><?= htmlspecialchars($product['price']) ?> lei</div>
                    </div>

                    <!-- BUTOANE EDIT SI DELETE -->
                    <div class="admin-card-btns">
                        <a class="admin-btn admin-btn-edit"
                           href="admin_edit_product.php?id=<?= $product['id'] ?>">Editează</a>

                        <a class="admin-btn admin-btn-delete"
                           href="admin_delete_product.php?id=<?= $product['id'] ?>"
                           onclick="return confirm('Sigur vrei să ștergi acest produs?');">Șterge</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>