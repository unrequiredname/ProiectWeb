<?php
session_start();
require_once __DIR__ . '/../DBController.php';
require_once '../user/cartCount.php';
global $cart_count;

$db = new DBController();

if (!isset($_GET['categorie']) || $_GET['categorie'] === '') {
    $categorie = '';
    $produse = [];
} else {
    $categorie = $_GET['categorie'];
    $produse = $db->getDBResult(
        "SELECT * FROM product WHERE categorie = ?",
        [$categorie]
    );
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Produse - <?= htmlspecialchars($categorie ?: 'Fără categorie') ?></title>
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
        <h2 class="page-title">
            Produse în categoria: <?= $categorie ? htmlspecialchars($categorie) : 'Nespecificată' ?>
        </h2>
        <p class="page-subtitle">
            Alege produsul dorit și adaugă-l în coș.
        </p>

        <div class="back-link">
            <a href="categorii.php">← Înapoi la toate categoriile</a>
        </div>

        <?php if (!$categorie): ?>
            <p class="empty-text">Nu a fost specificată o categorie.</p>
        <?php elseif (empty($produse)): ?>
            <p class="empty-text">Nu există produse în această categorie momentan.</p>
        <?php else: ?>
            <div class="products-grid">
                <?php foreach ($produse as $prod): ?>
                    <div class="product-card">
                        <div>
                            <div class="product-img">
                                <?php if (!empty($prod['image'])): ?>
                                    <img src="<?= htmlspecialchars($prod['image']) ?>"
                                         alt="Imagine produs"
                                         class="product-image">
                                <?php else: ?>
                                    <span class="no-image">📦Fără imagine</span>
                                <?php endif; ?>
                            </div>

                            <div class="product-info">
                                <h3><?= htmlspecialchars($prod['name']) ?></h3>
                                <div class="product-category">
                                    Categorie: <?= htmlspecialchars($prod['categorie']) ?>
                                </div>
                                <div class="product-desc">
                                    <?= htmlspecialchars($prod['descriere']) ?>
                                </div>
                                <div class="product-price">
                                    <?= htmlspecialchars(number_format($prod['price'], 2)) ?> lei
                                </div>
                            </div>
                        </div>

                        <a class="add-to-cart-btn"
                           href="addToCart.php?product_id=<?= (int)$prod['id'] ?>">
                            Adaugă în coș
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
