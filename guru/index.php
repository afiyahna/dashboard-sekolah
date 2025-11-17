<?php
require_once "../module/dbconnect.php";
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Guru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container-fluid p-3 bg-white border-bottom shadow-sm">
    <h4><i class="fas fa-user title-icon"></i> Data Guru</h4>
  </div>

  <div class="container mt-3">
    <?php
      if (empty($_GET["page"])) {
        include "tampil_data.php";
      } elseif ($_GET['page']=='tambah') {
        include "form_tambah.php";
      } elseif ($_GET['page']=='ubah') {
        include "form_ubah.php";
      } 
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
