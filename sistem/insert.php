<script src=js/main.js></script>
<script src=js/sweetalert.min.js></script>
<?php
// menghubungkan dengan koneksi
include '../koneksi.php';

$nim        = $_GET['nim'];
$nama_mhs   = $_GET['nama_mhs'];
$fakultas   = $_GET['fakultas'];
$semester   = $_GET['semester'];
$stat       = "Belum Memilih";
$waktu      = "Belum Memilih";
$berhasil   = 0;
$level      = "";

$akses = "INSERT INTO tbl_akses (nim, kode_akses, level)
    VALUE ('$nim', '$nim', '$level')";

$sql = "INSERT INTO tbl_dpt (nim, nama_mhs, fakultas, semester, status, waktu)
            VALUE ('$nim', '$nama_mhs', '$fakultas', '$semester', '$stat', '$waktu')";

$a = mysqli_query($koneksi, $sql);
$b = mysqli_query($koneksi, $akses);

if ($a && $b) {
	echo "<script>
				window.alert('Berhasil Input Data');
				window.location.replace('upload_dpt.php');
			</script>";
	$berhasil++;
} else {
	echo "<script>
				window.alert('Gagal Input Data');
				window.location.replace('upload_dpt.php');
			</script>";
}
