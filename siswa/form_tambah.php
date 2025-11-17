<?php
require_once "config/database.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>

    <!-- CSS Sneat -->
    <link rel="stylesheet" href="../sneat/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../sneat/assets/vendor/css/theme-default.css" />
    <link rel="stylesheet" href="../sneat/assets/css/demo.css" />

    <!-- JS Sneat -->
    <script src="../sneat/assets/vendor/js/helpers.js"></script>
    <script src="../sneat/assets/js/config.js"></script>
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <!-- Sidebar -->
    <?php include "../sidebar.php"; ?>

    <!-- Layout Page -->
    <div class="layout-page">

      <!-- Navbar -->
      <?php include "../navbar.php"; ?>

      <!-- Content Wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

          <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Data Siswa /</span> Tambah Siswa
          </h4>

          <!-- Card -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="mb-0">Registrasi Siswa</h5>
            </div>

            <div class="card-body">

              <form action="proses_simpan.php" method="post" enctype="multipart/form-data">

                <div class="row">

                  <!-- Kolom kiri -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">NIS</label>
                      <input type="text" name="nis" class="form-control" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Asal Sekolah</label>
                      <input type="text" name="asal_sekolah" class="form-control" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Jenis Kelamin</label>
                      <div>
                        <label class="me-3">
                          <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                        </label>
                        <label>
                          <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                        </label>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Agama</label>
                      <select name="agama" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option>Islam</option>
                        <option>Kristen Protestan</option>
                        <option>Kristen Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                      </select>
                    </div>
                  </div>

                  <!-- Kolom tengah -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" class="form-control" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Tanggal Lahir</label>
                      <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">No HP</label>
                      <input type="text" name="no_hp" class="form-control" required>
                    </div>
                  </div>

                  <!-- Kolom kanan -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">Alamat</label>
                      <textarea name="alamat" rows="6" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Foto</label>
                      <input type="file" name="foto" class="form-control">
                    </div>
                  </div>

                </div>

                <!-- Tombol -->
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>

                <a href="../dashboard.php?page=siswa" class="btn btn-secondary">Batal</a>

              </form>

            </div>
          </div>

        </div>
        <!-- / Content -->

      </div>
      <!-- / Content wrapper -->

    </div>
    <!-- / Layout page -->

  </div>
</div>

</body>
</html>
