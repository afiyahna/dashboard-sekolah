<?php
session_start();

// Cek session login
if (!isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    session_regenerate_id(true);
    header("Location: login/index.html");
    exit();
}

include "module/dbconnect.php";



// Hitung total siswa (tabel siswa)
$qSiswa = mysqli_query($db, "SELECT COUNT(*) AS total_siswa FROM siswa");
$total_siswa = mysqli_fetch_assoc($qSiswa)['total_siswa'];

// Hitung total guru (tabel registrasi guru)
$qGuru = mysqli_query($db, "SELECT COUNT(*) AS total_guru FROM tbl_guru");
$total_guru = mysqli_fetch_assoc($qGuru)['total_guru'];


// ==============================================
// RESET DATA SISWA DAN MASUKKAN DATA BARU
// ==============================================

mysqli_query($db, "TRUNCATE TABLE siswa");

$tahun_sekarang = date('Y');
$tahun_awal     = $tahun_sekarang - 4;

$jumlah_awal = 20; // tahun pertama
$kenaikan    = 5;  // naik 5 tiap tahun

$tahun_ke = 0;

for ($tahun = $tahun_awal; $tahun <= $tahun_sekarang; $tahun++) {

    $jumlah_tahun_ini = $jumlah_awal + ($kenaikan * $tahun_ke);

    for ($i = 1; $i <= $jumlah_tahun_ini; $i++) {
        $nama_fake = "Siswa_" . $tahun . "_" . $i;
        $created_at = $tahun . "-" . rand(1,12) . "-" . rand(1,28);

        mysqli_query($db, "
            INSERT INTO siswa(nama, tahun_masuk, created_at)
            VALUES ('$nama_fake', '$tahun', '$created_at')
        ");
    }

    $tahun_ke++;
}

/* =======================================================
   AMBIL DATA UNTUK CHART
   ======================================================= */

$q_siswa = mysqli_query($db, "
    SELECT tahun_masuk, COUNT(*) AS total 
    FROM siswa 
    GROUP BY tahun_masuk 
    ORDER BY tahun_masuk ASC
");

$labels = [];
$values = [];

while ($row = mysqli_fetch_assoc($q_siswa)) {
    $labels[] = $row['tahun_masuk'];
    $values[] = $row['total'];
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

    <!-- link bootstrap -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">



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
        <h2 class="mb-4">Selamat datang, AFIYAH 🙌 </h2>
        <p>Selamat bertugas menjadi Admin Sekolah Alam</p>


        <div class="row">

  <!-- Total Siswa -->
  <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h5 class="card-title mb-1">Total Siswa</h5>
          <h3 class="mb-0"><?php echo $total_siswa; ?></h3>
        </div>
        <div class="avatar flex-shrink-0">
          <span class="avatar-initial rounded bg-primary">
            <i class="bx bx-user"></i>
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Guru -->
  <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h5 class="card-title mb-1">Total Guru</h5>
          <h3 class="mb-0"><?php echo $total_guru; ?></h3>
        </div>
        <div class="avatar flex-shrink-0">
          <span class="avatar-initial rounded bg-warning">
            <i class="bx bx-user-voice"></i>
          </span>
        </div>
      </div>
    </div>
  </div>

</div>


        <div class="row mt-4">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Grafik Pertumbuhan Siswa Masuk</h5>
      </div>
      <div class="card-body">
        <div id="chart-siswa"></div>
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

elseif ($_GET['page'] == "jenjang_kelas") {
    include "pages/jenjang_kelas.php";
}
elseif ($_GET['page'] == "detail_kelas") {
    include "pages/detail_kelas.php";
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: "Jumlah Siswa",
            data: <?php echo json_encode($values); ?>
        }],
        xaxis: {
            categories: <?php echo json_encode($labels); ?>
        },
        colors: ['#b9b3c3fc'],
        plotOptions: {
            bar: {
                borderRadius: 5
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-siswa"), options);
    chart.render();
});
</script>

    <!-- Main JS -->
    <script src="sneat/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="sneat/assets/js/dashboards-analytics.js"></script>
</body>
</html>
