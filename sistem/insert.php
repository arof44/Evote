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

if (mysqli_query($koneksi, $sql) && mysqli_query($koneksi, $akses)) {
    echo "<script>
		setTimeout(function () {
			swal({
				title: 'Input DPT berhasil',
				type: 'success',
				timer: 3200,
				showConfirmButton: false
				});
				},10);
				window.setTimeout(function(){
					window.location.replace('index.php');
					},1500);
			</script>";
    $berhasil++;
} else {
    echo "<script>
		setTimeout(function () {
			swal({
				title: 'Gagal Input',
				type: 'warning',
				timer: 3200,
				showConfirmButton: false
				});
				},10);
				window.setTimeout(function(){
					window.location.replace('index.php');
					},1500);
			</script>";
}
?>