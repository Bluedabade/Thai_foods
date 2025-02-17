<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="./assets/logo.png" alt="logo" width="40" height="34">
        </a>
        <a class="navbar-brand" href="#"><?php echo $row_web_name['wsn_name'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">อาหารคาว</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        เพิ่มเติม
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">อาหารหวาน</a></li>
                        <li><a class="dropdown-item" href="#">อาหารว่าง</a></li>
                        <li><a class="dropdown-item" href="#">เมนูเพื่อสุขภาพ</a></li>
                        <li><a class="dropdown-item" href="#">ประวัติผู้จัดทำ</a></li>
                    </ul>
                </li>
            </ul>
            <?php
            if(empty($_SESSION['a_id'])):
            include("login.php") ?>
            <?php else: ?>

            <?php endif; ?>

        </div>
    </div>
</nav>