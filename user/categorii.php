<?php
session_start();
require_once __DIR__ . '/../DBController.php';

$db = new DBController();

// luăm categoriile DISTINCT + număr de produse
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 26px;
        }

        nav {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        nav a {
            background: rgba(255,255,255,0.15);
            border: 2px solid white;
            color: white;
            padding: 8px 18px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }

        nav a:hover {
            background: white;
            color: #667eea;
        }

        .content {
            padding: 40px;
            min-height: 400px;
        }

        h2.page-title {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 25px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .category-card {
            background: #f8f9ff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(255,255,255,0.9), transparent);
            opacity: 0.6;
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        .category-name {
            font-size: 20px;
            font-weight: 700;
            color: #4b4b7a;
            margin-bottom: 8px;
        }

        .category-count {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .category-card a {
            display: inline-block;
            padding: 8px 14px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .category-card a:hover {
            background: #764ba2;
        }

        .empty-text {
            text-align: center;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>🛍️ Shop Online</h1>
        <nav>
            <a href="categorii.php">Categorii</a>
            <a href="cart.php">Coș</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <div class="content">
        <h2 class="page-title">Categorii de produse</h2>

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
</body>
</html>
