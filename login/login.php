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

// Ambil data berdasarkan username saja
$query = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
$result = mysqli_query($db, $query);

// Jika username ditemukan
if (mysqli_num_rows($result) === 1) {

    $row = mysqli_fetch_assoc($result);

    // Verifikasi password hash
    if (password_verify($password, $row['password'])) {

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['Nama'] = $row['nama_lengkap'];
        $_SESSION['role'] = $row['role'];

        header("Location: ../dashboard.php");
        exit();

    } else {
        echo "<script>
            alert('Password salah!');
            window.location='index.html';
        </script>";
        exit();
    }

} else {
    echo "<script>
            alert('Username tidak ditemukan!');
            window.location='index.html';
          </script>";
    exit();
}

?>
