<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION["nm_user"])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['halFav'])) {
    $username = $_SESSION["nm_user"];
    $idResep = $_POST['id_resep'];
    $halFav = $_GET['halFav'];

    // Cek apakah sudah ada
    $cek = $koneksi->query("SELECT * FROM favorit WHERE username = '$username' AND id_resep = $idResep");

    if ($cek->num_rows > 0) {
        // Kalau sudah ada → hapus dari favorit
        $koneksi->query("DELETE FROM favorit WHERE username = '$username' AND id_resep = $idResep");
        if ($halFav === 'no') {
            echo "<script>window.location='../halaman_resep.php?id=$idResep';</script>";
        } else {
            echo "<script>window.location='../halaman_resep_fav.php?id=$idResep';</script>";
        }
    } else {
        // Kalau belum ada → tambahkan
        $koneksi->query("INSERT INTO favorit (username, id_resep, created_at) VALUES ('$username', $idResep, NOW())");
        if ($halFav === 'no') {
            echo "<script>window.location='../halaman_resep.php?id=$idResep';</script>";
        } else {
            echo "<script>window.location='../halaman_resep_fav.php?id=$idResep';</script>";
        }
    }

    exit();
}