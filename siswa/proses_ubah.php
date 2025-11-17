<?php
require_once "config/database.php";

if (isset($_POST['ubah'])) {
  $nis = mysqli_real_escape_string($db, $_POST['nis']);
  $nama = mysqli_real_escape_string($db, trim($_POST['nama']));
  $tempat_lahir = mysqli_real_escape_string($db, trim($_POST['tempat_lahir']));
  $tanggal_lahir = mysqli_real_escape_string($db, trim($_POST['tanggal_lahir']));
  $jenis_kelamin = mysqli_real_escape_string($db, trim($_POST['jenis_kelamin']));
  $agama = mysqli_real_escape_string($db, trim($_POST['agama']));
  $alamat = mysqli_real_escape_string($db, trim($_POST['alamat']));
  $no_hp = mysqli_real_escape_string($db, trim($_POST['no_hp']));

  $foto_lama = mysqli_real_escape_string($db, $_POST['foto_lama']);
  $nama_file = $_FILES['foto']['name'];
  $tmp_file = $_FILES['foto']['tmp_name'];

  if (!empty($nama_file)) {
    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg','jpeg','png'])) {
      echo "Format file tidak diperbolehkan.";
      exit;
    }
    if ($_FILES['foto']['size'] > 1000000) {
      echo "Ukuran file terlalu besar.";
      exit;
    }
    $newname = time().'_'.basename($nama_file);
    $path = "foto/".$newname;
    if (move_uploaded_file($tmp_file, $path)) {
      if ($foto_lama != 'default.png' && file_exists('foto/'.$foto_lama)) unlink('foto/'.$foto_lama);
      $foto_db = $newname;
    } else {
      $foto_db = $foto_lama;
    }
  } else {
    $foto_db = $foto_lama;
  }

  $update = mysqli_query($db, "UPDATE tbl_siswa SET
    nama='$nama',
    tempat_lahir='$tempat_lahir',
    tanggal_lahir='$tanggal_lahir',
    jenis_kelamin='$jenis_kelamin',
    agama='$agama',
    alamat='$alamat',
    no_hp='$no_hp',
    foto='$foto_db'
    WHERE nis='$nis'") or die(mysqli_error($db));

  if ($update) {
    header("Location: ../dashboard.php?page=siswa&alert=2");
    exit();
}
}
mysqli_close($db);
?>
