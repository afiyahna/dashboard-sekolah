<?php
require_once __DIR__ . "/../module/dbconnect.php";

// Ambil kata pencarian
$cari = isset($_POST['cari']) ? mysqli_real_escape_string($db, $_POST['cari']) : "";
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- CARD UNTUK TABEL -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Guru & Staff</h5>

            <form action="" method="post" class="d-flex">
                <input type="text" class="form-control me-2" name="cari" 
                    placeholder="Cari NUPTK atau Nama" value="<?= htmlspecialchars($cari) ?>">
                <button class="btn btn-primary me-2">Cari</button>
                <a class="btn btn-success" href="form_tambah.php">Tambah</a>
            </form>
        </div>

        <div class="card-body">

            <?php
            if (isset($_GET['alert'])) {
                $msg = [
                    1 => "Data berhasil disimpan.",
                    2 => "Data berhasil diubah.",
                    3 => "Data berhasil dihapus.",
                    4 => "NUPTK sudah ada."
                ];
                echo "<div class='alert alert-info'>{$msg[$_GET['alert']]}</div>";
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
                        $batas = 5;

                        // Hitung jumlah data
                        if ($cari != "") {
                            $qjumlah = mysqli_query($db,
                                "SELECT COUNT(NUPTK) AS jumlah 
                                FROM tbl_guru 
                                WHERE NUPTK LIKE '%$cari%' OR nama LIKE '%$cari%'"
                            );
                        } else {
                            $qjumlah = mysqli_query($db, 
                                "SELECT COUNT(NUPTK) AS jumlah FROM tbl_guru");
                        }

                        $jumlah = mysqli_fetch_assoc($qjumlah)['jumlah'];
                        $halaman = ($jumlah == 0) ? 1 : ceil($jumlah / $batas);
                        $page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
                        $mulai = ($page - 1) * $batas;
                        $no = $mulai + 1;

                        // Query data guru
                        if ($cari != "") {
                            $query = mysqli_query($db,
                                "SELECT * FROM tbl_guru 
                                WHERE NUPTK LIKE '%$cari%' OR nama LIKE '%$cari%' 
                                ORDER BY NUPTK DESC 
                                LIMIT $mulai, $batas"
                            );
                        } else {
                            $query = mysqli_query($db,
                                "SELECT * FROM tbl_guru 
                                ORDER BY NUPTK DESC 
                                LIMIT $mulai, $batas"
                            );
                        }

                        while ($d = mysqli_fetch_assoc($query)) {
                            $foto = (!empty($d['foto'])) ? $d['foto'] : 'default.png';
                            
                            echo "<tr>
                                    <td>{$no}</td>
                                    <td><img src='foto/{$foto}' width='50' height='60' class='rounded'></td>
                                    <td>{$d['NUPTK']}</td>
                                    <td>{$d['Nama']}</td>
                                    <td>{$d['Gelar']}</td>
                                    <td>{$d['tempat_lahir']}, " . date('d-m-Y', strtotime($d['tanggal_lahir'])) . "</td>
                                    <td>{$d['jenis_kelamin']}</td>
                                    <td>{$d['Agama']}</td>
                                    <td>{$d['Alamat']}</td>
                                    <td>{$d['No_Hp']}</td>

                                    <td>
                                        <a class='btn btn-sm btn-secondary mb-1'
                                          href='guru/cetak.php?NUPTK={$d['NUPTK']}'
                                          target='_blank'>
                                          Cetak
                                        </a>
                                        
                                        <a class='btn btn-sm btn-primary mb-1'
                                          href='guru/form_ubah.php?NUPTK={$d['NUPTK']}'>
                                          Ubah
                                        </a>

                                        <a class='btn btn-sm btn-danger'
                                          onclick=\"return confirm('Yakin hapus data ini?')\"
                                          href='guru/proses_hapus.php?NUPTK={$d['NUPTK']}'>
                                          Hapus
                                        </a>
                                    </td>
                                  </tr>";

                            $no++;

                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <nav>
                <ul class="pagination justify-content-center mt-3">
                    <?php
                    for ($x = 1; $x <= $halaman; $x++) {
                        $active = ($x == $page) ? "active" : "";
                        echo "<li class='page-item $active'>
                                <a class='page-link' href='?hal=$x'>$x</a>
                              </li>";
                    }
                    ?>
                </ul>
            </nav>

        </div>
    </div>
</div>
