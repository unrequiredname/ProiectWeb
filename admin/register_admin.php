<?php

require_once __DIR__.'/../DBController.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //criptare parola

    $db = new DBController();
    $query = "INSERT INTO admins(username, password) VALUES (?,?)";
    try{
        $db->updateDB($query, [$username, $password]);
        echo "Inregistrare reusita!";
    }catch(Exception $e){
        echo "Eroare:" . $e->getMessage();
    }
    header("Location: login_admin.php");
    exit;
}
?>

<form method="post">
    Username: <input type="text" name ="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
