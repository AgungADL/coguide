<?php
include 'php/koneksi.php';

session_start();
//     if(empty ($_SESSION ["login"])){
//         header ("Location:login.php");
//     }

// Mengambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cari = "SELECT * FROM tanaman WHERE kd_tanaman = $id";
    $hasil = mysqli_query($koneksi, $cari);

    if (mysqli_num_rows($hasil) == 1) {
        $data = mysqli_fetch_assoc($hasil);
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location='halaman_desc_tanaman.php';</script>";
        exit;
    }
}

// proses update data
if (isset($_POST['update'])) {
    $id_tn = $_POST['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nata']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $update = "UPDATE tanaman 
                  SET nama = '$nama', 
                      kd_kategori = $kategori, 
                      jumlah = $jumlah,
                      keterangan = '$deskripsi'
                WHERE kd_tanaman = $id_tn";

    if (mysqli_query($koneksi, $update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='halaman_desc_tanaman.php?id=$id_tn';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
        echo "Error: " . mysqli_error($koneksi);
    }
}

// buat gimmick
$ambilKategori = "select * from kategori";
$hasilKategori = $koneksi->query($ambilKategori);

$ambilBudget = "select * from budget";
$hasilBudget = $koneksi->query($ambilBudget);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update Data</title>
    <link rel="stylesheet" href="css/add_dt.css">

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
            <span class="back-button" onclick="window.location.href='profilAdmin.php'">←</span>
        </div>
        <div class="title-section">
            <h1>UPDATE DATA</h1>
            <p class="subtitle">CoGuide</p>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-container">
                <div class="input-group">
                    <label for="namaResep">NAMA RESEP</label>
                    <input type="text" id="namaResep" name="namaResep" placeholder="NAMA RESEP">

                    <label for="bahanCara">BAHAN DAN CARA</label>
                    <textarea id="bahanCara" name="bahanCara" placeholder="BAHAN DAN CARA"></textarea>
                </div>
                <div class="input-group">
                    <label for="kategori">KATEGORI</label>
                    <select id="kategori" name="kategori">
                        <option value="" disabled selected>PILIH KATEGORI</option>
                        <?php
                        if ($hasilKategori->num_rows > 0) {
                            while ($baris1 = $hasilKategori->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $baris1['kategori']; ?>"> <?php echo $baris1['kategori']; ?></option>
                                <?php
                            }
                        } else {
                            echo "Error";
                        }
                        ?>
                    </select>

                    <label for="budget">BUDGET</label>
                    <select id="budget" name="budget">
                        <option value="" disabled selected>PILIH BUDGET</option>
                        <?php
                        if ($hasilBudget->num_rows > 0) {
                            while ($baris2 = $hasilBudget->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $baris2['budget']; ?>"> <?php echo $baris2['budget']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                    <!-- Logo placeholder -->
                    <label for="foto">FOTO</label>
                    <input type="file" id="foto" name="foto" accept="image/*">
                </div>
            </div>
            <button class="add-button">UPDATE</button>
        </form>
    </div>
</body>

</html>