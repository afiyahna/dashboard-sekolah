<?php
require_once "config/db.php";

if (!isset($_GET['NUPTK'])) {
  echo "<script>alert('NUPTK tidak ditemukan'); window.close();</script>";
  exit;
}

$NUPTK = mysqli_real_escape_string($db, $_GET['NUPTK']);
$query = mysqli_query($db, "SELECT * FROM tbl_guru WHERE NUPTK='$NUPTK'") or die(mysqli_error($db));
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "<script>alert('Data siswa tidak ditemukan'); window.close();</script>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Data Guru - <?php echo htmlspecialchars($data['guru']); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { margin: 40px; font-size: 15px; }
    .table-borderless th {
      width: 220px;
      vertical-align: top;
      padding-right: 5px;
      text-align: left;
    }
    .table-borderless td {
      text-align: left;
    }
    .foto {
      width: 100px;
      height: 120px;
      object-fit: cover;
      border: 1px solid #ccc;
      padding: 3px;
    }
    hr {
      border-top: 2px solid #000;
    }
    @media print {
      .no-print { display: none; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="text-center mb-4">
      <h3><strong>DATA GURU dan STAFF</strong></h3>
      <h5>Sekolah Cinta Alam</h5>
      <hr>
    </div>

    <div class="row">
      <div class="col-md-3 text-center">
        <img src="foto/<?php echo (!empty($data['foto'])) ? $data['foto'] : 'default.png'; ?>" class="foto" alt="Foto Siswa">
      </div>
      <div class="col-md-9">
        <table class="table table-borderless">
          <tr><th>NUPTK</th><td>: <?php echo $data['NUPTK']; ?></td></tr>
          <tr><th>Nama</th><td>: <?php echo $data['Nama']; ?></td></tr>
          <tr><th>Tempat, Tanggal Lahir</th><td>: <?php echo $data['tempat_lahir'].", ".date('d-m-Y', strtotime($data['tanggal_lahir'])); ?></td></tr>
          <tr><th>Jenis Kelamin</th><td>: <?php echo $data['jenis_kelamin']; ?></td></tr>
          <tr><th>Gelar</th><td>: <?php echo $data['Gelar']; ?></td></tr>
          <tr><th>Agama</th><td>: <?php echo $data['Agama']; ?></td></tr>
          <tr><th>Alamat</th><td>: <?php echo $data['Alamat']; ?></td></tr>
          <tr><th>No HP</th><td>: <?php echo $data['No_Hp']; ?></td></tr>
        </table>
      </div>
    </div>

    <div class="text-center mt-4 no-print">
      <button class="btn btn-primary" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak Halaman Ini
      </button>
      <a href="../dashboard.php?page=siswa" class="btn btn-secondary">Kembali</a>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
