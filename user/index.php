<?php

session_start();
require_once __DIR__ . '/../DBController.php';
require_once '../user/cartCount.php';
global $cart_count;

$db = new DBController();

// Luăm toate categoriile DISTINCT + numărul de produse din fiecare
$categorii = $db->getDBResult("
    SELECT categorie, COUNT(*) AS total_produse
    FROM product
    GROUP BY categorie
    ORDER BY categorie
");

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Categorii produse</title>
    <link rel="stylesheet" href="../CSS/interfata.css">
</head>
<body>
<div class="container">
    <header>
        <h1>🛍️ Shop Online</h1>
        <nav>
            <button onclick="window.location.href='index.php'">Home</button>
            <div class="cart-icon">
                <button onclick="window.location.href='cart.php'" id="cartBtn">Coș</button>
                <span id="cartCount" class="cart-count"><?php echo(int)$cart_count;?></span>
            </div>
            <?php if(!isset($_SESSION['member_id'])) {?>
                <button onclick="window.location.href='login.php'">Login</button>
            <?php }else{?>
                <button onclick="window.location.href='logout.php'">Logout</button>
            <?php }?>
        </nav>
    </header>

    <div class="content">
        <h2 class="page-title">Categorii de produse</h2>
        <p class="page-subtitle">Alege o categorie pentru a vedea produsele disponibile.</p>

        <?php if (empty($categorii)): ?>
            <p class="empty-text">Momentan nu există produse în magazin.</p>
        <?php else: ?>
            <div class="category-grid">
                <?php foreach ($categorii as $cat): ?>
                    <div class="category-card">
                        <div class="category-name">
                            <?= htmlspecialchars($cat['categorie']) ?>
                        </div>
                        <div class="category-count">
                            <?= (int)$cat['total_produse'] ?> produs(e) în această categorie
                        </div>
                        <a href="prodCategorii.php?categorie=<?= urlencode($cat['categorie']) ?>">
                            Vezi produsele
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div>
<?php
include  __DIR__. '/../Lab8Email/index.php';
?>
</div>

</body>
</html>
