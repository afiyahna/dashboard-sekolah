<?php
require_once 'config/database.php';  // Pastikan koneksi DB ada


// Ambil parameter 'page' dari URL
$page = isset($_GET['page']) ? $_GET['page'] : '';

// Halaman untuk ubah data siswa
if ($page == 'ubah' && isset($_GET['nis'])) {
    $nis = $_GET['nis'];  // Ambil nilai NIS dari URL

    // Query untuk mengambil data siswa berdasarkan NIS
    $query = mysqli_query($db, "SELECT * FROM tbl_siswa WHERE nis='$nis'");
    if ($query) {
        $data = mysqli_fetch_assoc($query); // Ambil data siswa yang cocok dengan NIS
        include 'siswa/form_ubah.php';  // Tampilkan form ubah siswa
    } else {
        echo "Data tidak ditemukan!";
    }
}

?>



<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container-fluid p-3 bg-white border-bottom shadow-sm">
    <h4><i class="fas fa-user title-icon"></i> Data Siswa</h4>
  </div>

  <div class="container mt-3">
    <!-- Konten utama sesuai page -->
    <?php
      // Menampilkan form atau data sesuai dengan parameter page
      if ($page == 'ubah') {
        include "form_ubah.php";  // Menampilkan form ubah siswa
      } elseif ($page == 'tambah') {
        include "form_tambah.php";  // Menampilkan form tambah siswa
      } else {
        include "tampil_data.php";  // Menampilkan data siswa
      }
    ?>



  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="sneat/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="sneat/assets/vendor/libs/popper/popper.js"></script>
    <script src="sneat/assets/vendor/js/bootstrap.js"></script>
    <script src="sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="sneat/assets/vendor/js/menu.js"></script>

    <!-- Vendors JS -->
    <script src="sneat/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="sneat/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="sneat/assets/js/dashboards-analytics.js"></script>
</body>
</html>
