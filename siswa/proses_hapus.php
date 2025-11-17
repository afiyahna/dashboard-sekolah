<?php
require_once "config/database.php";

if (isset($_GET['nis'])) {
  $nis = mysqli_real_escape_string($db, $_GET['nis']);

  $q = mysqli_query($db, "SELECT foto FROM tbl_siswa WHERE nis='$nis'") or die(mysqli_error($db));
  $d = mysqli_fetch_assoc($q);
  $foto = $d['foto'];

  $del = mysqli_query($db, "DELETE FROM tbl_siswa WHERE nis='$nis'") or die(mysqli_error($db));
  if ($del) {
    if ($foto != 'default.png' && file_exists('foto/'.$foto)) unlink('foto/'.$foto);
    header("Location: ../dashboard.php?page=siswa");
  }
}
mysqli_close($db);
?>
