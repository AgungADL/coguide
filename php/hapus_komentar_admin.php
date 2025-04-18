<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['fav'])) {
    $id = $_POST["id"];
    $id_resep = $_POST["id_resep"];
    $fav = $_GET['fav'];

    // Pastikan hanya pemilik komentar yang bisa hapus
    $query = $koneksi->prepare("SELECT username FROM komentar WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_assoc();

    if ($data && $data["username"] === $_SESSION["nm_user"]) {
        $hapus = $koneksi->prepare("DELETE FROM komentar WHERE id = ?");
        $hapus->bind_param("i", $id);
        $hapus->execute();
    }

    if ($fav === 'no') {
        header("Location: ../halaman_resep_admin.php?id=$id_resep");
        exit();
    } else {
        header("Location: ../halaman_resep_admin_fav.php?id=$id_resep");
        exit();
    }
}
?>