<?php
require_once "config/db.php";

if (isset($_POST['ubah'])) {
  $NUPTK = mysqli_real_escape_string($db, $_POST['NUPTK']);
  $Nama = mysqli_real_escape_string($db, trim($_POST['nama']));
  $Gelar = mysqli_real_escape_string($db, trim($_POST['Gelar']));
  $tempat_lahir = mysqli_real_escape_string($db, trim($_POST['tempat_lahir']));
  $tanggal_lahir = mysqli_real_escape_string($db, trim($_POST['tanggal_lahir']));
  $jenis_kelamin = mysqli_real_escape_string($db, trim($_POST['jenis_kelamin']));
  $Agama = mysqli_real_escape_string($db, trim($_POST['Agama']));
  $Alamat = mysqli_real_escape_string($db, trim($_POST['Alamat']));
  $No_Hp = mysqli_real_escape_string($db, trim($_POST['No_Hp']));

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

  $update = mysqli_query($db, "UPDATE tbl_guru SET
    nama='$Nama',
    Gelar='$Gelar',
    tempat_lahir='$tempat_lahir',
    tanggal_lahir='$tanggal_lahir',
    jenis_kelamin='$jenis_kelamin',
    Agama='$Agama',
    Alamat='$Alamat',
    No_Hp='$No_Hp',
    foto='$foto_db'
    WHERE NUPTK='$NUPTK'") or die(mysqli_error($db));

  if ($update) {
    header("Location: ../dashboard.php?page=guru&alert=2");
    exit();
}

}
mysqli_close($db);
?>
