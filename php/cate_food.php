<?php
session_start();
include_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cate = isset($_POST['cate']) ? trim($_POST['cate']) : null;
    $type = isset($_POST['type']) ? trim($_POST['type']) : null;

    if (empty($cate) || empty($type)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน!";
        header("Location: ../pages/admin/cate_food.php");
        exit();
    }

    $sql_cate = "INSERT INTO `food_cate` (`ft_cate`, `ft_type`) VALUES (?, ?)";
    $stmt = $conn->prepare($sql_cate);
    $stmt->bind_param("ss", $cate, $type);

    if ($stmt->execute()) {
        $_SESSION['add_cate'] = "add_cate";
        header("Location: ../pages/admin/cate_food.php");
        exit();
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $conn->error;
        header("Location: ../pages/admin/cate_food.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
