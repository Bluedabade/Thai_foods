<?php
session_start();
include("session.php");

// กำหนดค่าเริ่มต้นของประเภทอาหาร
$cate = $_GET['cate'] ?? $_SESSION['cate'] ?? 'ประเภทแกง';
$_SESSION['cate'] = $cate;

// ใช้ match() แทน switch เพื่อให้โค้ดกระชับขึ้น
$button_info = match ($cate) {
    'ประเภทแกง' => "เพิ่มรายการอาหารประเภทแกง",
    'ประเภทผัด' => "เพิ่มรายการอาหารประเภทผัด",
    'ประเภทยำ' => "เพิ่มรายการอาหารประเภทยำ",
    'ประเภททอด' => "เพิ่มรายการอาหารประเภททอด",
    'ขนมประเภทไข่' => "เพิ่มรายการอาหารขนมประเภทไข่",
    'ขนมประเภทนึ่ง' => "เพิ่มรายการอาหารขนมประเภทนึ่ง",
    'ขนมประเภทเชื่อม' => "เพิ่มรายการอาหารขนมประเภทเชื่อม",
    'ขนมประเภทกวน' => "เพิ่มรายการอาหารขนมประเภทกวน",
    default => "เพิ่มรายการอาหาร",
};

// ดึงรายการอาหารจากฐานข้อมูล
$sql_food = "SELECT * FROM `food` WHERE `f_cate` = ?";
$stmt = $conn->prepare($sql_food);
$stmt->bind_param("s", $cate);
$stmt->execute();
$result_food = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยินดีต้อนรับ</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../icon/bootstrap-icons.css">
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../../assets/logo.png" alt="logo" width="40" height="34">
            </a>
            <?php include("../../component/web_name.php"); ?>
            <a class="navbar-brand" href="index.php"><?php echo htmlspecialchars($row_web_name['wsn_name'] ?? "ชื่อเว็บไซต์"); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">หน้าหลัก</a></li>
                    <li class="nav-item"><a class="nav-link" href="cate_food.php?type=savory">อาหารคาว</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">เพิ่มเติม</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="cate_food.php?type=dessert">อาหารหวาน</a></li>
                            <li><a class="dropdown-item" href="cate_food.php?type=appetizer">อาหารว่าง</a></li>
                            <li><a class="dropdown-item" href="cate_food.php?type=health">เมนูเพื่อสุขภาพ</a></li>
                            <li><a class="dropdown-item" href="profile.php">ประวัติผู้จัดทำ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-4">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModaladdCate">
            <?php echo htmlspecialchars($button_info); ?>
        </button>

        <div class="row">
            <?php while ($row_food = $result_food->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mt-4">
                        <img src="../../uploads/<?php echo htmlspecialchars($row_food['f_img']); ?>" class="card-img-top mt-3" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row_food['f_name']); ?></h5>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal เพิ่มรายการอาหาร -->
    <div class="modal fade" id="exampleModaladdCate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../../php/add_food.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo htmlspecialchars($button_info); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="" class="img-thumbnail" id="imgPreview" alt="Preview">
                        </div>
                        <div class="mt-3">
                            <input name="img" type="file" class="form-control" id="imgInput">
                        </div>
                        <div class="mt-3">
                            <input name="food" type="text" class="form-control" placeholder="ชื่อรายการอาหาร" required>
                            <input type="hidden" name="cate" value="<?php echo htmlspecialchars($cate); ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../js/script.js"></script>
    <?php include_once("../../sweet_alert.php"); ?>
</body>

</html>
