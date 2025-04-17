<?php
session_start();
if (empty($_SESSION["login"])) {
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoGuide | <?php echo $_SESSION['nm_user'] ?></title>
    <link rel="stylesheet" href="css/halamanProfil.css">

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
        <!-- Back Button -->
        <div class="back-button">
            <a href="halaman_utama_admin.php"><img src="foto/panah.png" alt="Back Icon"
                    style="height: auto; width: 200%; transform: scaleX(-1);" class="tblKembali"></a>
            <!-- Add the path to your back icon -->
        </div>

        <!-- Profile Card -->
        <div class="profile-card">
            <img src="foto/profil.png" alt="User Icon"> <!-- Add the path to your user icon -->
            <h2><?php echo $_SESSION['nm_user']; ?></h2>
            <p><?php echo $_SESSION['email_user']; ?></p>
        </div>

        <!-- Menu -->
        <div class="menu">
            <div class="menu-item" onclick="window.location.href='add_data.php'">
                <span> ➕ ADD DATA</span> <!-- Add the path to your add data icon -->
                <span class="arrow">❯</span>
            </div>
            <div class="menu-item" onclick="window.location.href='favoritAdmin.php'">
                <span>❤️ FAVORITE</span> <!-- Add the path to your favorite icon -->
                <span class="arrow">❯</span>
            </div>
            <div class="menu-item" onclick="window.location.href='logoutAdmin.php'">
                <span>🔚 LOGOUT</span> <!-- Add the path to your logout icon -->
                <span class="arrow">❯</span>
            </div>
        </div>
    </div>
</body>

</html>