<?php

include "php/koneksi.php";

if (!$koneksi) {
    echo "Tidak konek";
}

session_start();

if(empty ($_SESSION ["login"])){
    header ("Location:login.php");
}

$ambilKategori = "select * from kategori";
$hasilKategori = $koneksi->query($ambilKategori);

$ambilBudget = "select * from budget";
$hasilBudget = $koneksi->query($ambilBudget);

$ambilResep = "select * from resep";
$hasilResep = $koneksi->query($ambilResep);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoGuide</title>
    <link rel="stylesheet" href="css/halaman_uta.css">

    <!-- my own website icon -->
    <link rel="icon" href="foto/coguide.png">

    <!-- font awesome 5.14.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="foto/coguide.png" alt="Logo CoGuide" class="Logo_coguide">
            <h1>COGUIDE</h1>
            <div class="kabu">
                <select name="kategori" id="kategori" class="dropdown">
                    <option value="" selected>Kategori</option>
                    <?php
                    if ($hasilKategori->num_rows > 0) {
                        while ($baris1 = $hasilKategori->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $baris1['kategori']; ?>"> <?php echo $baris1['kategori']; ?></option>
                            <?php
                        }
                    } else {
                        echo "Error";
                    }
                    ?>
                </select>
                <select name="budget" id="budget" class="dropdown">
                    <option value="" selected>Budget</option>
                    <?php
                    if ($hasilBudget->num_rows > 0) {
                        while ($baris2 = $hasilBudget->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $baris2['budget']; ?>"> <?php echo $baris2['budget']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search Menu">
                <button id="clearSearch" class="clear-btn">❌</button>
                <button class="search-btn">🔍</button>
            </div>
            <button class="profile-btn" onclick="window.location.href='profilAdmin.php'">👤</button>
        </div>

        <div class="resep-container">
            <?php
            if ($hasilResep->num_rows > 0) {
                while ($baris3 = $hasilResep->fetch_assoc()) {
                    ?>
                    <div class="card" data-kategori="<?php echo $baris3['kategori']; ?>"
                        data-budget="<?php echo $baris3['budget']; ?>"
                        onclick="window.location.href='halaman_resep_admin.php?id= <?php echo $baris3['id_resep']; ?>'">
                        <img src="<?php echo $baris3['foto']; ?>" alt="<?php echo $baris3['namaResep']; ?>">
                        <h3 class="menuTitle"><?php echo $baris3['namaResep']; ?></h3>
                        <p>
                            <?php echo $baris3['deskripsi']; ?>
                        </p>
                        <div class="kat">
                            <p id="katIsi"><?php echo $baris3['kategori']; ?></p>
                            <p id="katIsi"><?php echo $baris3['budget']; ?></p>
                        </div>
                        <div class="crud">
                            <a href="php/deleteResep.php?id= <?php echo $baris3['id_resep']; ?>" class="delete">🗑️</a>
                            <a href="php/updateResep.php?id= <?php echo $baris3['id_resep']; ?>" class="update">✏️</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="foto/youngDevelopLogo.png" alt="Young Develop Logo">
            </div>

            <div class="footer-desc">
                <h2>CoGuide</h2>
                <p>Temukan resep terbaik dengan mudah dan cepat.</p>
            </div>

            <div class="footer-social">
                <h3>Ikuti Kami</h3>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <a href="aboutUsAdmin.php" class="aboutUs">About Us</a>
        </div>

        <div class="footer-bottom">
            <p>© <span id="year"></span> CoGuide. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function filterResep() {
            let searchQuery = document.getElementById("search").value.toLowerCase();
            let kategori = document.getElementById("kategori").value;
            let budget = document.getElementById("budget").value;
            let clearBtn = document.getElementById("clearSearch");

            let resepList = document.querySelectorAll(".card");

            clearBtn.style.display = searchQuery ? "inline" : "none";

            resepList.forEach(resep => {
                let resepKategori = resep.getAttribute("data-kategori");
                let resepBudget = resep.getAttribute("data-budget");
                let resepTitle = resep.querySelector(".menuTitle").innerText.toLowerCase();

                let cocokKategori = kategori === "" || kategori === resepKategori;
                let cocokBudget = budget === "" || budget === resepBudget;
                let cocokSearch = searchQuery === "" || resepTitle.includes(searchQuery);

                if (cocokKategori && cocokBudget && cocokSearch) {
                    resep.classList.add("show");
                    resep.classList.remove("hide");
                } else {
                    resep.classList.add("hide");
                    resep.classList.remove("show");
                }
            });
        }


        document.getElementById("kategori").addEventListener("change", filterResep);
        document.getElementById("budget").addEventListener("change", filterResep);
        document.getElementById("search").addEventListener("input", filterResep);

        document.getElementById("clearSearch").addEventListener("click", function () {
            document.getElementById("search").value = "";
            this.style.display = "none"; // Sembunyikan tombol X lagi
            filterResep();
        });

        window.onload = function () {
            document.querySelectorAll(".card").forEach(resep => {
                setTimeout(() => {
                    resep.classList.add("show");
                }, 200);
            });
        };

        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
</body>

</html>