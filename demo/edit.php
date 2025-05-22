<?php include 'db.php'; ?>

<?php
// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data laptop berdasarkan ID
    $result = $conn->query("SELECT * FROM Laptops WHERE id_laptop = $id");
    if ($result->num_rows > 0) {
        $laptop = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laptop</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">LaptopMart</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#footer">Kontak</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
    <h1>Edit Laptop</h1>
        <form action="edit.php?id=<?php echo $id; ?>" method="post" class="form-column">
            <label for="nama">Nama Laptop</label>
            <input type="text" id="nama" name="nama" value="<?php echo $laptop['nama']; ?>" required>

            <label for="merk">Merk</label>
            <input type="text" id="merk" name="merk" value="<?php echo $laptop['merk']; ?>" required>

            <label for="spesifikasi">Spesifikasi</label>
            <textarea id="spesifikasi" name="spesifikasi" required><?php echo $laptop['spesifikasi']; ?></textarea>

            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" value="<?php echo $laptop['stok']; ?>" required>

            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" value="<?php echo $laptop['harga']; ?>" required>

            <button type="submit" class="btn">Simpan</button>
        </form>
    </div>

    <?php
    // Jika form disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $merk = $_POST['merk'];
        $spesifikasi = $_POST['spesifikasi'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];

        // Query untuk update data
        $sql = "UPDATE Laptops SET 
                nama = '$nama', 
                merk = '$merk', 
                spesifikasi = '$spesifikasi', 
                stok = $stok, 
                harga = $harga 
                WHERE id_laptop = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
    ?>

    <footer id="footer">
        <div class="container">
            <p>&copy; 2024 LaptopMart. Semua Hak Dilindungi.</p>
            <p>Email: support@laptopmart.com | Telepon: +62 123 4567 890</p>
        </div>
    </footer>
</body>
</html>
