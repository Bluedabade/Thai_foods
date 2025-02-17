<?php 
// ตรวจสอบว่ามีการเชื่อมต่อฐานข้อมูลหรือยัง
if (!isset($conn)) {
    die("เกิดข้อผิดพลาด: ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
}

// ใช้ Prepared Statement เพื่อความปลอดภัย
$sql_web_name = "SELECT * FROM `website_name` LIMIT 1";
$stmt = $conn->prepare($sql_web_name);
$stmt->execute();
$result_web_name = $stmt->get_result();

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result_web_name->num_rows > 0) {
    $row_web_name = $result_web_name->fetch_assoc();
} else {
    $row_web_name = null; // ตั้งค่าเป็น null ถ้าไม่มีข้อมูล
}

// ปิด statement
$stmt->close();
?>
