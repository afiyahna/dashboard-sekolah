<?php
 require_once "config/database.php";

 
if (isset($_POST['simpan'])) {

 $NUPTK = mysqli_real_escape_string($db, $_POST['NUPTK']);
  $Nama = mysqli_real_escape_string($db, trim($_POST['nama']));
  $Gelar = mysqli_real_escape_string($db, trim($_POST['Gelar']));
  $tempat_lahir = mysqli_real_escape_string($db, trim($_POST['tempat_lahir']));
  $tanggal_lahir = mysqli_real_escape_string($db, trim($_POST['tanggal_lahir']));
  $jenis_kelamin = mysqli_real_escape_string($db, trim($_POST['jenis_kelamin']));
  $Agama = mysqli_real_escape_string($db, trim($_POST['Agama']));
  $Alamat = mysqli_real_escape_string($db, trim($_POST['Alamat']));
  $No_Hp = mysqli_real_escape_string($db, trim($_POST['No_Hp']));


  $nama_file = $_FILES['foto']['name'];
  $tmp_file = $_FILES['foto']['tmp_name'];

  // cek NIS unik
  $cek = mysqli_query($db, "SELECT nuptk FROM tbl_guru WHERE nuptk='$nuptk'") or die(mysqli_error($db));
  if (mysqli_num_rows($cek) > 0) {
    header("Location: index.php?alert=4&nis=".$nuptk);
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

  $insert = mysqli_query($db, "INSERT INTO tbl_guru(nuptk,nama,gelar,tempat_lahir,tanggal_lahir,jenis_kelamin,agama,alamat,no_hp,foto) VALUES(
    '$nuptk','$nama','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$agama','$alamat','$no_hp','$foto_db')") or die(mysqli_error($db));
  if ($insert) header("Location: ../dashboard.php?page=guru&alert=1");

  if ($simpan) {
    header("Location: ../dashboard.php?page=guru&alert=1");
    exit();
  
  }

  }
mysqli_close($db);
?>
