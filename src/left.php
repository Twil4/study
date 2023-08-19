<!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>4uDwc</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user2.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['username']; ?></h6>
                        <span>
                            <?php
                                if ($_SESSION['level'] == 1)
                                {
                                    echo 'Admin';
                                }
                                else {
                                    echo 'User';
                                }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link <?php $filename = basename($_SERVER['PHP_SELF']); if($filename === "index.php") echo 'active' ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <?php if ($_SESSION['level'] == 1){ ?>
                    <a href="user.php" class="nav-item nav-link <?php $filename = basename($_SERVER['PHP_SELF']); if($filename === "user.php") echo 'active' ?>"><i class="fa fa-user me-2"></i>Người dùng</a>
                    <a href="monhoc.php" class="nav-item nav-link <?php $filename = basename($_SERVER['PHP_SELF']); if($filename === "monhoc.php") echo 'active' ?>"><i class="fa fa-book me-2"></i>Môn học</a>
                    <a href="thongbao.php" class="nav-item nav-link <?php $filename = basename($_SERVER['PHP_SELF']); if($filename === "thongbao.php") echo 'active' ?>"><i class="fa fa-bell me-2"></i>Thông báo</a>
                    <a href="bug.php" class="nav-item nav-link <?php $filename = basename($_SERVER['PHP_SELF']); if($filename === "bug.php") echo 'active' ?>"><i class="fa fa-bug me-2"></i>Báo cáo</a>
                    <a href="ipblock.php" class="nav-item nav-link <?php $filename = basename($_SERVER['PHP_SELF']); if($filename === "ipblock.php") echo 'active' ?>"><i class="fa fa-address-book me-2"></i>IP block</a>

                <?php } ?>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->