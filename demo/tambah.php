<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laptop</title>
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
        <h1>Tambah Laptop</h1>
        <form action="tambah.php" method="post" class="form-column">
            <label for="nama">Nama Laptop</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama laptop" required>

            <label for="merk">Merk</label>
            <input type="text" id="merk" name="merk" placeholder="Masukkan merk laptop" required>

            <label for="spesifikasi">Spesifikasi</label>
            <textarea id="spesifikasi" name="spesifikasi" placeholder="Masukkan spesifikasi laptop" required></textarea>

            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" placeholder="Masukkan jumlah stok" required>

            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" placeholder="Masukkan harga laptop" required>

            <button type="submit" class="btn">Simpan</button>
        </form>
    </div>


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $merk = $_POST['merk'];
        $spesifikasi = $_POST['spesifikasi'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];

        $sql = "INSERT INTO Laptops (nama, merk, spesifikasi, stok, harga) VALUES ('$nama', '$merk', '$spesifikasi', $stok, $harga)";
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
