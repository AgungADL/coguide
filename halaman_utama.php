<?php
    include "php/koneksi.php";

    if(!$koneksi){
        echo "Tidak konek";
    }

    session_start();
    if(empty ($_SESSION ["login"])){
        header ("Location:login.php");
    }

    // $ambil = "select * from tanaman";

    // $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : null;

    // // Filter data berdasarkan kategori jika kategori dipilih
    // if ($kategori && $kategori != 1) {
    //     $ambil = "SELECT * FROM tanaman WHERE kd_kategori = '$kategori'";
    // } else {
    //     $ambil = "SELECT * FROM tanaman"; // Menampilkan semua data jika tidak ada kategori yang dipilih
    // }

    // $hasil = $koneksi->query($ambil);
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
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
        <img src="foto/coguide.png" alt="Logo CoGuide" class="Logo_coguide">
        <h1>COGUIDE</h1>
            <div class="kabu">
                <select name="kategori" id="kategori" class="dropdown">
                    <option value="">Kategori</option>
                    <option value="nusantara">Nusantara</option>
                    <option value="asia">Asia</option>
                    <option value="barat">Barat</option>
                    <option value="menuDiet">Menu Diet</option>
                </select>
                <select name="budget" id="budget" class="dropdown">
                    <option value="">Budget</option>
                    <option value="low">Di bawah Rp 30.000</option>
                    <option value="medium">Rp30.000 - Rp 50.000</option>
                    <option value="high">Di atas Rp 50.000</option>
                </select>
            </div>
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search Menu">
                <button id="clearSearch" class="clear-btn">❌</button>
                <button class="search-btn">🔍</button>
            </div>
            <button class="profile-btn" onclick="window.location.href='halamanProfil.php'">👤</button>
        </div>

        <div class="resep-container">
            <div class="card" data-kategori="nusantara" data-budget="medium" onclick="window.location.href='halaman_resep.php'">
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
            </div>

            <div class="card" data-kategori="asia" data-budget="medium">
                <img src="foto/ramen.jpg" alt="Ramen">
                <h3 class="menuTitle">Ramen</h3>
                <p>
                    Mi Jepang yang dimasak dengan kuah gurih dan topping.
                    Penonton narbuto pasti tau. Makanan ini seperti khasnya
                    jepang.
                </p>
                <div class="kat">
                    <p id="katIsi">Asia</p>
                    <p id="katIsi">Rp 45.000</p>
                </div>
            </div>

            <div class="card" data-kategori="barat" data-budget="high">
                <img src="foto/cheeseBurger.jpg" alt="Burger">
                <h3 class="menuTitle">Cheeseburger</h3>
                <p>
                    Burger daging dengan keju leleh dan sayuran segar.
                    Enaknya ga lebay dan cara buatnya juga ga susah say.
                </p>
                <div class="kat">
                    <p id="katIsi">Barat</p>
                    <p id="katIsi">Rp 75.000</p>
                </div>
            </div>

            <div class="card" data-kategori="nusantara" data-budget="low">
                <img src="foto/ramenJawa.jpg" alt="Ramen Jawa">
                <h3 class="menuTitle">Ramen Jawa</h3>
                <p>
                    Mi Jepang dengan ciptarasa yang berbeda dari mi biasa.
                    Mi ini memiliki bumbu dengan rempah rempah dari indonesia.
                    dan topping yang indonesia banget.
                </p>
                <div class="kat">
                    <p id="katIsi">Nusantara</p>
                    <p id="katIsi">Rp 25.000</p>
                </div>
            </div>

            <div class="card" data-kategori="barat" data-budget="high">
                <img src="foto/fluffyPancakes.jpg" alt="Fluffy Pancakes">
                <h3 class="menuTitle">Fluffy Pancakes</h3>
                <p>
                    Makanan desert orang barat. Tetapi ini versi lembutnya.
                    Teksturnya yang fluffy dan rasanya yang gak lebay. Inilah
                    fluffy pancakes.
                </p>
                <div class="kat">
                    <p id="katIsi">Barat</p>
                    <p id="katIsi">Rp 80.000</p>
                </div>
            </div>

            <div class="card" data-kategori="menuDiet" data-budget="low">
                <img src="foto/saladSayur.jpg" alt="Salad Sayur">
                <h3 class="menuTitle">Salad Sayur</h3>
                <p>
                    Kumpulan sayuran yang diberi sedikit mayonise, dan bumbu
                    lainnya. Sangat cocok untuk orang yang mau diet.
                </p>
                <div class="kat">
                    <p id="katIsi">Menu Diet</p>
                    <p id="katIsi">Rp 20.000</p>
                </div>
            </div>
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

                // Cek apakah sesuai filter
                let cocokKategori = kategori === "" || kategori === resepKategori;
                let cocokBudget = budget === "" || budget === resepBudget;
                let cocokSearch = searchQuery === "" || resepTitle.includes(searchQuery);

                // Tampilkan jika cocok, sembunyikan jika tidak
                if (cocokKategori && cocokBudget && cocokSearch) {
                    setTimeout(() => {
                        resep.classList.add("show");
                    }, 100); // Tambah delay biar smooth
                } else {
                    resep.classList.remove("show");
                }
            });
        }

        document.getElementById("kategori").addEventListener("change", filterResep);
        document.getElementById("budget").addEventListener("change", filterResep);
        document.getElementById("search").addEventListener("input", filterResep);

        document.getElementById("clearSearch").addEventListener("click", function() {
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