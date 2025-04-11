<?php
    session_start();
    if(empty ($_SESSION ["login"])){
        header ("Location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CoGuide</title>
  <link rel="stylesheet" href="css/logout.css">

  <!-- my own website icon -->
  <link rel="icon" href="foto/z.png">

  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="logout-container">
    <div class="logout-box">
      <h2>ARE YOU SURE WANT TO LOGOUT?</h2>
      <div class="buttons">
        <button class="yes-btn" onclick="window.location.href = 'php/prosesLogout.php'">Yes</button>
        <button class="no-btn" onclick="window.location.href='profilAdmin.php'">No</button>
      </div>
    </div>
  </div>
</body>
</html>
