<?php
include 'koneksi.php';

// proses delet data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapus = "DELETE FROM budget WHERE idBudget = $id";

    if ($koneksi->query($hapus)) {
        echo "<script>window.location='../add_budget.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus!'); window.location='../add_budget.php';</script>";
    }
} else {
    echo ("apaan nih");
}
?>