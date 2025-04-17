<?php
include "php/koneksi.php";

if (!$koneksi) {
    echo "Tidak konek";
}

session_start();
if(empty ($_SESSION ["login"])){
    header ("Location:login.php");
}

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
    <title>Add Data</title>
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
            <h1>ADD DATA</h1>
            <p class="subtitle">CoGuide</p>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-container">
                <div class="input-group">
                    <label for="namaResep">NAMA RESEP</label>
                    <input type="text" id="namaResep" name="namaResep" placeholder="NAMA RESEP" required>

                    <label for="deskripsi">DESKRIPSI</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="MASUKKAN DESKRIPSI RESEP" required></textarea>

                    <label for="bahanCara">BAHAN</label>
                    <textarea id="bahan" name="bahan" placeholder="MASUKKAN BAHAN-BAHAN" required></textarea>

                    <label for="cara">CARA</label>
                    <textarea id="cara" name="cara" placeholder="MASUKKAN CARA MEMASAK" required></textarea>
                </div>
                <div class="input-group">
                    <label for="kategori">KATEGORI</label>
                    <select id="kategori" name="kategori" required>
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
                    <select id="budget" name="budget" required>
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
                    <input type="file" id="foto" name="foto" accept="image/*" required>
                </div>
            </div>
            <button class="add-button">ADD</button>
        </form>
        <p class="katebud">add <a href="add_kategori.php">Kategori</a> / <a href="add_budget.php">Budget</a></p>
    </div>
</body>

</html>

<?php
include "php/koneksi.php";

if (!$koneksi) {
    echo "Tidak konek";
}

// Proses form jika data sudah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaResep = $_POST["namaResep"];       // Ambil nama resep
    $deskripsi = $_POST["deskripsi"];       // Ambil deskripsi resep
    $bahan = $_POST["bahan"];               // Ambil bahan
    $cara = $_POST["cara"];                 // Ambil cara memasak
    $kategori = $_POST["kategori"];         // Ambil kategori
    $budget = $_POST["budget"];             // Ambil budget

    // Handle foto upload
    $foto_dir = "uploads/";
    if (!is_dir($foto_dir)) {
        mkdir($foto_dir, 0755, true);
    }
    
    $foto = "";
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $foto_name = basename($_FILES["foto"]["name"]);
        $foto_path = $foto_dir . $foto_name;
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_path)) {
            $foto = $foto_path; // Menyimpan path gambar
        }
    }

    // Query untuk memasukkan data ke database
    $sql = "INSERT INTO resep (namaResep, deskripsi, bahan, cara, kategori, budget, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssssss", $namaResep, $deskripsi, $bahan, $cara, $kategori, $budget, $foto);
    
    // Eksekusi query dan cek apakah berhasil
    if ($stmt->execute()) {
        echo "<script> alert ('Data berhasil ditambahkan!'); window.location.href='halaman_utama_admin.php'; </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
}
?>