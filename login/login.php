<?php
session_start();

// Koneksi ke database
$db = mysqli_connect("localhost", "root", "ppkpi", "sekolah");

if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data dari form
$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

// Query cek user
$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($db, $query);

// Jika ditemukan
if ($result) {
    $row = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $row['id'];
    $_SESSION['Nama'] = $row['nama_lengkap'];
    $_SESSION['role'] = $row['role'];

    header("Location: ../dashboard.php");
    exit();
}else {
    echo "<script>
            alert('Username atau password salah!');
            window.location='index.html';
          </script>";
}

?>
