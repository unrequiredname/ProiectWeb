<?php
require_once __DIR__.'/../DBController.php';

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

$cart_count = 0;
if (!empty($cart_items)) {
    foreach ($cart_items as $item) {
        $cart_count += (int)$item['quantity'];
    }
}

?>