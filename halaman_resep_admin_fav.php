<?php
include "php/koneksi.php";
session_start();

if (empty($_SESSION["login"])) {
    header("Location:login.php");
    exit();
}

$username = $_SESSION["nm_user"];

if (!isset($_GET['id'])) {
    echo "ID Resep tidak ditemukan.";
    exit();
}

$idResep = $_GET['id'];

$sql = "SELECT * FROM resep WHERE id_resep = $idResep";
$hasilResep = $koneksi->query($sql);

$cekFavorit = $koneksi->query("SELECT * FROM favorit WHERE username = '$username' AND id_resep = $idResep");
$sudahFavorit = $cekFavorit->num_rows > 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php if ($hasilResep->num_rows > 0):
        $baris = $hasilResep->fetch_assoc(); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CoGuide | <?= $baris['namaResep']; ?></title>
        <link rel="stylesheet" href="css/halaman_resep.css">
        <link rel="icon" href="foto/coguide.png">

        <!-- google font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Titillium+Web:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <a href="favoritAdmin.php" class="back">Back</a>

            <h1><?= $baris['namaResep']; ?></h1>
            <form action="php/favorite_toggle_admin.php" method="post" style="display:inline;">
                <input type="hidden" name="id_resep" value="<?= $idResep; ?>">
                <button type="submit" id="favoriteBtn">
                    <?= $sudahFavorit ? "❤️" : "🤍"; ?>
                </button>
            </form>


            <div class="kategori">
                <p id="kat"><?= $baris['kategori']; ?></p>
                <p id="kat"><?= $baris['budget']; ?></p>
            </div>

            <div class="konten">
                <div class="bahan">
                    <p><?= nl2br($baris['deskripsi']); ?></p>
                    <h3>Berikut bahan-bahannya :</h3>
                    <p><?= nl2br($baris['bahan']); ?></p>
                    <h3>Berikut cara membuatnya :</h3>
                    <p><?= nl2br($baris['cara']); ?></p>
                </div>
                <figure class="foto">
                    <img src="<?= $baris['foto']; ?>" alt="<?= $baris['namaResep']; ?>">
                    <figcaption><?= $baris['namaResep']; ?></figcaption>
                </figure>
            </div>
        <?php endif; ?>

        <h2>Komentar</h2>
        <form id="commentForm" action="php/komentar_admin.php" method="post">
            <input type="hidden" name="username" value="<?= $username; ?>">
            <input type="hidden" name="id_resep" value="<?= $idResep; ?>">
            <textarea name="comment" placeholder="Tambahkan komentar..." required></textarea>
            <button type="submit">Kirim</button>
        </form>

        <div id="comments">
            <?php
            $queryKomentar = "SELECT * FROM komentar WHERE id_resep = $idResep ORDER BY created_at DESC";
            $result = $koneksi->query($queryKomentar);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='comment-box'>";
                    echo "<div class='comment-header'>";
                    echo "<img class='avatar' src='foto/profil.png' alt='avatar'>";
                    echo "<strong>" . htmlspecialchars($row['username']) . "</strong>";
                    echo "</div>";
                    echo "<p>" . nl2br(htmlspecialchars($row['comment'])) . "<br><small>" . $row['created_at'] . "</small></p>";
                    if ($row['username'] === $username) {
                        echo "<form action='php/hapus_komentar_admin.php' method='post' style='margin-top:5px;'>";
                        echo "<input type='hidden' name='id' value='{$row['id']}'>";
                        echo "<input type='hidden' name='id_resep' value='{$idResep}'>";
                        echo "<button type='submit' style='background:#e53935; color:white; padding:5px 10px; border:none; border-radius:5px;'>Hapus</button>";
                        echo "</form>";
                    }
                    echo "</div>";
                }
            } else {
                echo "<p>Belum ada komentar.</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>