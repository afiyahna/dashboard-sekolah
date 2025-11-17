<?php
date_default_timezone_set("Asia/Jakarta");

$server   = "localhost";
$username = "root";      // sesuaikan jika perlu
$password = "ppkpi";   // sesuaikan jika perlu
$database = "sekolah";

$db = mysqli_connect($server, $username, $password, $database);

if (!$db) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
