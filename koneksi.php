<?php 

$hostname = "localhost";
$username = "root";
$pass = "";
$dbasename = "voting";

$koneksi = mysqli_connect($hostname, $username, $pass, $dbasename);

if (mysqli_connect_error()){
	echo "koneksi database gagal" .mysqli_connect_error();
}

?>