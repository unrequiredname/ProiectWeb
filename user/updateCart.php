<?php
session_start();
require_once __DIR__.'/../DBController.php';

if(!isset($_SESSION['member_id'])){
    header("Location: login.php");
    exit;
}

$db = new DBController();
$cart_id = $_POST['cart_id'];
$quantity = $_POST['quantity'];

if($quantity > 0){
    $query = "UPDATE cart SET quantity = ? WHERE id = ?";
    $db->updateDB($query, [$quantity , $cart_id]);
} else {
    //eliminam produsul din cos daca cant este 0 sau mai putin
    $query = "DELETE FROM cart WHERE id = ?";
    $db->updateDB($query, [$cart_id]);
}

header("Location: cart.php");
exit;
?>