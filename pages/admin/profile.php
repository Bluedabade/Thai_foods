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

    <!-- Profile Section -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <!-- Profile Card -->
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
                <div class="card text-center shadow-lg" style="width: 100%; max-width: 300px;">
                    <img src="../../assets/profile.png" class="card-img-top" alt="Profile Image">
                    <div class="card-body">
                        <h5 class="card-title">นายพิธินัย ชัยนเรศ</h5>
                        <p class="card-text">นักศึกษาปวส.2/2 วิทยาลัยเทคนิคพระนครศรีอยุธยา แผนกเทคโนโลยีสารสนเทศ</p>
                    </div>
                </div>
            </div>

            <!-- Information Card -->
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card p-4 shadow-lg">
                    <h4 class="text-center">ประวัติผู้จัดทำ</h4>

                    <div class="input-group mb-3">
                        <span class="input-group-text">ชื่อ - สกุล</span>
                        <input readonly value="พิธินัย ชัยนเรศ" type="text" class="form-control">
                    </div>

                    <div class="input-group mb-3">
                        <input readonly value="tijara2525@gmail.com" type="text" class="form-control">
                        <span class="input-group-text">ที่อยู่ Email</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID Line</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-line"></i></span>
                            <input readonly value="newzerza121" type="text" class="form-control">
                        </div>
                        <div class="form-text">ตัวพิมพ์เล็กทั้งหมด</div>
                    </div>

                    <div class="input-group mb-3">
                        <input readonly value="ประกาศนียบัตรวิชาชีพชั้นสูง" type="text" class="form-control">
                        <span class="input-group-text">แผนก</span>
                        <input readonly value="เทคโนโลยีสารสนเทศ" type="text" class="form-control">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">เพิ่มเติม</span>
                        <textarea readonly class="form-control">รับจ้างงานเขียนเว็บติดต่อได้ที่ไอดีไลน์ครับ</textarea>
                    </div>

                    <div class="text-center mt-3">
                        <a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ')" class="btn btn-outline-danger">ออกจากระบบ</a>
                    </div>
                </div>
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
