<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CoGuide - Register</title>
  <link rel="stylesheet" href="css/loginForm.css">

  <!-- my own website icon -->
  <link rel="icon" href="foto/coguide.png">

  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="back-button">
      <a href="login.php">&larr;</a>
    </div>
    <div class="login-box">
      <h1>REGISTER</h1>
      <p class="subtitle">CoGuide</p>
      <form action="" method="post">
        <input type="email" name="email" placeholder="EMAIL" required>
        <input type="text" name="uname" placeholder="USERNAME" required>
        <input type="password" name="pass" placeholder="PASSWORD" required>
        <button type="submit" name="kirim">Register</button>
      </form>
    </div>
    <div class="logo">
      <img src="foto/z.png" alt="CoGuide Logo">
    </div>
  </div>
</body>
</html>

<?php
session_start();
include "php/koneksi.php";

if (!$koneksi) {
    echo "Tidak konek";
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kirim'])) {
        $email = trim($_POST['email']);
        $Uname = trim($_POST['uname']);
        $pass = trim($_POST['pass']);
        $role = "pengunjung";

        if (!empty($email) && !empty($Uname) && !empty($pass)) {
            // Cek apakah email atau username sudah ada
            $cekSQL = "SELECT * FROM user WHERE email = ? OR username = ?";
            $stmt = $koneksi->prepare($cekSQL);
            $stmt->bind_param("ss", $email, $Uname);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Jika akun sudah ada
                echo "<script>alert('Email atau Username sudah terdaftar!'); window.location='register.php';</script>";
            } else {

                // Insert data ke database
                $SQL = "INSERT INTO user (email, username, password, role) VALUES (?, ?, ?, ?)";
                $stmt = $koneksi->prepare($SQL);
                $stmt->bind_param("ssss", $email, $Uname, $pass, $role);

                if ($stmt->execute()) {
                    echo "<script>alert('Register berhasil'); window.location='login.php';</script>";
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        } else {
            echo "<script>alert('Harap isi semua field.');</script>";
        }
    }
}
?>