<?php
session_start();
include("session.php");

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
                <img src="../../assets/logo.png" alt="logo" width="50" height="44">
            </a>
            <?php include("../../component/web_name.php"); ?>
            <a class="navbar-brand" href="index.php"><?php echo $row_web_name['wsn_name'] ?? "ชื่อเว็บไซต์"; ?></a>
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
    <?php include("../../component/thai_culture.php"); ?>

    <!-- Container -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <!-- ปุ่มแก้ไขชื่อเว็บไซต์ -->
                <button class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#editWebModal">
                    แก้ไขชื่อเว็บไซต์
                </button>

                <!-- ปุ่มแก้ไขบทความ -->
                <button class="btn btn-outline-success mb-3" data-bs-toggle="modal" data-bs-target="#editCultureModal">
                    แก้ไขบทความ
                </button>

                <!-- Card แสดงเนื้อหา -->
                <div class="card">
                    <img src="../../uploads/<?php echo $row_thai_culture['tfc_Img'] ?? 'default.jpg'; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h2 class="fs-4">วัฒนธรรมการรับประทานอาหารของคนไทย</h2>
                        <p class="card-text"><?php echo $row_thai_culture['tfc_Content'] ?? "ไม่มีข้อมูล"; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal แก้ไขชื่อเว็บไซต์ -->
    <div class="modal fade" id="editWebModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../../php/editnameweb.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">แก้ไขชื่อเว็บไซต์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input value="<?php echo $row_web_name['wsn_name'] ?? ""; ?>" name="websitename" type="text" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal แก้ไขบทความ -->
    <div class="modal fade" id="editCultureModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../../php/thai_culture.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">แก้ไขบทความ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="../../uploads/<?php echo $row_thai_culture['tfc_Img'] ?? 'default.jpg'; ?>" class="img-thumbnail" alt="Preview" id="imgPreview">
                        </div>
                        <div class="mt-3">
                            <input name="img" type="file" class="form-control" id="imgInput">
                        </div>
                        <div class="mt-3">
                            <textarea name="thai_culture" class="form-control" required><?php echo $row_thai_culture['tfc_Content'] ?? ""; ?></textarea>
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