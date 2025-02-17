<?php 
// ตรวจสอบว่ามีการเชื่อมต่อฐานข้อมูลหรือยัง
if (!isset($conn)) {
    die("เกิดข้อผิดพลาด: ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
}

// ใช้ Prepared Statement เพื่อความปลอดภัย
$sql_thai_culture = "SELECT * FROM `thaifoodculture` ";
$stmt = $conn->prepare($sql_thai_culture);
$stmt->execute();
$result_thai_culture = $stmt->get_result();

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result_thai_culture->num_rows > 0) {
    $row_thai_culture = $result_thai_culture->fetch_assoc();
} else {
    $row_thai_culture = null; // ตั้งค่าเป็น null ถ้าไม่มีข้อมูล
}

// ปิด statement
$stmt->close();
?>
