<?php
session_start();
if(!isset($_SESSION['member_id'])){
    header("Location: login.php");
    exit;
}

//continutul paginii home
echo "Bine ai venit! <br>";
echo "<a href='index.php'>Mergi la magazin</a><br>";
echo "<a href='logout.php'>Logout</a>";
