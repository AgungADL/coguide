<?php
session_start();
if (empty($_SESSION["login"])) {
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoGuide</title>
    <link rel="stylesheet" href="css/halaman_resep.css">

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
        <a href="halaman_utama.php" class="back">Back</a>
        <h1>MEMBUAT RUJAK BUAH DENGAN MUDAH</h1>
        <button id="favoriteBtn">❤️ Simpan ke Favorit</button>
        <div class="kategori">
            <p id="kat">Nusantara</p>
            <p id="kat">Rp 50.000</p>
        </div>
        <div class="konten">
            <div class="bahan">
                <p> Rujak adalah makanan yang dibuat dari buah-buahan kadang-kadang disertai sayuran yang diiris,
                    kemudian diberi bumbu yang terdiri atas asam, gula, cabai, dan sebagainya.
                </p>
                </p>
                <h3 id="shortText">Berikut bahan-bahan untuk membuat rujak buah...</h3>
                <ul id="shortText">
                    <li><strong>1 buah</strong> bengkuang,potong tipis besar</li>
                    <li><strong>1/4 buah</strong> pepaya mengkal,potong tipis besar</li>
                    <li><strong>300 grm</strong> nanas,potong memanjang</li>
                    <li><strong>8 buah</strong> jambu air potong jadi 4</li>
                    <li><strong>2 buah</strong> ketimun,potong tipis besar</li>
                </ul>
                <p id="shortText">Bahan Bumbu Rujak</p>
                <ul id="shortText">

                    <li><strong>2 buah</strong> cabe merah</li>
                    <li><strong>100 grm</strong> gula merah</li>
                    <li><strong>1/2 sdt</strong> garam</li>
                </ul>
                <div id="fullText" style="display:none;">
                    <ul>
                        <li><strong>150 grm</strong> kacang kulit di goreng</li>
                        <li><strong>2 sdt</strong> air asam</li>
                        <li><strong>1 sdt</strong> terasi</li>
                    </ul>

                    <h3>Berikut cara membuatnya...</h3>
                    <ol>
                        <li>Ulek cabe rawit merah,terasi,garam,gula merah dan air asam sacara merata</li>
                        <li>Setelah itu masukan kacang tanah,kemudian di ulek lagi</li>
                        <li>Setelah itu masukkan semua buah kemudian di campur hingga rata</li>
                        <li>Sajikan</li>
                    </ol>
                </div>
                <button id="readMoreBtn">Baca Lebih</button>
            </div>
            <figure class="foto">
                <img src="foto/rujak.jpg" alt="foto rujak">
                <figcaption>Rujak Nikmat</figcaption>
            </figure>
        </div>

        <h2>Komentar</h2>
        <form id="commentForm" action="php/komentar.php" method="post">
            <!-- <input type="text" name="username" placeholder="Nama" required> -->
            <textarea name="comment" placeholder="Tambahkan komentar..." required></textarea>
            <button type="submit">Kirim</button>
        </form>
        <div id="comments">
            <?php
            include "php/koneksi.php";

            if (!$koneksi) {
                echo "Tidak konek";
            } else {
                $result = $koneksi->query("SELECT username, comment, created_at FROM komentar ORDER BY created_at DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "<p><strong>{$row['username']}</strong>: {$row['comment']} ({$row['created_at']})</p>";
                }
                $koneksi->close();
            }
            ?>
        </div>
    </div>

    <script>
        document.getElementById("readMoreBtn").addEventListener("click", function () {
            let fullText = document.getElementById("fullText");
            if (fullText.style.display === "none") {
                fullText.style.display = "block";
                this.textContent = "Sembunyikan";
            } else {
                fullText.style.display = "none";
                this.textContent = "Baca Lebih";
            }
        });

        document.getElementById("favoriteBtn").addEventListener("click", function () {
            localStorage.setItem("favorite", "Resep Rujak Buah");
            alert("Resep disimpan ke favorit!");
        });


    </script>
</body>

</html>