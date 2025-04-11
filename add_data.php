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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["namaResep"];
    $kategori = $_POST["kategori"];
    $bahanCara = $_POST["bahanCara"];
    $budget = $_POST["budget"];

    $foto_dir = "uploads/";
    if (!is_dir($foto_dir)) {
        mkdir($foto_dir, 0755, true);
    }
    
    $foto = "";
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $foto_name = time() . "_" . basename($_FILES["foto"]["name"]);
        $foto_path = $foto_dir . $foto_name;
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_path)) {
            $foto = $foto_path;
        }
    }
    
    $sql = "INSERT INTO resep (nama, bahanCara, kategori, budget, foto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssss", $nama, $bahanCara, $kategori, $budget, $foto);
    
    if ($stmt->execute()) {
        echo "<script> alert ('Data berhasil ditambahkan!') </script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>