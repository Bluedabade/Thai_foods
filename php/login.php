<?php
session_start();
include_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['pass']) ? trim($_POST['pass']) : null;

    if (empty($username) || empty($password)) {
        $_SESSION['login_fail'] = 'fail';
        header("Location: ../pages/admin/login.php");
        exit();
    }

    $sql_admin = "SELECT `adminId`, `adminPass` FROM `admin` WHERE `adminUsername` = ?";
    $stmt = $conn->prepare($sql_admin);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_admin = $stmt->get_result();
    $row_admin = $result_admin->fetch_assoc();

    if ($row_admin && password_verify($password, $row_admin['adminPass'])) {
        $_SESSION['login_success'] = 'success';
        $_SESSION['a_id'] = $row_admin['adminId'];
        header("Location: ../pages/admin/");
        exit();
    } else {
        $_SESSION['login_fail'] = 'fail';
        header("Location: ../pages/admin/login.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
