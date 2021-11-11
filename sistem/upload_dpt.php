<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("location:../index.php");
  exit;
}
include '../koneksi.php';

if (isset($_POST['simpan'])) {
  $nim_ketua = mysqli_real_escape_string($koneksi, $_POST['nim_ketua']);
  $nm_paslon_ketua = mysqli_real_escape_string($koneksi, $_POST['nm_paslon_ketua']);
  $nim_wakil = mysqli_real_escape_string($koneksi, $_POST['nim_wakil']);
  $nm_paslon_wakil = mysqli_real_escape_string($koneksi, $_POST['nm_paslon_wakil']);
  $no_urut = mysqli_real_escape_string($koneksi, $_POST['no_urut']);

  if ($_POST['simpan']) {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'JPG');
    $gambar1 = $_FILES['gambar1']['name'];
    $x = explode('.', $gambar1);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['gambar1']['size'];
    $file_tmp = $_FILES['gambar1']['tmp_name'];
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      if ($ukuran <= 2000000) {
        move_uploaded_file($file_tmp, 'foto/' . $gambar1);
        $query = mysqli_query($koneksi, "INSERT INTO data_paslon VALUES(NULL, '$gambar1')");
        $gambar2 = $_FILES['gambar2']['name'];
        $x = explode('.', $gambar2);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['gambar2']['size'];
        $file_tmp = $_FILES['gambar2']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
          if ($ukuran <= 2000000) {
            move_uploaded_file($file_tmp, 'foto/' . $gambar2);
            $query = mysqli_query($koneksi, "INSERT INTO data_paslon VALUES(NULL, '$gambar2')");
          }
        }
      }
    }
  }

  mysqli_query($koneksi, "INSERT INTO data_paslon(id, nim_ketua, nm_paslon_ketua, gambar1, nim_wakil, nm_paslon_wakil, gambar2, no_urut)
    VALUES ('','$nim_ketua','$nm_paslon_ketua','$gambar1','$nim_wakil','$nm_paslon_wakil','$gambar2','$no_urut')");

  echo "<script>window.alert('Berhasil')
    window.location='input_data_paslon.php'</script>";
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
            <?php
            $level = $_SESSION['level'] == 'admin';
            if ($level) {
            ?>

              <li>
                <a href="input_data_paslon.php"><i class="fa fa-user "></i>Input Data Paslon</a>
              </li>

              <li>
                <a href="upload_dpt.php"><i class="fa fa-file "></i>Upload DPT</a>
              </li>

              <li>
                <a href="hasil_suara.php"><i class="fa fa-trophy"></i>Hasil Suara </a>
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
            <h2><i class="fa fa-user"> Upload DPT</i></h2>


          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <?php
            if (isset($_GET['berhasil'])) {
              echo "<p>" . $_GET['berhasil'] . " Data DPT berhasil di Upload</p>";
            }
            ?>
            <h3>Input Data Kelompok</h3>
            <form action="aksi_upload_dpt.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label><b>Format file xls</b></label>
                <input type="file" name="file_dpt" required="required" class="form-control-file">
              </div>
              <div class="form-group">
                <input type="submit" name="upload" class="btn btn-success" value="upload">
              </div>
            </form>

            <h3>Input Data Perorangan</h3>
            <form action="insert.php" method="GET" enctype="multipart/form-data">
              <div>
                <label>NIM</label>
                <input type="text" name="nim" required="required" class="form-control">
              </div>
              <div>
                <label>Nama</label>
                <input type="text" name="nama_mhs" required="required" autocomplete="off" class="form-control">
              </div>
              <div>
                <label>Fakultas</label>
                <input type="text" name="fakultas" required="required" class="form-control">
              </div>
              <div>
                <label>Semester</label>
                <input type="text" name="semester" required="required" autocomplete="off" class="form-control">
              </div><br>
              <div class="form-group">
                <input type="submit" class="btn btn-success" name="simpan" value="Input" class="form-control">
              </div>
            </form>
          </div>

          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12">
                <h3>Data DPT sudah memilih</h3>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Nim</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th>Waktu Memilih</th>
                    </tr>
                    <?php
                    $data_dpt = mysqli_query($koneksi, "SELECT * FROM tbl_dpt WHERE status='Sudah memilih'");
                    while ($d = mysqli_fetch_array($data_dpt)) {
                    ?>
                      <tr>
                        <td><?php echo $d['nim']; ?></td>
                        <td><?php echo $d['nama_mhs']; ?></td>
                        <td><mark style="background-color: #00cc00; color: white;"><b><?php echo $d['status']; ?></b></mark></td>
                        <td><?php echo $d['waktu']; ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <h3>Data DPT Belum memilih</h3>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Nim</th>
                      <th>Nama</th>
                      <th>Falkultas</th>
                      <th>Semester</th>
                      <th>Status</th>
                    </tr>
                    <?php
                    $data_dpt = mysqli_query($koneksi, "SELECT * FROM tbl_dpt WHERE status='Belum memilih'");
                    while ($d = mysqli_fetch_array($data_dpt)) {
                    ?>
                      <tr>
                        <td><?php echo $d['nim']; ?></td>
                        <td style="text-transform: capitalize;"><?php echo $d['nama_mhs']; ?></td>
                        <td style="text-transform: capitalize;"><?php echo $d['fakultas']; ?></td>
                        <td style="text-transform: capitalize;"><?php echo $d['semester']; ?></td>
                        <td><mark style="background-color: yellow;"><b><?php echo $d['status']; ?></b></mark></td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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

</body>

</html>