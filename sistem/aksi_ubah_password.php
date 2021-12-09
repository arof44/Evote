<?php
session_start();
// menghubungkan dengan koneksi
if ($_SESSION["login"] != 1) {
	header("location:../sistem/index.php");
	exit;
}
include '../koneksi.php';

$nim = $_SESSION['nim'];
if (isset($_POST['ganti'])) {
	// echo $_POST['ganti'];
	$passwordBaru = $_POST['passwordBaru'];
	$ubahPass = "UPDATE tbl_akses SET kode_akses = '$passwordBaru' WHERE nim = '$nim'";

	mysqli_query($koneksi, $ubahPass);

	echo "<script>
				window.alert('Berhasil Ubah Passwword');
				window.location.replace('ubah_password.php');
			</script>";
} else {
	echo "<script>
				window.alert('Gagal Ubah Passwword');
				window.location.replace('ubah_password.php');
			</script>";
}
