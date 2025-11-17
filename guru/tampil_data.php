<?php
// koneksi: pastikan path ke dbconnect.php benar
require_once 'config/db.php';

// Pastikan koneksi ok
if (!$db) {
    die("Koneksi DB gagal: " . mysqli_connect_error());
}

// Pastikan variabel $cari selalu ada (form method POST)
$cari = isset($_POST['cari']) ? mysqli_real_escape_string($db, $_POST['cari']) : "";

// Pagination
$batas = 5;
$hal = isset($_GET['hal']) ? intval($_GET['hal']) : 1;
$posisi = ($hal - 1) * $batas;

// Hitung jumlah data (pakai nama tabel tbl_guru sesuai DB)
if ($cari !== "") {
    $sql_jumlah = "SELECT COUNT(*) AS total FROM tbl_guru 
                   WHERE NUPTK LIKE '%$cari%' OR nama LIKE '%$cari%'";
} else {
    $sql_jumlah = "SELECT COUNT(*) AS total FROM tbl_guru";
}

$jml_result = mysqli_query($db, $sql_jumlah);
if (!$jml_result) {
    die("SQL Error (count): " . mysqli_error($db));
}
$jml_row = mysqli_fetch_assoc($jml_result);
$jml = isset($jml_row['total']) ? intval($jml_row['total']) : 0;

// Ambil data
if ($cari !== "") {
    $sql = "SELECT * FROM tbl_guru
            WHERE NUPTK LIKE '%$cari%' OR nama LIKE '%$cari%'
            ORDER BY nama ASC
            LIMIT $posisi, $batas";
} else {
    $sql = "SELECT * FROM tbl_guru
            ORDER BY nama ASC
            LIMIT $posisi, $batas";
}

$query = mysqli_query($db, $sql);
if (!$query) {
    die("SQL Error (select): " . mysqli_error($db));
}
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Guru</h5>

            <!-- form: action mengarah ke dashboard sehingga tetap di dalam layout -->
            <form action="dashboard.php?page=Guru" method="post" class="d-flex">
                <input type="text" class="form-control me-2" name="cari"
                       placeholder="Cari NUPTK atau Nama" value="<?= htmlspecialchars($cari) ?>">
                <button class="btn btn-primary me-2" type="submit">Cari</button>
                <a class="btn btn-success" href="guru/form_tambah.php">Tambah</a>
            </form>
        </div>

        <div class="card-body">

            <?php
            // Alert sederhana (dari redirect)
            if (isset($_GET['alert'])) {
                $msg = [
                    1 => "Data berhasil disimpan.",
                    2 => "Data berhasil diubah.",
                    3 => "Data berhasil dihapus.",
                    4 => "NUPTK sudah ada."
                ];
                $a = intval($_GET['alert']);
                if (isset($msg[$a])) {
                    echo "<div class='alert alert-info'>{$msg[$a]}</div>";
                }
            }
            ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>NUPTK</th>
                            <th>Nama</th>
                            <th>Gelar</th>
                            <th>TTL</th>
                            <th>JK</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = $posisi + 1;

                    if ($jml == 0) {
                        echo "<tr><td colspan='10' class='text-center'>Data tidak ditemukan</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_assoc($query)) {
                            // pastikan kolom sesuai: nis, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, no_hp, foto
                            $foto = !empty($row['foto']) ? $row['foto'] : 'default.png';
                            // path foto: karena file ada di folder siswa/, dan dipanggil dari dashboard.php (root), kita gunakan path relatif dari root
                            $foto_src = "guru/foto/" . $foto;
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><img src="<?= htmlspecialchars($foto_src) ?>" width="50" class="rounded"></td>
                                <td><?= htmlspecialchars($row['NUPTK']) ?></td>
                                <td><?= htmlspecialchars($row['Nama']) ?></td>
                                <td><?= htmlspecialchars($row['Gelar']) ?></td>
                                <td><?= htmlspecialchars($row['tempat_lahir']) ?>, <?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                                <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                                <td><?= htmlspecialchars($row['Agama']) ?></td>
                                <td><?= htmlspecialchars($row['Alamat']) ?></td>
                                <td><?= htmlspecialchars($row['No_Hp']) ?></td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                    <a class="btn btn-sm btn-primary" 
                                       href="guru/form_ubah.php?NUPTK=<?= urlencode($row['NUPTK']) ?>">Ubah</a>

                                    <a class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin hapus data?')"
                                       href="guru/proses_hapus.php?NUPTK=<?= urlencode($row['NUPTK']) ?>">Hapus</a>
                                       
                                    
                                    <a class="btn btn-sm btn-secondary" 
                                       href="guru/cetak.php?NUPTK=<?= urlencode($row['NUPTK']) ?>">cetak</a>
                                        </div>

                                </td>
                            </tr>
                        <?php
                        } // end while
                    } // end else
                    ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                <nav>
                    <ul class="pagination">
                        <?php
                        $jumlahHalaman = ($batas > 0) ? ceil($jml / $batas) : 1;
                        for ($i = 1; $i <= $jumlahHalaman; $i++) {
                            $aktif = ($hal == $i) ? "active" : "";
                            // link harus mempertahankan page=guru
                            echo "<li class='page-item $aktif'>
                                    <a class='page-link' href='dashboard.php?page=guru&hal=$i'>$i</a>
                                  </li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
