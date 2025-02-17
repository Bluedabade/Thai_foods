<?php
include("../../db.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_regenerate_id(true);

if (!$_SESSION['a_id']) {
    $_SESSION['login_empty'] = 'empty';
    
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    
    header("Location:../../index.php");
    exit();
}
?>
