<?php
require_once "config/db.php";

if (isset($_GET['NUPTK'])) {
  $NUPTK = mysqli_real_escape_string($db, $_GET['NUPTK']);

  $q = mysqli_query($db, "SELECT foto FROM tbl_guru WHERE NUPTK='$NUPTK'") or die(mysqli_error($db));
  $d = mysqli_fetch_assoc($q);
  $foto = $d['foto'];

  $del = mysqli_query($db, "DELETE FROM tbl_guru WHERE NUPTK='$NUPTK'") or die(mysqli_error($db));
  if ($del) {
    if ($foto != 'default.png' && file_exists('foto/'.$foto)) unlink('foto/'.$foto);
    header("Location: ../dashboard.php?page=guru&alert=3");
exit();

  }
}
mysqli_close($db);
?>
