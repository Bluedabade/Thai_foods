<?php
session_start();
include("session.php");

// ตรวจสอบค่า type ที่ถูกส่งมา และกำหนดค่า default
$type = $_GET['type'] ?? $_SESSION['type'] ?? 'savory';
$_SESSION['type'] = $type;

// กำหนดข้อความของปุ่ม
$button_info = match ($type) {
    'savory' => "เพิ่มประเภทอาหารคาว",
    'dessert' => "เพิ่มประเภทอาหารหวาน",
    'appetizer' => "เพิ่มรายการอาหารว่าง",
    'health' => "เพิ่มเมนูเพื่อสุขภาพ",
    default => "เพิ่มประเภทอาหาร",
};

// กำหนด SQL ตามประเภท
$sql_cate = in_array($type, ['appetizer', 'health'])
    ? "SELECT * FROM `food` WHERE `f_cate` = '$type';"
    : "SELECT * FROM `food_cate` WHERE `ft_type` = '$type';";
$result_cate = $conn->query($sql_cate);
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
            <?php while ($row_cate = $result_cate->fetch_assoc()): ?>
                <?php if (in_array($type, ['appetizer', 'health'])): ?>
                    <!-- แสดงรายการอาหาร -->
                    <div class="col-md-6">
                        <div class="card mt-3 mx-auto" style="max-width: 600px;">
                            <img src="../../uploads/<?php echo htmlspecialchars($row_cate['f_img']); ?>" class="card-img-top img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row_cate['f_name']); ?></h5>
                                <pre class="card-text"><?php echo htmlspecialchars($row_cate['f_recipes']); ?></pre>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- แสดงประเภทอาหาร -->
                    <div class="col-md-4">
                        <div class="card mt-4">
                            <img src="../../assets/1.jpg" class="card-img-top mt-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row_cate['ft_cate']); ?></h5>
                                <a href="food.php?cate=<?php echo htmlspecialchars($row_cate['ft_cate']); ?>" class="btn btn-outline-info">ดูรายการอาหาร</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal เพิ่มประเภทอาหาร -->
    <div class="modal fade" id="exampleModaladdCate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../../php/<?php echo in_array($type, ['appetizer', 'health']) ? 'add_food.php' : 'cate_food.php'; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo htmlspecialchars($button_info); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (in_array($type, ['appetizer', 'health'])): ?>
                            <!-- Form เพิ่มอาหาร -->
                            <div class="text-center">
                                <img src="" class="img-thumbnail" id="imgPreview" alt="Preview">
                            </div>
                            <div class="mt-3">
                                <input name="img" type="file" class="form-control" id="imgInput">
                            </div>
                            <div class="mt-3">
                                <input name="food" type="text" class="form-control" placeholder="ชื่อรายการอาหาร" required>
                                <input type="hidden" name="cate" value="<?php echo htmlspecialchars($type); ?>">
                            </div>
                            <div class="mt-3">
                                <textarea name="food_how" class="form-control" placeholder="วิธีการทำหรือประโยชน์" required></textarea>
                            </div>
                        <?php else: ?>
                            <!-- Form เพิ่มประเภทอาหาร -->
                            <div class="mt-3">
                                <input name="cate" type="text" class="form-control" placeholder="ชื่อประเภทอาหาร" required>
                                <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
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