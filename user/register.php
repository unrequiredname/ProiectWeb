<?php

require_once __DIR__.'/../DBController.php'; // exista un controller pt baza de date

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //criptare parola

    $db = new DBController();
    $query = "INSERT INTO users(username, password) VALUES (?,?)";
    try{
        $db->updateDB($query, [$username, $password]);
        echo "Inregistrare reusita!";
    }catch(Exception $e){
        echo "Eroare:" . $e->getMessage();
    }
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Înregistrare</title>
    <link rel="stylesheet" href="../CSS/interfata.css">
</head>
<body>

<div class="container">

    <?php
    // dacă ai un header comun, folosește:
    // include 'header.php';
    ?>
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
            <h2>Înregistrare cont</h2>

            <form method="post">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form-group">
                    <label>Parolă:</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit">Register</button>
            </form>

            <p style="margin-top: 15px; text-align:center;">
                Ai deja cont? <a href="login.php">Autentifică-te aici</a>
            </p>
        </div>
    </div>

</div>
</body>
</html>
