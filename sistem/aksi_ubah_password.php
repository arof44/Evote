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
	
	$_SESSION['ubah_pass'] = $passwordBaru;
	header("location:../sistem/ubah_password.php");
} else {
	echo "<script>
		setTimeout(function () {
			swal({
				title: 'Gagal',
				type: 'success',
				timer: 3200,
				showConfirmButton: false
				});
				},10);
				window.setTimeout(function(){
					window.location.replace('ubah_password.php');
					},2500);
			</script>";
}
