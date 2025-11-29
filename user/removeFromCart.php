<?php
session_start();
require_once __DIR__.'/../DBController.php';

if(!isset($_SESSION['member_id'])){
    header("Location: login.php");
    exit;
}

$db = new DBController();
$member_id = $_SESSION['member_id'];

if(isset($_GET['cart_id']) && is_numeric($_GET['cart_id'])){
    $cart_id = $_GET['cart_id'];

    $db->updateDB("DELETE FROM cart WHERE id = ? AND member_id = ?", [$cart_id, $member_id]);
}

header("Location: cart.php");
exit;
?>
