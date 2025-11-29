<?php
session_start();
if(!isset($_SESSION['member_id'])){
    header("Location: login_admin.php");
    exit;
}

//continutul paginii home
echo "Bine ai venit! <br>";
echo "<a href='admin_add_product.php'>Adaugare produse</a><br>";
echo "<a href='index.php'>Index</a><br>";


