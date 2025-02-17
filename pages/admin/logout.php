<?php 
session_start();
unset($_SESSION['a_id']);
$_SESSION['logout'] = 'logout';
header("Location: ../../index.php");

?>