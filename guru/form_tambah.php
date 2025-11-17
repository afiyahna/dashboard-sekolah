<div class="card p-3">
  <h5>Registrasi Guru</h5>
  <form action="proses_simpan.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="form-row">
      <div class="col-md-4">
        <div class="form-group">
          <label>NUPTK</label>
          <input type="text" class="form-control" name="NUPTK" maxlength="10" required>
          <div class="invalid-feedback">NIS wajib diisi.</div>
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama" required>
          <div class="invalid-feedback">Nama wajib diisi.</div>
        </div>
        <div class="form-group">
          <label>Gelar</label>
          <input type="text" class="form-control" name="Gelar" required>
          <div class="invalid-feedback">wajib diisi.</div>
        </div>
        <div class="form-group">
          <label>Jenis Kelamin</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan
          </div>
        </div>
        <div class="form-group">
          <label>Agama</label>
          <select name="agama" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option>Islam</option><option>Kristen Protestan</option><option>Kristen Katolik</option><option>Hindu</option><option>Buddha</option>
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>Tempat Lahir</label>
          <input type="text" class="form-control" name="tempat_lahir" required>
        </div>
        <div class="form-group">
          <label>Tanggal Lahir</label>
          <input type="date" class="form-control" name="tanggal_lahir" required>
        </div>
        <div class="form-group">
          <label>No. HP</label>
          <input type="text" class="form-control" name="no_hp" maxlength="15" required>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>Alamat</label>
          <textarea class="form-control" name="alamat" rows="6" required></textarea>
        </div>
        <div class="form-group">
          <label>Foto</label>
          <input type="file" class="form-control-file" id="foto" name="foto" accept=".jpg,.jpeg,.png">
          <small class="form-text text-muted">Max 1MB. *.jpg / *.png</small>
        </div>
      </div>
    </div>

    <div class="mt-2">
      <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>
