<?php
session_start();
require_once __DIR__.'/../DBController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new DBController();
    $query = "SELECT id, password FROM users WHERE username = ?";
    $user = $db->getDBResult($query, [$username]);

    if($user && password_verify($password, $user[0]['password'])) {
        $_SESSION['member_id'] = $user[0]['id'];
        header("Location: home.php");
        exit;
    }else{
        echo "Invalid username or password";
    }
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<br>

<a href='register.php'>Inregistreaza-te</a>
