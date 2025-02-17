<?php
session_start();
include_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $food = trim($_POST['food']);
    $cate = trim($_POST['cate']);
    $f_recipes = isset($_POST['food_how']) ? trim($_POST['food_how']) : null;

    if (!empty($_FILES['img']['name'])) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $temp = explode('.', $_FILES['img']['name']);
        $fileExtension = strtolower(end($temp));
        $filename = uniqid() . '.' . $fileExtension;
        $filepath = "../uploads/" . $filename;

        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error'] = "ไฟล์ต้องเป็น JPG, JPEG, PNG หรือ GIF เท่านั้น!";
            header("Location: ../pages/admin/food.php");
            exit();
        }

        if ($_FILES['img']['size'] > 2 * 1024 * 1024) {
            $_SESSION['error'] = "ไฟล์มีขนาดใหญ่เกินไป (ต้องไม่เกิน 2MB)";
            header("Location: ../pages/admin/food.php");
            exit();
        }

        if (!move_uploaded_file($_FILES['img']['tmp_name'], $filepath)) {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์!";
            header("Location: ../pages/admin/food.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "กรุณาอัปโหลดรูปภาพ!";
        header("Location: ../pages/admin/food.php");
        exit();
    }

    if ($f_recipes) {
        $sql_food = "INSERT INTO `food` (`f_name`, `f_img`, `f_cate`, `f_recipes`) VALUES (?, ?, ?, ?)";
    } else {
        $sql_food = "INSERT INTO `food` (`f_name`, `f_img`, `f_cate`) VALUES (?, ?, ?)";
    }

    $stmt = $conn->prepare($sql_food);

    if ($f_recipes) {
        $stmt->bind_param("ssss", $food, $filename, $cate, $f_recipes);
    } else {
        $stmt->bind_param("sss", $food, $filename, $cate);
    }

    if ($stmt->execute()) {
        $_SESSION['add_food'] = "add_food";
        header("Location: ../pages/admin/food.php");
        exit();
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $conn->error;
        header("Location: ../pages/admin/food.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
