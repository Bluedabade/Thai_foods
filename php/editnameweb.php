<?php
session_start();
include_once("../db.php");

if (!isset($_SESSION['a_id'])) {
    header("Location: ../pages/admin/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $web_name = trim($_POST['websitename']);
    $a_id = $_SESSION['a_id'];

    $sql_web_name = "SELECT COUNT(*) as count FROM `website_name`";
    $stmt = $conn->prepare($sql_web_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_web_name = $result->fetch_assoc();

    if ($row_web_name['count'] == 0) {
        $sql_edit_web = "INSERT INTO `website_name` (`wsn_name`, `wsn_adminId`) VALUES (?, ?)";
    } else {
        $sql_edit_web = "UPDATE `website_name` SET `wsn_name` = ?, `wsn_adminId` = ? WHERE 1";
    }

    $stmt = $conn->prepare($sql_edit_web);
    $stmt->bind_param("si", $web_name, $a_id);

    if ($stmt->execute()) {
        $_SESSION['edit_web'] = "edit_web";
        header("Location: ../pages/admin/index.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
