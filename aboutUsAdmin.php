<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - CoGuide</title>
    <link rel="stylesheet" href="css/about.css">
    <link rel="icon" href="foto/coguide.png">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header>
            <h1>Tentang <span>CoGuide</span></h1>
            <p>Teman setia dapurmu</p>
        </header>

        <section class="content">
            <img src="foto/coguide.png" alt="Logo CoGuide" class="logo-img">

            <p><strong>CoGuide</strong> adalah singkatan dari <em>Cooking Guide</em> — sebuah platform berbagi resep
                yang lahir dari semangat untuk menghadirkan masakan rumahan yang lezat, mudah, dan penuh cinta.</p>

            <p>Kami percaya bahwa semua orang bisa masak, asal punya panduan yang tepat. Maka dari itu, kami menyediakan
                berbagai resep dari pengguna ke pengguna. Di sini, kamu bukan hanya menemukan menu favorit, tapi juga
                bisa berbagi kreasi unikmu sendiri!</p>

            <p>Dari dapur kecil hingga meja makan keluarga, CoGuide hadir untuk menemanimu menciptakan momen spesial
                melalui masakan. Tak peduli kamu pemula atau koki rumahan berpengalaman, CoGuide punya sesuatu untukmu.
            </p>

            <p>❤ <strong>Gabung bersama komunitas kami.</strong> Temukan resep, simpan favoritmu, dan jadi inspirasi
                bagi dapur orang lain.</p>

            <div class="team-section">
                <h2>Tentang Kami - Tim youngDevelop</h2>
                <div class="team-wrapper">
                    <img src="foto/youngDevelopLogo.png" alt="Tim youngDevelop" class="team-img">
                    <div class="team-text">
                        <p><strong>youngDevelop</strong> adalah tim kreatif yang terdiri dari para pemuda berbakat
                            dengan semangat tinggi dan rasa cinta dalam pengembangan teknologi.</p>
                        <p>Kami menciptakan <strong>CoGuide</strong> dengan tujuan sederhana: memudahkan orang-orang
                            berbagi dan menemukan resep masakan dengan cara yang menyenangkan dan mudah diakses. Semua
                            dibangun dengan penuh dedikasi, kehangatan, dan pastinya... kasih sayang. ❤️</p>
                    </div>
                </div>
            </div>

        </section>

        <footer>
            <p>&copy; <?= date("Y"); ?> CoGuide. Dibuat dengan rasa dan cinta 💛</p>
            <a href="halaman_utama_admin.php" class="back-btn">Kembali ke Beranda</a>
        </footer>
    </div>
</body>

</html>