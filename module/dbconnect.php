<?php
if (!isset($_SESSION)) {
    session_start();
}

// Detail Koneksi Database
$host = "localhost";
$username = "root";
$password = "ppkpi";
$database = "sekolah";

// Membuat koneksi
$db = new mysqli($host, $username, $password, $database);

// Jika koneksi gagal
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

// (untuk backward compatibility, kalau ada file lama masih pakai $koneksi)
$koneksi = $db;

// Konfigurasi
$config = [
    'dir_root' => 'http://localhost/dashboard-sekolah/',
    'site_root' => __DIR__
];
?>
