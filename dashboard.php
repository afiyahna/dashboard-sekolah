
<?php
session_start();

// Jika session tidak ada → tendang ke halaman login
if (!isset($_SESSION['user_id'])) {

    // Hapus semua session
    session_unset();
    session_destroy();

    // Buat ID session baru agar tidak reuse session lama
    session_regenerate_id(true);

    // Redirect ke halaman login
    header("Location: login/index.html");
    exit();
}
?>

<!-- <h2>Selamat Datang, <?php echo $_SESSION['Nama']; ?>!</h2>
<a href="logout.php">Logout</a> -->

  
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="sneat/assets/"
  data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="sneat/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="sneat/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="sneat/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="sneat/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="sneat/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="sneat/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Helpers -->
    <script src="sneat/assets/vendor/js/helpers.js"></script>
    <script src="sneat/assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- / Sidebar -->

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar -->
          <?php include 'navbar.php'; ?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <?php
if (!isset($_GET['page'])) {
?>
    <!-- Dashboard Utama -->
    <section class="section text-center mt-5">
      <div class="container">
        <h2 class="mb-4">Selamat datang AFIYAH 🙌 </h2>
        <p>Selamat bertugas menjadi Admin Sekolah Alam</p>

        <div class="row mt-5">
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" onclick="location.href='validasi.php'">
              <div class="card-body text-center">
                <i class="bx bx-user-check display-4 text-primary mb-3"></i>
                <h5 class="card-title">Validasi Admin</h5>
                <p class="card-text">Kelola dan verifikasi akun admin baru.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" onclick="location.href='daftar_peserta.php'">
              <div class="card-body text-center">
                <i class="bx bx-group display-4 text-danger mb-3"></i>
                <h5 class="card-title">Daftar Peserta</h5>
                <p class="card-text">Lihat seluruh peserta yang terdaftar.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" onclick="location.href='admin/progress_input.php'">
              <div class="card-body text-center">
                <i class="bx bx-line-chart display-4 text-success mb-3"></i>
                <h5 class="card-title">Update Kemajuan</h5>
                <p class="card-text">Perbarui progres peserta di laman user.</p>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </section>
<?php
}
elseif ($_GET['page'] == "guru") {
    include "guru/tampil_data.php";
}
elseif ($_GET['page'] == "siswa") {
    include "siswa/tampil_data.php";
}
else {
    echo "<h3 class='text-center mt-5'>Halaman tidak ditemukan.</h3>";
}
?>



            </section>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © <script>document.write(new Date().getFullYear());</script>,
                  made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" class="footer-link me-4" target="_blank">More Themes</a>
                  <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" class="footer-link me-4" target="_blank">Documentation</a>
                  <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" class="footer-link me-4" target="_blank">Support</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->

        </div>
        <!-- / Layout page -->

      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
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
