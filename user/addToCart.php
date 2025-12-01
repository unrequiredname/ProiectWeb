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

$checkProduct = $db -> getDBResult("SELECT id, quantity FROM cart where product_id = ? and member_id = ?", [$product_id,$member_id]);


if($checkProduct){
    $cart_id = $checkProduct[0]['id'];
    $quantity = $checkProduct[0]['quantity'];
    $toAdd = 1;

    $db->updateDB('UPDATE cart SET quantity = quantity + ? WHERE id = ?', [$toAdd, $cart_id]);
}else {
    $query = "INSERT INTO cart(product_id, quantity, member_id) VALUES(?, ?, ?)";
    $db->updateDB($query, [$product_id, $quantity, $member_id]);
}

header("Location: cart.php");
exit;
?>
