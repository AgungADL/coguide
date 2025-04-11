<?php
include 'koneksi.php';

// proses delet data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapus = "DELETE FROM kategori WHERE idKategori = $id";

    if ($koneksi->query($hapus)) {
        echo "<script>window.location='../add_kategori.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus!'); window.location='../add_kategori.php';</script>";
    }
}
?>