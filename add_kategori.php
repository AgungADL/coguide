<?php
include "php/koneksi.php";

if (!$koneksi) {
    echo "Tidak konek";
}

session_start();
// session_start();
// if(empty ($_SESSION ["login"])){
//     header ("Location:login.php");
// }

$ambilKategori = "select * from kategori";
$hasilKategori = $koneksi->query($ambilKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <link rel="stylesheet" href="css/add_katbud.css">

    <!-- my own website icon -->
    <link rel="icon" href="foto/coguide.png">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <span class="back-button" onclick="window.location.href='add_data.php'">←</span>
        </div>
        <div class="title-section">
            <h1>ADD KATEGORI</h1>
            <p class="subtitle">CoGuide</p>
        </div>
        <form action="" method="post">
            <div class="form-container">
                <div class="input-group">
                    <label for="nama-resep">NAMA KATEGORI</label>
                    <input type="text" name="namaKategori" placeholder="NAMA KATEGORI" required>
                    <button class="add-button" name="kirim" type="submit">ADD</button>
                </div>
                <div class="input-group">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                        </tr>
                        <?php
                        if ($hasilKategori->num_rows > 0) {
                            while ($baris = $hasilKategori->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $baris['id_kategori']; ?></td>
                                    <td><?php echo $baris['kategori']; ?></td>
                                    <td><button class="buang" onclick="hapus('<?php echo $baris['id_kategori']; ?>')">delete</button></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </form>
        <p class="katebud">add <a href="add_budget.php">Budget</a></p>
    </div>
    <script>
        function hapus(id) {
            var konfirm = confirm("Apakah anda yakin ingin menghapus data ini?");
            if (konfirm) {
                window.location.href = "php/deleteKategori.php?id=" + id;
            } else {
                alert("Menghapus data dibatalkan.");
            }
        }
    </script>
</body>

</html>

<?php
include "php/koneksi.php";

if (!$koneksi) {
    echo "Tidak konek";
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kirim'])) {
        $namaKategori = isset($_POST['namaKategori']) ? $_POST['namaKategori'] : '';

        if (!empty($namaKategori)) {
            $SQL = "insert into kategori values('', '$namaKategori')";

            if ($koneksi->query($SQL) === false) {
                echo "Error: " . $SQL . "<br>" . $koneksi->error;
            } else {
                echo "<script>alert('Data kategori telah tersimpan'); window.location.href = 'add_data.php';</script>";
                exit;
            }
        } else {
            echo "<script> alert('harap isi semua file.');</script>";
        }
    }
}
?>