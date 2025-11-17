<?php
// Detail Koneksi Database
$host     = "localhost"; // Biasanya 'localhost' jika di server lokal
$username = "root";      // Ganti dengan username MySQL Anda (default XAMPP/WAMP adalah 'root')
$password = "ppkpi";          // Ganti dengan password MySQL Anda (default XAMPP/WAMP adalah kosong)
$database = "manajemen_guru"; // Ganti dengan nama database yang Anda buat di MySQL Workbench

// Membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    // Jika koneksi gagal, hentikan script dan tampilkan error
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Opsional: Pesan sukses (hanya untuk debugging)
// echo "Koneksi berhasil!"; 
?>