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
    <title>CoGuide - Favorite</title>
    <link rel="stylesheet" href="css/halamanFavorit.css">

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
        <!-- Header -->
        <div class="header">
            <div class="back-button" onclick="window.location.href='halamanProfil.php'">←</div>
            <h1>FAVORIT</h1>
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search Menu">
            <button id="clearSearch" class="clear-btn">❌</button>
            <button class="search-btn">🔍</button>
        </div>

        <!-- Favorites List -->
        <div class="favorites">
            <?php
            include "php/koneksi.php";
            $username = $_SESSION["nm_user"];

            $query = "
                SELECT r.* FROM favorit f
                JOIN resep r ON f.id_resep = r.id_resep
                WHERE f.username = '$username'
                ORDER BY f.created_at DESC
            ";
            $result = $koneksi->query($query);

            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="favorite-item" onclick="window.location.href='halaman_resep_fav.php?id=<?= $row['id_resep']; ?>'">
                    <img src="<?= $row['foto']; ?>" alt="<?= $row['namaResep']; ?>">
                    <h3 class="menuTitle"><?= $row['namaResep']; ?></h3>
                    <p><?= $row['deskripsi']; ?></p>
                    <div class="kat">
                        <p id="katIsi"><?= $row['kategori']; ?></p>
                        <p id="katIsi"><?= $row['budget']; ?></p>
                    </div>
                    <div class="like">❤</div>
                </div>
                <?php
                }
            } else {
                echo "<h3>Kamu belum punya resep favorite</h3>";
            }
            ?>
        </div>
    </div>

    <script>
        function filterResep() {
            let searchQuery = document.getElementById("search").value.toLowerCase();
            let clearBtn = document.getElementById("clearSearch");

            let resepList = document.querySelectorAll(".favorite-item");

            clearBtn.style.display = searchQuery ? "inline" : "none";

            resepList.forEach(resep => {
                let resepTitle = resep.querySelector(".menuTitle").innerText.toLowerCase();

                let cocokSearch = searchQuery === "" || resepTitle.includes(searchQuery);

                if (cocokSearch) {
                    resep.classList.add("show");
                    resep.classList.remove("hide");
                } else {
                    resep.classList.add("hide");
                    resep.classList.remove("show");
                }
            });
        }

        document.getElementById("search").addEventListener("input", filterResep);

        document.getElementById("clearSearch").addEventListener("click", function () {
            document.getElementById("search").value = "";
            this.style.display = "none"; // Sembunyikan tombol X lagi
            filterResep();
        });

        window.onload = function () {
            document.querySelectorAll(".favorite-item").forEach(resep => {
                setTimeout(() => {
                    resep.classList.add("show");
                }, 200);
            });
        };
    </script>
</body>

</html>