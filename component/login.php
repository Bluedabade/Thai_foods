<!-- ตามนั้น -->
<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                เข้าสู่ระบบ
            </button>

            <!-- Modal เข้าสู่ระบบ -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="./php/login.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">เข้าสู่ระบบผู้ดูแลระบบ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group flex-nowrap">
                                    <input name="username" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" required>
                                </div>

                                <div class="input-group flex-nowrap  mt-3">
                                    <input name="pass" type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="addon-wrapping" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>