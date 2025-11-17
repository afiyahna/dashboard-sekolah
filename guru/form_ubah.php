<?php
// Koneksi ke database
require_once 'config/db.php';  // Atau sesuai dengan lokasi yang benar


if (isset($_GET['NUPTK'])) {
    $NUPTK = $_GET['NUPTK'];
     $query = mysqli_query($db, "SELECT * FROM tbl_guru WHERE NUPTK='$NUPTK'");
    $data = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="id"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Guru</title>

    <!-- Link ke CSS yang digunakan oleh Sneat -->
    <link rel="stylesheet" href="../sneat/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../sneat/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../sneat/assets/css/demo.css" />

    <!-- JavaScript dari Sneat -->
    <script src="../sneat/assets/vendor/js/helpers.js"></script>
    <script src="../sneat/assets/js/config.js"></script>
</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Sidebar -->
            <?php include '../sidebar.php'; ?>

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <?php include '../navbar.php'; ?>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <section class="section">
                        <div class="container">
                            <h2 class="mb-4">Ubah Data Guru</h2>

                            <form action="../guru/proses_ubah.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="NUPTK" value="<?= $data['NUPTK']; ?>">
                                <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

                                <div class="row">
                                    <!-- Kolom 1 -->
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="fw-bold">NUPTK</label>
                                            <input type="text" class="form-control" value="<?= $data['NUPTK']; ?>" readonly>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-bold">Nama</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $data['Nama']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-bold">Gelar</label>
                                            <input type="text" class="form-control" name="gelar" value="<?= $data['Gelar']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-bold">Jenis Kelamin</label><br>
                                            <label class="me-3">
                                                <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'checked' : ''; ?>> Laki-laki
                                            </label>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?>> Perempuan
                                            </label>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-bold">Agama</label>
                                            <select name="Agama" class="form-control">
                                                <option><?= $data['Agama']; ?></option>
                                                <option>Islam</option>
                                                <option>Kristen Protestan</option>
                                                <option>Kristen Katolik</option>
                                                <option>Hindu</option>
                                                <option>Buddha</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Kolom 2 -->
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="fw-bold">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" value="<?= $data['tempat_lahir']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-bold">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" value="<?= $data['tanggal_lahir']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-bold">No. HP</label>
                                            <input type="text" class="form-control" name="No_Hp" value="<?= $data['No_Hp']; ?>" required>
                                        </div>
                                    </div>

                                    <!-- Kolom 3 -->
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="fw-bold">Alamat</label>
                                            <textarea class="form-control" name="Alamat" rows="6" required><?= $data['Alamat']; ?></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-bold">Foto Guru</label>
                                            <input type="file" class="form-control" name="foto" accept=".jpg,.jpeg,.png">
                                            <div class="mt-3">
                                                <img src="../guru/foto/<?= $data['foto']; ?>" width="120" class="rounded shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <button class="btn btn-primary" type="submit" name="ubah">💾 Simpan</button>
                                <a href="../dashboard.php?page=guru" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
