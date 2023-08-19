<?php
    session_start();
    include 'toTrinh.php';
    if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] == 0 || $_SESSION['level'] != 1)
    {
        header('Location:signin.php');
        exit();
    }
    if (isset($_POST['submit']))
    {
        $content = $_POST['content'];
        $sql = "INSERT INTO thongbao(content) value('$content')";
        mysqli_query($connect, $sql);
    }
    if (isset($_GET['ID']))
    {
        $ID = $_GET['ID'];
        $sql = "DELETE FROM thongbao WHERE ID = '$ID'";
        mysqli_query($connect, $sql);
        header('Location:thongbao.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quản lý thông báo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <?php include 'left.php'; ?>


        <?php include 'top.php'; ?>
        <div class="container-fluid pt-4 px-4">
            <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Thông báo</h6>
                            <form action="thongbao.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Thông báo</label>
                                    <input type="text=" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="content">
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
                            </form>
                        </div><br><br>
            <div class="container-fluid pt-4 px-4">
                        <div class="bg-secondary rounded-top p-4">
                            <h6 class="mb-4">Users</h6>
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Thông báo</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM thongbao ORDER BY ID DESC;";
                                        $result = mysqli_query($connect, $sql);
                                        $stt = 1;
                                    ?>
                                    <?php foreach($result as $each): ?>
                                    <tr>
                                        <th scope="row"><?php echo $stt++ ?></th>
                                        <td><?php echo $each['content'] ?></td>
                                        <td>
                                            <a href="?ID=<?php echo $each['ID'] ?>" class="btn btn-success m-2">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php include 'footer.php'; ?>
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>