<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi E-Voting</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <style type="text/css">
        img {
            width: 100%;
            height: 500px;
            text-align: center;
        }

        img {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <!--  <img src="assets/img/logo.png" /> -->
                        <h4 style="color: white;">Sistem E-Voting</h4>
                    </a>

                </div>

                <span class="logout-spn">
                    <a href="../logout.php" style="color:#fff;"><i class="fa fa-circle-o-notch"> Logout</i></a>
                </span>
            </div>
        </div>

        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <div class="menu">
                    <ul class="nav" id="main-menu">

                        <li>
                            <a href="index.php"><i class="fa fa-desktop"></i>Beranda</a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-user "></i>Ubah Password</a>
                        </li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-circle-o-notch "></i>Logout</a>
                        </li>

                    </ul>
                </div>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><i class="fa fa-lightbulb-o">Ubah Pasword</i></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <form action="aksi_ubah_password.php" method="post">
                            <div class="form-group">
                                <label>Password Baru

                                </label>
                                <input type="password" name="passwordBaru" required="required" placeholder="Masukan Password Baru" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="ganti" value="Ganti" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-lg-12">
                &copy; Jefry Alfonso <?php echo date('Y') ?> <a href="http://binarytheme.com" style="color:#fff;" target="_blank"></a>
            </div>
        </div>
    </div>

    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            var ses = '<?php echo $_SESSION['ubah_pass'] ?>';
            if (ses != null) {
                swal({
                    title: 'Password berhasil diubah',
                    type: 'success',
                    timer: 3200,
                    showConfirmButton: false
                });
                <?php $_SESSION['ubah_pass'] = null; ?>
            }
        });
    </script>
</body>
</html>