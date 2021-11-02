<?php 
// menghubungkan dengan koneksi
include '../koneksi.php';

    $nim        = $_GET['nim'];
	$nama_mhs   = $_GET['nama_mhs'];
	$fakultas   = $_GET['fakultas'];
	$semester   = $_GET['semester'];
    $stat       = "Belum Memilih";
    $berhasil   = 0;

    $sql = "INSERT INTO tbl_dpt (nim, nama_mhs, fakultas, semester, status)
            VALUE ('$nim', '$nama_mhs', '$fakultas', '$semester', '$stat')";

    if (mysqli_query($koneksi,$sql)) {
        echo "<script>window.alert('Berhasil Upload')
        window.location='buat_akses.php'</script>";
        $berhasil++;
    } else {
        echo "coba lagi";
    }
    header("location:upload_dpt.php?berhasil=$berhasil");
?>
