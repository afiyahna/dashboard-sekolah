<?php
require_once "config/database.php";

if (isset($_POST['simpan'])) {
  $nis = mysqli_real_escape_string($db, trim($_POST['nis']));
  $nama = mysqli_real_escape_string($db, trim($_POST['nama']));
  $tempat_lahir = mysqli_real_escape_string($db, trim($_POST['tempat_lahir']));
  $tanggal_lahir = mysqli_real_escape_string($db, trim($_POST['tanggal_lahir']));
  $jenis_kelamin = mysqli_real_escape_string($db, trim($_POST['jenis_kelamin']));
  $agama = mysqli_real_escape_string($db, trim($_POST['agama']));
  $alamat = mysqli_real_escape_string($db, trim($_POST['alamat']));
  $no_hp = mysqli_real_escape_string($db, trim($_POST['no_hp']));

  $nama_file = $_FILES['foto']['name'];
  $tmp_file = $_FILES['foto']['tmp_name'];

  // cek NIS unik
  $cek = mysqli_query($db, "SELECT nis FROM tbl_siswa WHERE nis='$nis'") or die(mysqli_error($db));
  if (mysqli_num_rows($cek) > 0) {
    header("Location: index.php?alert=4&nis=".$nis);
    exit;
  }

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
      $foto_db = $newname;
    } else {
      $foto_db = 'default.png';
    }
  } else {
    $foto_db = 'default.png';
  }

  $insert = mysqli_query($db, "INSERT INTO tbl_siswa(nis,nama,tempat_lahir,tanggal_lahir,jenis_kelamin,agama,alamat,no_hp,foto) VALUES(
    '$nis','$nama','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$agama','$alamat','$no_hp','$foto_db')") or die(mysqli_error($db));
  if ($insert) header("Location: ../dashboard.php?page=siswa&alert=1");

  if ($simpan) {
    header("Location: ../dashboard.php?page=siswa&alert=1");
    exit();
}

}
mysqli_close($db);
?>
