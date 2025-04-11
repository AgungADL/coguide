<?php
    include "koneksi.php";

    if(!$koneksi){
        echo "Tidak konek";
    } else {

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $comment = htmlspecialchars($_POST['comment']);
        
            $stmt = $koneksi->prepare("INSERT INTO komentar (username, comment) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $comment);
        
            if ($stmt->execute()) {
                header("Location: ../halaman_resep.php");
                exit();
            } else {
                echo "Gagal menambahkan komentar.";
            }
        
            $stmt->close();
        } else {
            echo "wht";
        }
    }
?>