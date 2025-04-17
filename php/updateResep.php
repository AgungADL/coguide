<?php
include 'koneksi.php';

session_start();
if (empty($_SESSION["login"])) {
    header("Location:login.php");
}

// Mengambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cari = "SELECT * FROM resep WHERE id_resep = $id";
    $hasil = mysqli_query($koneksi, $cari);

    if (mysqli_num_rows($hasil) == 1) {
        $data = mysqli_fetch_assoc($hasil);
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location='halaman_utama_admin.php';</script>";
        exit;
    }
}

// proses update data
if (isset($_POST['update'])) {
    $id_resep = $_GET['id']; // dari URL
    $namaResep = mysqli_real_escape_string($koneksi, $_POST['namaResep']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $bahan = mysqli_real_escape_string($koneksi, $_POST['bahan']);
    $cara = mysqli_real_escape_string($koneksi, $_POST['cara']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $budget = mysqli_real_escape_string($koneksi, $_POST['budget']);

    // handle file foto (jika ada)
    if (!empty($_FILES['foto']['name'])) {
        $namaFoto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        // hapus foto lama (jika ada)
        if (!empty($data['foto'])) {
            $pathLama = "../" . $data['foto']; // Sesuaikan path relatif
            if (file_exists($pathLama)) {
                unlink($pathLama);
            }
        }

        // upload foto baru
        $pathBaru = "../uploads/" . $namaFoto;
        if (move_uploaded_file($tmp, $pathBaru)) {
            $fotoPathDB = "uploads/" . $namaFoto;

            // Update termasuk foto
            $update = "UPDATE resep SET namaResep = '$namaResep', kategori = '$kategori', budget = '$budget',
                       deskripsi = '$deskripsi', bahan = '$bahan', cara = '$cara', foto = '$fotoPathDB'
                       WHERE id_resep = $id";
        } else {
            echo "<script>alert('Gagal mengupload foto!');</script>";
        }
    } else {
        // Update tanpa mengganti foto
        $update = "UPDATE resep SET namaResep = '$namaResep', kategori = '$kategori', budget = '$budget',
                   deskripsi = '$deskripsi', bahan = '$bahan', cara = '$cara'
                   WHERE id_resep = $id";
    }

    if (mysqli_query($koneksi, $update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='../halaman_utama_admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
        echo "Error: " . mysqli_error($koneksi);
    }
}


// Ambil kategori dan budget
$hasilKategori = $koneksi->query("SELECT * FROM kategori");
$hasilBudget = $koneksi->query("SELECT * FROM budget");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <link rel="stylesheet" href="../css/add_dt.css">

    <!-- my own website icon -->
    <link rel="icon" href="../foto/coguide.png">

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
            <span class="back-button" onclick="window.location.href='../halaman_utama_admin.php'">←</span>
        </div>
        <div class="title-section">
            <h1>UPDATE DATA</h1>
            <p class="subtitle">CoGuide</p>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-container">
                <div class="input-group">
                    <label for="namaResep">NAMA RESEP</label>
                    <input type="text" id="namaResep" name="namaResep" placeholder="NAMA RESEP"
                        value="<?php echo $data['namaResep']; ?>" required>

                    <label for="deskripsi">DESKRIPSI</label>
                    <textarea id="deskripsi" name="deskripsi"
                        placeholder="MASUKKAN DESKRIPSI RESEP" required><?php echo $data['deskripsi']; ?></textarea>

                    <label for="bahanCara">BAHAN</label>
                    <textarea id="bahan" name="bahan"
                        placeholder="MASUKKAN BAHAN-BAHAN" required><?php echo $data['bahan']; ?></textarea>

                    <label for="cara">CARA</label>
                    <textarea id="cara" name="cara"
                        placeholder="MASUKKAN CARA MEMASAK" required><?php echo $data['cara']; ?></textarea>
                </div>
                <div class="input-group">
                    <label for="kategori">KATEGORI</label>
                    <select id="kategori" name="kategori" required>
                        <option value="" disabled selected>PILIH KATEGORI</option>
                        <?php
                        while ($baris = $hasilKategori->fetch_assoc()) {
                            $selected = $data['kategori'] == $baris['kategori'] ? 'selected' : '';
                            echo "<option value='{$baris['kategori']}' $selected>{$baris['kategori']}</option>";
                        }
                        ?>
                    </select>

                    <label for="budget">BUDGET</label>
                    <select id="budget" name="budget" required>
                        <option value="" disabled selected>PILIH BUDGET</option>
                        <?php
                        while ($baris = $hasilBudget->fetch_assoc()) {
                            $selected = $data['budget'] == $baris['budget'] ? 'selected' : '';
                            echo "<option value='{$baris['budget']}' $selected>{$baris['budget']}</option>";
                        }
                        ?>
                    </select>

                    <!-- Logo placeholder -->
                    <label for="foto">FOTO</label>
                    <input type="file" id="foto" name="foto" accept="image/*">

                    <?php if (!empty($data['foto'])): ?>
                        <img src="../<?php echo $data['foto']; ?>" alt="Foto Resep Lama"
                            style="max-width:200px; margin-top:10px;">
                    <?php endif; ?>
                </div>
            </div>
            <button class="add-button" name="update" type="submit">Update</button>
        </form>
    </div>
</body>

</html>