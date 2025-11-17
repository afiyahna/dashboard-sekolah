<?php
if (isset($_GET['nuptk'])) {
  $nuptk = mysqli_real_escape_string($db, $_GET['nuptk']);
  $q = mysqli_query($db, "SELECT * FROM tbl_guru WHERE nuptk='$nuptk'") or die(mysqli_error($db));
  $d = mysqli_fetch_assoc($q);
} else {
  header("Location: index.php");
  exit;
}
?>
<div class="card p-3">
  <h5>Ubah Data Guru</h5>
  <form action="proses_ubah.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="nuptk" value="<?php echo $d['nuptk']; ?>">
    <input type="hidden" name="foto_lama" value="<?php echo $d['foto']; ?>">
    <div class="form-row">
      <div class="col-md-4">
        <div class="form-group">
          <label>NUPTK</label>
          <input type="text" class="form-control" value="<?php echo $d['NUPTK']; ?>" readonly>
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($d['nama']); ?>" required>
        </div>
        <div class="form-group">
          <label>Gelar</label>
          <input type="text" class="form-control" name="gelar" value="<?php echo htmlspecialchars($d['gelar']); ?>" required>
        </div>
        <div class="form-group">
          <label>Jenis Kelamin</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo $d['jenis_kelamin']=='Laki-laki'?'checked':''; ?>> Laki-laki
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" <?php echo $d['jenis_kelamin']=='Perempuan'?'checked':''; ?>> Perempuan
          </div>
        </div>
        <div class="form-group">
          <label>Agama</label>
          <select name="agama" class="form-control" required>
            <option <?php echo $d['agama']==''?'selected':''; ?>><?php echo $d['agama']; ?></option>
            <option>Islam</option><option>Kristen Protestan</option><option>Kristen Katolik</option><option>Hindu</option><option>Buddha</option>
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>Tempat Lahir</label>
          <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $d['tempat_lahir']; ?>" required>
        </div>
        <div class="form-group">
          <label>Tanggal Lahir</label>
          <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $d['tanggal_lahir']; ?>" required>
        </div>
        <div class="form-group">
          <label>No. HP</label>
          <input type="text" class="form-control" name="no_hp" value="<?php echo $d['no_hp']; ?>" required>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>Alamat</label>
          <textarea class="form-control" name="alamat" rows="6" required><?php echo $d['alamat']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Foto (biarkan kosong jika tidak ganti)</label>
          <input type="file" class="form-control-file" id="foto" name="foto" accept=".jpg,.jpeg,.png">
          <div class="mt-2"><img src="foto/<?php echo $d['foto']; ?>" class="foto-preview"></div>
        </div>
      </div>
    </div>

    <div class="mt-2">
      <button class="btn btn-primary" type="submit" name="ubah">Simpan Perubahan</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>
