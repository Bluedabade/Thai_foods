<?php
session_start();
include_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['pass']) ? password_hash(trim($_POST['pass']), PASSWORD_BCRYPT) : null;

    if (empty($name) || empty($username) || empty($password)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน!";
        header("Location: ../register.php");
        exit();
    }

    $filename = null;
    if (!empty($_FILES['img']['name'])) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $temp = explode('.', $_FILES['img']['name']);
        $fileExtension = strtolower(end($temp));
        $filename = uniqid() . '.' . $fileExtension;
        $filepath = "../uploads/" . $filename;

        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error'] = "ไฟล์ต้องเป็น JPG, JPEG, PNG หรือ GIF เท่านั้น!";
            header("Location: ../register.php");
            exit();
        }

        if ($_FILES['img']['size'] > 2 * 1024 * 1024) {
            $_SESSION['error'] = "ไฟล์มีขนาดใหญ่เกินไป (ต้องไม่เกิน 2MB)";
            header("Location: ../register.php");
            exit();
        }

        if (!move_uploaded_file($_FILES['img']['tmp_name'], $filepath)) {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์!";
            header("Location: ../register.php");
            exit();
        }
    }

    $sql_ins = "INSERT INTO `admin` (`adminName`, `adminUsername`, `adminPass`, `adminImg`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_ins);
    $stmt->bind_param("ssss", $name, $username, $password, $filename);

    if ($stmt->execute()) {
        $_SESSION['success'] = "ลงทะเบียนสำเร็จ!";
        header("Location: ../");
        exit();
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $conn->error;
        header("Location: ../register.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
