<?php
session_start();
require_once __DIR__.'/../DBController.php';

if(!isset($_SESSION['member_id'])){
    header("Location: login.php");
    exit;
}

$db = new DBController();
$member_id = $_SESSION['member_id'];

//golim cosul
$db->updateDB("DELETE FROM cart WHERE member_id = ?", [$member_id]);

header("Location: cart.php");
exit;
?>
