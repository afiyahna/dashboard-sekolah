<?php
include __DIR__ . "/../module/dbconnect.php";

$jenjang = $_GET['jenjang'];

$data = $db->query("
  SELECT s.nama, sk.tahun_ajaran 
  FROM siswa s
  JOIN siswa_kelas sk ON s.id = sk.siswa_id
  JOIN jenjang_kelas jk ON jk.id = sk.jenjang_id
  WHERE jk.nama_jenjang = '$jenjang'
");
?>

<style>
  /* Header tabel custom */
  .custom-table thead tr th {
      background: #f0f2ff;        /* warna lembut selaras Sneat */
      color: #4a4a6a;
      font-weight: 700;
      padding: 14px;
      border-bottom: 2px solid #d6d8f5;
  }

  /* Hover baris */
  .custom-table tbody tr:hover {
      background: #f8f9ff;
      transition: 0.2s;
  }

  /* Padding isi tabel */
  .custom-table td {
      padding: 12px 14px;
  }
</style>

<div class="container-xxl flex-grow-1 container-p-y">


    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Detail Kelas: </span> <?= $jenjang ?>
    </h4>

    
    <button onclick="history.back()" 
            class="btn btn-secondary mb-3">
        ← Kembali
    </button>

  <div class="card">
    <div class="table-responsive text-nowrap">

      <table class="table custom-table">
        <thead>
          <tr>
            <th>Nama Siswa</th>
            <th>Tahun Ajaran</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $data->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['nama']; ?></td>
              <td><?= $row['tahun_ajaran']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
  </div>

</div>
