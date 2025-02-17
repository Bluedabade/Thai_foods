<?php
session_start();
include_once("../db.php");

if (!isset($_SESSION['a_id'])) {
    header("Location: ../pages/admin/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $a_id = $_SESSION['a_id'];
    $thai_culture = trim($_POST['thai_culture']);

    $sqL_tcd = "SELECT * FROM `thaifoodculture` LIMIT 1";
    $result_tcd = $conn->query($sqL_tcd);
    $row_tcd = $result_tcd->fetch_assoc();

    $filename = null;
    $uploadOk = true;

    if (!empty($_FILES['img']['name'])) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $temp = explode('.', $_FILES['img']['name']);
        $fileExtension = strtolower(end($temp));
        $filename = uniqid() . '.' . $fileExtension;
        $filepath = "../uploads/" . $filename;

        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error'] = "ไฟล์ต้องเป็น JPG, JPEG, PNG หรือ GIF เท่านั้น!";
            header("Location: ../pages/admin/index.php");
            exit();
        }

        if ($_FILES['img']['size'] > 2 * 1024 * 1024) {
            $_SESSION['error'] = "ไฟล์มีขนาดใหญ่เกินไป (ต้องไม่เกิน 2MB)";
            header("Location: ../pages/admin/index.php");
            exit();
        }

        if (!move_uploaded_file($_FILES['img']['tmp_name'], $filepath)) {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์!";
            header("Location: ../pages/admin/index.php");
            exit();
        }
    }

    if (empty($row_tcd)) {
        $sql_tc = "INSERT INTO `thaifoodculture` (`tfc_Content`, `tfc_Img`, `tfc_adminId`) VALUES (?, ?, ?)";
    } else {
        if ($filename) {
            $sql_tc = "UPDATE `thaifoodculture` SET `tfc_Content` = ?, `tfc_Img` = ?, `tfc_adminId` = ? WHERE 1";
        } else {
            $sql_tc = "UPDATE `thaifoodculture` SET `tfc_Content` = ?, `tfc_adminId` = ? WHERE 1";
        }
    }

    $stmt = $conn->prepare($sql_tc);

    if ($filename) {
        $stmt->bind_param("ssi", $thai_culture, $filename, $a_id);
    } else {
        $stmt->bind_param("si", $thai_culture, $a_id);
    }

    if ($stmt->execute()) {
        $_SESSION['edit_tc'] = "edit_tc";
        header("Location: ../pages/admin/index.php");
        exit();
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $conn->error;
        header("Location: ../pages/admin/index.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
