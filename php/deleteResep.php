<?php
include 'koneksi.php';

// proses delet data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // mengambil data gambar nya
    $ambilGambar = "SELECT foto from resep where id_resep = $id";
    $hasil = $koneksi->query($ambilGambar);

    if ($hasil->num_rows > 0) {
        $data = $hasil->fetch_assoc();
        $fileGambar = trim($data['foto']);
        $filePath = "../" . $fileGambar;

        echo "Coba hapus file: $filePath <br>";

        if (file_exists($filePath)) {
            echo "File ditemukan, mencoba menghapus...<br>";
            if (unlink($filePath)) {
                echo "File berhasil dihapus.<br>";
            } else {
                echo "Gagal menghapus file.<br>";
            }
        } else {
            echo "File tidak ditemukan di path tersebut.<br>";
        }
    }


    // untuk menghapus data nya
    $hapus = "DELETE FROM resep WHERE id_resep = $id";
    $hapusKomentar = "DELETE FROM komentar WHERE id_resep = $id";
    $hapusFavorite = "DELETE FROM favorit WHERE id_resep = $id";

    if ($koneksi->query($hapus) && $koneksi->query($hapusKomentar) && $koneksi->query($hapusFavorite)) {
        echo "<script>alert('Data berhasil di hapus'); window.location='../halaman_utama_admin.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus!'); window.location='../halaman_utama_admin.php';</script>";
    }
} else {
    echo ("apaan nih");
}
?>