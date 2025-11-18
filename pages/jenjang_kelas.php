<?php
// include koneksi (perbaikan path)
include __DIR__ . "/../module/dbconnect.php";


// Ambil semua jenjang
$jenjang = $db->query("SELECT * FROM jenjang_kelas");

// Hitung siswa per jenjang
$statistik = $db->query("
    SELECT jk.nama_jenjang, COUNT(sk.siswa_id) AS total
    FROM jenjang_kelas jk
    LEFT JOIN siswa_kelas sk ON jk.id = sk.jenjang_id
    GROUP BY jk.id
");
?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">📚 Jenjang Kelas</h4>

  <div class="row">
    <?php while ($row = $statistik->fetch_assoc()) { ?>
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title"><?= $row['nama_jenjang']; ?></h5>
            <p class="card-text">Total Siswa: <strong><?= $row['total']; ?></strong></p>

            <a href="dashboard.php?page=detail_kelas&jenjang=<?= urlencode($row['nama_jenjang']); ?>" 
               class="btn btn-primary">
              Lihat Detail
            </a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

</div>
