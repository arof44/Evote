<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("location:../index.php");
  exit;
}
?>
<script src=js/main.js></script>
<script src=js/sweetalert.min.js></script>
<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
  date_default_timezone_set('Asia/jakarta');
  $waktu = date('H:i:sa');
  $nim = $_SESSION['nim'];
  $kode_akses = $_SESSION['kode_akses'];
  $nomor_paslon = $_POST['nomor_paslon'];

  $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tbl_paslon WHERE kode_akses='$kode_akses'"));
  if ($cek > 0) {
    echo "<script>
		setTimeout(function () {
			swal({
				title: 'Anda Tidak Bisa Melakukan Voting',
				type: 'warning',
				timer: 3200,
				showConfirmButton: false
				});
				},10);
				window.setTimeout(function(){
					window.location.replace('index.php');
					},1500);
			</script>";
  } else {
    mysqli_query($koneksi, "UPDATE tbl_dpt SET status='Sudah Memilih', waktu='$waktu' WHERE nim='$nim'");
    mysqli_query($koneksi, "INSERT INTO tbl_paslon(kode_akses, nomor_paslon)
            VALUES ('$kode_akses','$nomor_paslon')");
    echo "<script>
		setTimeout(function () {
			swal({
				title: 'Voting berhasil',
				type: 'success',
				timer: 3200,
				showConfirmButton: false
				});
				},10);
				window.setTimeout(function(){
					window.location.replace('index.php');
					},2500);
			</script>";
  }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aplikasi E-Voting</title>
  <!---------------------------------------------------------------------->
  <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <style>
    img {
      width: 100%;
      height: 280px;
      text-align: center;
    }

    img {
      border-radius: 10px;
    }

    tr,
    td {
      border: none;
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
            <?php
            $level = $_SESSION['level'] == 'admin';
            if ($level) {
            ?>

              <li>
                <a href="input_data_paslon.php"><i class="fa fa-user "></i>Input Data Paslon</a>
              </li>

              <li>
                <a href="upload_dpt.php"><i class="fa fa-file"></i>Upload DPT</a>
              </li>

              <li>
                <a href="hasil_suara.php"><i class="fa fa-trophy"></i>Hasil Suara </a>
              </li>

            <?php } else { ?>
              <li>
                <a href="ubah_password.php"><i class="fa fa-user "></i>Ubah Password</a>
              </li>
            <?php } ?>
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
            <h2><i class="fa fa-desktop"> Beranda</i></h2>
          </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
          <div class="col-lg-12 ">
            <div class="alert alert-info">
              <strong>
                <h2><b>Selamat datang</b></h2>
              </strong> Aplikasi E-Pemira
            </div>
          </div>
        </div>

        <?php
        $level = $_SESSION['level'] == 'admin';
        if ($level != 'admin') {
        ?>

          <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-success">
                <div class="row">
                  <div class="col-lg-12">
                    <h2 align="center"><b>PASLON</b></h2><br>
                    <form action="" method="post">
                      <?php
                      $data_paslon = mysqli_query($koneksi, "SELECT * FROM data_paslon");
                      while ($d = mysqli_fetch_array($data_paslon)) {
                      ?>
                        <div class="col-lg-6">
                          <table class="table table-striped table-bordered table-hover">
                            <tr>
                              <td colspan="2" style="background-color: gray; color: white; font-size: 50px; text-align: center;"><b><?php echo $d['no_urut']; ?></b>
                              </td>
                            </tr>
                            <tr>
                              <td><img style="width: 100%;" src="<?php echo "foto/" . $d['gambar1']; ?>"></td>
                              <td><img style="width: 100%;" src="<?php echo "foto/" . $d['gambar2']; ?>"></td>
                            </tr>
                            <tr>
                              <td align="center">
                                <h2><?php echo $d['nm_paslon_ketua']; ?></h2>
                              </td>
                              <td align="center">
                                <h2><?php echo $d['nm_paslon_wakil']; ?></h2>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2" style="text-align: center; padding: 20px; background-color: gray;"><input type="radio" required="required" name="nomor_paslon" value="<?php echo $d['no_urut']; ?>"></td>
                            </tr>
                          </table>
                        </div>
                      <?php } ?>
                      <input style="color: white; font-size: 20px; padding: 10px; border-radius: 15px; width: 100%;" type="submit" name="simpan" value="Vote" class="btn btn-success" onclick="return confirm('YAKIN DENGAN PILIHAN ANDA')">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <!-- /. ROW  -->

        <!-- /. ROW  -->
        <div class="row">
          <div class="col-lg-12 ">
            <div class="alert alert-danger" style="text-align: center;">
              <strong>Voting cuma bisa dilakukan satu kali !!! </strong>
            </div>
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

  <script src="../js/sweetalert.min.js"></script>
  <!--===============================================================================================-->
  <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
  <!-- JQUERY SCRIPTS -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>
</body>

</html>