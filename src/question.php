<?php
    session_start();
    include 'toTrinh.php';
    if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] == 0 || $_SESSION['level'] != 1 || !isset($_GET['mamon']))
    {
        header('Location:signin.php');
        exit();
    }
    $mamon = $_GET['mamon'];
    if (isset($_POST['submit']))
    {
        $cauhoi = $_POST['cauhoi'];
        $dapan1 = $_POST['dapan1'];
        $dapan2 = $_POST['dapan2'];
        $dapan3 = $_POST['dapan3'];
        $dapan4 = $_POST['dapan4'];
        $dapandung = $_POST['dapandung'];
        $sql = "INSERT INTO cauhoi(mamon, cauhoi, dapan1, dapan2, dapan3, dapan4, dapandung) value('$mamon', '$cauhoi', '$dapan1', '$dapan2', '$dapan3', '$dapan4', '$dapandung')";
        mysqli_query($connect, $sql);
    }
    if (isset($_POST['update']))
    {
        $ID = $_POST['ID'];
        $cauhoi = $_POST['cauhoi'];
        $dapan1 = $_POST['dapan1'];
        $dapan2 = $_POST['dapan2'];
        $dapan3 = $_POST['dapan3'];
        $dapan4 = $_POST['dapan4'];
        $dapandung = $_POST['dapandung'];
        $sql = "UPDATE cauhoi SET cauhoi = '$cauhoi', dapan1 = '$dapan1', dapan2 = '$dapan2', dapan3 = '$dapan3', dapan4 = '$dapan4', dapandung = '$dapandung' WHERE ID = '$ID'";
        mysqli_query($connect, $sql);
    }
    if (isset($_GET['ID']))
    {
        $ID = $_GET['ID'];
        $sql = "DELETE FROM cauhoi WHERE ID = '$ID'";
        mysqli_query($connect, $sql);
        header('Location:question.php?mamon='.$mamon);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quản lý câu hỏi</title>
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
                        <?php   if(!isset($_GET['delete'])){ ?>
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Câu hỏi</h6>
                            <form action="question.php<?php echo "?mamon=".$mamon ?>" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Câu hỏi</label>
                                    <textarea type="text=" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="cauhoi"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án 1</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapan1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án 2</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapan2">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án 3</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapan3">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án 4</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapan4">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án đúng</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapandung">
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
                            </form>
                        </div><br><br>
                        <?php } ?>

                        <?php
                            if(isset($_GET['delete'])){
                                $mamon = $_GET['mamon'];
                                $ID = $_GET['delete'];
                                $sql = "SELECT * FROM cauhoi WHERE ID = '$ID'";
                                $result = mysqli_query($connect, $sql);
                                $each = $result->fetch_assoc();
                        ?>
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Câu hỏi</h6>
                            <form action="question.php<?php echo "?mamon=".$mamon ?>" method="POST">
                                <input type="hidden" class="form-control" id="exampleInputPassword1" name="ID" value="<?php echo $each['ID'] ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Câu hỏi</label>
                                    <textarea type="text=" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" name="cauhoi"><?php echo $each['cauhoi'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án 1</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapan1" value="<?php echo $each['dapan1'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án 2</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapan2" value="<?php echo $each['dapan2'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án 3</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapan3" value="<?php echo $each['dapan3'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án 4</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapan4" value="<?php echo $each['dapan4'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Đáp án đúng</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="dapandung" value="<?php echo $each['dapandung'] ?>">
                                </div>
                                <button type="submit" class="btn btn-primary" name="update">Sửa</button>
                            </form>
                        </div><br><br>
                        <?php } ?>
            <div class="container-fluid pt-4 px-4">
                        <div class="bg-secondary rounded-top p-4">
                            <h6 class="mb-4">Câu hỏi</h6>
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Câu hỏi</th>
                                        <th>Đáp án 1</th>
                                        <th>Đáp án 2</th>
                                        <th>Đáp án 3</th>
                                        <th>Đáp án 4</th>
                                        <th>Đáp án đúng</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM cauhoi WHERE mamon = '$mamon' ORDER BY ID DESC;";
                                        $result = mysqli_query($connect, $sql);
                                        $stt = 1;
                                    ?>
                                    <?php foreach($result as $each): ?>
                                    <tr>
                                        <th scope="row"><?php echo $stt++ ?></th>
                                        <td><?php echo $each['cauhoi'] ?></td>
                                        <td><?php echo $each['dapan1'] ?></td>
                                        <td><?php echo $each['dapan2'] ?></td>
                                        <td><?php echo $each['dapan3'] ?></td>
                                        <td><?php echo $each['dapan4'] ?></td>
                                        <td><?php echo $each['dapandung'] ?></td>
                                        <td>
                                            <a href="?mamon=<?php echo $mamon ?>&delete=<?php echo $each['ID'] ?>  " class="btn btn-success m-2">Sửa</a>
                                        </td>
                                        <td>
                                            <a href="?mamon=<?php echo $mamon ?>&ID=<?php echo $each['ID'] ?>  " class="btn btn-success m-2">Xóa</a>
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