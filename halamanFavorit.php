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
    <title>CoGuide - Favorite</title>
    <link rel="stylesheet" href="css/halamanFavorit.css">

    <!-- my own website icon -->
    <link rel="icon" href="foto/coguide.png">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
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
            <div class="favorite-item">
                <img src="foto/rujak.jpg" alt="Rujak Buah">
                <h3 class="menuTitle">Rujak Buah</h3>
                <p>
                    Rujak adalah makanan yang dibuat dari buah-buahan kadang-kadang disertai sayuran yang diiris,
                    kemudian diberi bumbu yang terdiri atas asam, gula, cabai, dan sebagainya.
                </p>
                <div class="kat">
                    <p id="katIsi">Nusantara</p>
                    <p id="katIsi">Rp 50.000</p>
                </div>
                <div class="like">❤</div>
            </div>
        </div>

        <!-- Next Button -->
        <div class="next-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M9.29 6.71a1 1 0 011.42 0L15 11l-4.29 4.29a1 1 0 01-1.42-1.42L12.17 11l-2.88-2.88a1 1 0 010-1.42z"></path>
            </svg>
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

                // Cek apakah sesuai filter
                let cocokSearch = searchQuery === "" || resepTitle.includes(searchQuery);

                // Tampilkan jika cocok, sembunyikan jika tidak
                if (cocokSearch) {
                    setTimeout(() => {
                        resep.classList.add("show");
                    }, 100); // Tambah delay biar smooth
                } else {
                    resep.classList.remove("show");
                }
            });
        }

        document.getElementById("search").addEventListener("input", filterResep);

        document.getElementById("clearSearch").addEventListener("click", function() {
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
