<?php
session_start();
require_once __DIR__.'/../DBController.php';
require_once '../user/cartCount.php';
global $cart_count;

if(!isset($_SESSION['member_id'])){
    header("Location: login.php");
    exit;
}

$db = new DBController();
$member_id = $_SESSION['member_id'];
//echo $member_id;
$cart_items = $db->getDBResult("SELECT p.name, p.price, c.quantity, c.id, c.product_id 
                                FROM cart c JOIN product p ON c.product_id = p.id 
                                WHERE c.member_id = ?", [$member_id]);

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Coș de cumpărături</title>
    <link rel="stylesheet" href="../CSS/interfata.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Coș de cumpărături</h1>
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
    <div class="content cart-content">
    <?php if (empty($cart_items)): ?>
        <p>Coșul este gol.</p>
        <div class="links">
            <a href="index.php">Înapoi la magazin</a>
        </div>
    <?php else: ?>
        <?php
        $total = 0;
        foreach ($cart_items as $item):
            $total += $item['price'] * $item['quantity'];
        ?>
            <div class="cart-item">
                <div class="cart-item-info">
                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                    <p>Preț: <?= htmlspecialchars(number_format($item['price'], 2)) ?> lei</p>
                    <p>Cantitate curentă: <?= (int)$item['quantity'] ?></p>
                </div>
                <div class="cart-item-actions">
                    <form method="post" action="updateCart.php" class="cart-item-actions">
                        <input type="number" name="quantity"
                               value="<?= (int)$item['quantity'] ?>" min="1">

                        <input type="hidden" name="cart_id" value="<?= (int)$item['id'] ?>">
                        <button class="update-btn" type="submit">Actualizează</button>
                    </form>
                    <a class="remove-btn"
                       href="removeFromCart.php?cart_id=<?= (int)$item['id'] ?>">Scoate</a>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="total">
            Total: <?= number_format($total, 2) ?> lei
        </div>
            <div class="back-link">
                <a href="index.php">Înapoi la magazin</a>
                <a href="emptyCart.php">Golește coșul</a>
            </div>
    <?php endif; ?>
    </div>
</div>
</body>
</html>