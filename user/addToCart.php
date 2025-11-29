<?php
session_start();
require_once __DIR__.'/../DBController.php';

if(!isset($_SESSION['member_id'])){
    header("Location: login.php");
    exit;
}
$db = new DBController();
$product_id = $_GET['product_id'];
$member_id = $_SESSION['member_id'];
$quantity = 1; // presupunem ca adaugam intotdeauna o cant de 1

//adaugam in cos
$query = "INSERT INTO cart(product_id, quantity, member_id) VALUES(?, ?, ?)";
$db->updateDB($query, [$product_id, $quantity, $member_id]);

header("Location: index.php");
exit;
?>
