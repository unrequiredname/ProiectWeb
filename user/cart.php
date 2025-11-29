<?php
session_start();
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

echo "<h1>Cos de cumparaturi</h1>";
foreach($cart_items as $item){
    echo"<div>" . htmlspecialchars($item['name']) . " - $ " . htmlspecialchars($item['price']).
        //. " x " . $item['quantity']
        "<form method='post' action='updateCart.php'>
        <input type='number' name='quantity' value='".$item['quantity']. "'min='1'/>
        <input type='hidden' name='cart_id' value='".$item['id']."'/>
        <input type='submit' value='Actualizeaza'/>
        </form>
        <a href='removeFromCart.php?cart_id=".$item['id']."'>Scoate</a></div></br></br>";
}
echo"<a href='emptyCart.php'>Goleste cosul</a></br></br>";
echo"<a href='index.php'>Magazin</a>";
?>