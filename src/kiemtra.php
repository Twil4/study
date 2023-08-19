<?php
    session_start();
    include 'toTrinh.php';
    $ip_address = $_SERVER['REMOTE_ADDR'];
    /*if(strpos($ip_address, "27.67") !== false){
        header('Location:google.com');
        exit();
    }*/
    if(strpos($ip_address, "104.28") !== false){
        header('Location:google.com');
        exit();
    }
    if(strpos($ip_address, "171.237") !== false){
        header('Location:google.com');
        exit();
    }
    if(strpos($ip_address, "123.24") !== false){
        header('Location:google.com');
        exit();
    }
    if(strpos($ip_address, "172.226") !== false){
        header('Location:google.com');
        exit();
    }
    $sql = "SELECT * FROM black_ip WHERE `ip_address` = '$ip_address'";
    $result = mysqli_query($connect, $sql);
    $check = mysqli_num_rows($result);
    if($check != 0){
        header('Location:google.com');
        exit();
    }
    if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] == 0)
    {
        header('Location:signin.php');
        exit();
    }
    if (!isset($_GET['mamon']))
    {
        header('Location:index.php');
        exit();
    }
    $mamon = $_GET['mamon'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang chủ</title>
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

            <?php
                $sql = "SELECT * FROM cauhoi WHERE mamon = '$mamon' ORDER BY RAND() LIMIT 50";
                $result = mysqli_query($connect, $sql);
                $num = mysqli_num_rows($result);
                $cau = 1;
            ?>
            <?php foreach($result as $each): ?>
            <div class="container-fluid pt-4 px-4" id="cau<?php echo $cau ?>">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <h6 class="mb-4">Câu hỏi <?php echo $cau ?></h6>
                            <div action="ontap.php?mamon=<?php echo $mamon ?>" method="POST">
                                <?php
                                    $dapan1 = $each['dapan1'];
                                    $dapan2 = $each['dapan2'];
                                    $dapan3 = $each['dapan3'];
                                    $dapan4 = $each['dapan4'];
                                    $dap_an = [$dapan1, $dapan2, $dapan3, $dapan4];
                                    if($each['dapandung'] == 'A') {
                                        $dapanTrue = $dapan1;
                                    }else if ($each['dapandung'] == 'B') {
                                        $dapanTrue = $dapan2;
                                    }else if ($each['dapandung'] == 'C') {
                                        $dapanTrue = $dapan3;
                                    }else if ($each['dapandung'] == 'D') {
                                        $dapanTrue = $dapan4;
                                    }
                                    shuffle($dap_an);
                                    $index = 0;
                                    foreach ($dap_an as $key):
                                        $index++;
                                        if ($key == $dapanTrue) {
                                            $dapandung = $index;
                                        }
                                    endforeach;
                                    if($dapandung == 1) $dapandung = 'A';
                                    if($dapandung == 2) $dapandung = 'B';
                                    if($dapandung == 3) $dapandung = 'C';
                                    if($dapandung == 4) $dapandung = 'D';
                                ?>
                                <input type="hidden" id="dapandung<?php echo $cau ?>" value="<?php echo $dapandung ?>">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-12 col-form-label"><?php echo $each['cauhoi'] ?></label>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Đáp án</legend>
                                    <div class="col-sm-10">
                                        <?php
                                            $duc = 'A';
                                            foreach ($dap_an as $key):
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dapan<?php echo $cau ?>"
                                                id="gridRadios1" value="<?php echo $duc ?>" checked>
                                            <label class="form-check-label" for="gridRadios2">
                                                <?php echo $duc ?>. <?php echo $key ?>
                                            </label>
                                        </div>
                                        <?php
                                            $duc++;
                                            endforeach;
                                        ?>
                                    </div>
                                </fieldset>
                                <button id="submit<?php echo $cau ?>" class="btn btn-primary" name="submit">Check</button>
                                <div id="result<?php echo $cau ?>"></div>
                            </div>
                    </div>
                </div>
            </div>
            <?php $cau++ ?>
        <?php endforeach ?>

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
    <script type="text/javascript">
        <?php for($i = 1; $i <= $num; $i++){ ?>
            const submit<?php echo $i ?> = document.getElementById("submit<?php echo $i ?>");
            submit<?php echo $i ?>.addEventListener("click", function() {
            var answer<?php echo $i ?>;
            const radioButtons<?php echo $i ?> = document.getElementsByName("dapan<?php echo $i ?>");
            for (var i = 0; i < radioButtons<?php echo $i ?>.length; i++) {
              if (radioButtons<?php echo $i ?>[i].checked) {
                answer<?php echo $i ?> = radioButtons<?php echo $i ?>[i].value;
                break;
              }
            }
            const dapandung<?php echo $i ?> = document.getElementById("dapandung<?php echo $i ?>");
            const result<?php echo $i ?> = document.getElementById("result<?php echo $i ?>");
            if (answer<?php echo $i ?> === dapandung<?php echo $i ?>.value) {
                result<?php echo $i ?>.innerText = "Đúng";
            } else {
                result<?php echo $i ?>.innerText = "Sai. Đáp án đúng là: " + document.getElementById("dapandung<?php echo $i ?>").value;
            }
            });
    <?php } ?>
    </script>
</body>

</html>