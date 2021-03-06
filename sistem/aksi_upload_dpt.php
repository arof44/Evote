<!-- import excel ke mysql -->
<!-- www.malasngoding.com -->

<?php
// menghubungkan dengan koneksi
include '../koneksi.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['file_dpt']['name']);
move_uploaded_file($_FILES['file_dpt']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['file_dpt']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['file_dpt']['name'], false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 2; $i <= $jumlah_baris; $i++) {

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nim     	= $data->val($i, 1);
	$nama_mhs   = $data->val($i, 2);
	$fakultas   = $data->val($i, 3);
	$semester   = $data->val($i, 4);
	$status   	= $data->val($i, 5);
	$waktu   	= $data->val($i, 5);
	$level		= "";

	if ($nim != "" && $nama_mhs != "" && $status != "" && $waktu != "") {
		// input data ke database (table data_pegawai)
		mysqli_query($koneksi, "INSERT INTO tbl_dpt values('$nim','$nama_mhs','$fakultas','$semester','$status','$waktu')");
		mysqli_query($koneksi, "INSERT INTO tbl_akses values('$nim','$nim','$level')");

		$berhasil++;
	}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['file_dpt']['name']);

// alihkan halaman ke index.php
header("location:upload_dpt.php?berhasil=$berhasil");
?>