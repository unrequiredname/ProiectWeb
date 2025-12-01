<?php
session_start();
require_once __DIR__.'/../DBController.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new DBController();
    $query = "SELECT id, password FROM users WHERE username = ?";
    $user = $db->getDBResult($query, [$username]);

    if($user && password_verify($password, $user[0]['password'])) {
        $_SESSION['member_id'] = $user[0]['id'];
        header("Location: index.php");
        exit;
    }else{
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/interfata.css">
</head>
<body>

<div class="container">
    <header>
        <h1>🛍️ Shop Online</h1>
        <nav>
            <a href="index.php">Categorii</a>
            <a href="cart.php" class="cart-icon">Coș</a>

            <?php if (isset($_SESSION['member_id'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="content">
        <div class="login-box">

            <h2>Autentificare</h2>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form-group">
                    <label>Parolă:</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit">Login</button>
            </form>

            <p style="margin-top: 15px; text-align:center;">
                Nu ai cont? <a href="register.php">Înregistrează-te aici</a>
            </p>

        </div>
    </div>

</div>

</body>
</html>
