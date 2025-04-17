<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION["nm_user"])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION["nm_user"];
$idResep = $_POST['id_resep'];

// Cek apakah sudah ada
$cek = $koneksi->query("SELECT * FROM favorit WHERE username = '$username' AND id_resep = $idResep");

if ($cek->num_rows > 0) {
    // Kalau sudah ada → hapus dari favorit
    $koneksi->query("DELETE FROM favorit WHERE username = '$username' AND id_resep = $idResep");
    echo "<script>window.location='../halaman_resep.php?id=$idResep';</script>";
} else {
    // Kalau belum ada → tambahkan
    $koneksi->query("INSERT INTO favorit (username, id_resep, created_at) VALUES ('$username', $idResep, NOW())");
    echo "<script>window.location='../halaman_resep.php?id=$idResep';</script>";
}

// header("Location: ../halaman_detail_resep_admin.php?id=$idResep");
exit();
