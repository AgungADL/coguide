<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CoGuide - Login</title>
  <link rel="stylesheet" href="css/loginForm.css">

  <!-- my own website icon -->
  <link rel="icon" href="foto/coguide.png">

  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
    rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="back-button">
      <a href="index.html">&larr;</a>
    </div>
    <div class="login-box">
      <h1>LOGIN</h1>
      <p class="subtitle">CoGuide</p>
      <form action="" method="post">
        <input type="text" name="uname" placeholder="USERNAME" required>

        <div class="password-wrapper">
          <input type="password" id="password" name="pass" placeholder="PASSWORD" required>
          <span class="toggle-password" onclick="togglePassword()">•ᴗ•</span>
        </div>

        <button type="submit" name="kirim">Login</button>
      </form>

      <p class="register-text">
        Don't have an account? <a href="register.php">Register here!</a>
      </p>
    </div>
    <div class="logo">
      <img src="foto/coguide.png" alt="CoGuide Logo">
    </div>
  </div>

  <script>
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.querySelector(".toggle-password");

    passwordInput.addEventListener("input", () => {
      if (passwordInput.value.length > 0) {
        toggleIcon.style.display = "block";
      } else {
        toggleIcon.style.display = "none";
      }
    });

    function togglePassword() {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.textContent = ">ᴗ<";
      } else {
        passwordInput.type = "password";
        toggleIcon.textContent = "•ᴗ•";
      }
    }
  </script>

</body>

</html>

<?php
session_start();

include "php/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $Uname = $_POST['uname'];
  $Pass = $_POST['pass'];

  $cari = "select username,email,role from user where username = '$Uname' and password = '$Pass'";
  $hasil = $koneksi->query($cari);

  if ($hasil->num_rows > 0) {
    $user = $hasil->fetch_assoc();

    $_SESSION["login"] = "$Uname";

    $_SESSION['nm_user'] = $user['username'];
    $_SESSION['email_user'] = $user['email'];

    if ($user['role'] === 'admin') {
      echo "<script>alert('Selamat " . $user['username'] . ", anda sudah berhasil login!!.'); window.location.href='halaman_utama_admin.php';</script>";

      exit;
    } else {
      echo "<script>alert('Selamat " . $user['username'] . ", anda sudah berhasil login!!.'); window.location.href='halaman_utama.php';</script>";

      exit;
    }
  } else {
    echo "<script>alert('Password atau username yang anda masukan salah.')</script>";
  }
}
?>