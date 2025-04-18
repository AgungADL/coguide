<?php
include "koneksi.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['fav'])) {
    $id_resep = $_POST["id_resep"];
    $username = $_POST["username"];
    $comment = htmlspecialchars($_POST["comment"]);
    $fav = $_GET['fav'];

    $sql = "INSERT INTO komentar (id_resep, username, comment) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iss", $id_resep, $username, $comment);

    if ($stmt->execute() && $fav === 'no') {
        header("Location: ../halaman_resep_admin.php?id=$id_resep");
        exit();
    } else if ($fav === 'yes') {
        header("Location: ../halaman_resep_admin_fav.php?id=$id_resep");
        exit();
    } else {
        echo "Gagal menyimpan komentar.";
    }

    $stmt->close();
}
?>
