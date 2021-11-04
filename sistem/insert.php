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

    if (mysqli_query($koneksi,$sql) && mysqli_query($koneksi, $akses)) {
        echo "<script>window.alert('Berhasil Upload')
        window.location='upload_dpt.php'</script>";
        $berhasil++;
    } else {
        echo "coba lagi";
    }
    header("location:upload_dpt.php?berhasil=$berhasil");
    
?>