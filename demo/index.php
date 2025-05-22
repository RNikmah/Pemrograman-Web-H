<?php
include 'db.php';

// Fetch All Data
$result = $conn->query("SELECT * FROM Laptops");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Beli Laptop</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">LaptopMart</a>
            <ul class="nav-links">
                <li><a href="#main">Home</a></li>
                <li><a href="#footer">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main" class="container">
        <h1>Daftar Laptop</h1>
        <!-- Tombol Tambah Data -->
        <a href="tambah.php" class="btn btn-add">Tambah Data</a>
        
        <div class="cards-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <h2><?php echo $row['nama']; ?></h2>
                    <p><strong>Merk:</strong> <?php echo $row['merk']; ?></p>
                    <p><strong>Spesifikasi:</strong> <?php echo $row['spesifikasi']; ?></p>
                    <p><strong>Stok:</strong> <?php echo $row['stok']; ?></p>
                    <p><strong>Harga:</strong> Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                    <div class="card-actions">
                        <a href="edit.php?id=<?php echo $row['id_laptop']; ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id_laptop']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="cards-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <h2><?php echo $row['nama']; ?></h2>
                    <p><strong>Merk:</strong> <?php echo $row['merk']; ?></p>
                    <p><strong>Spesifikasi:</strong> <?php echo $row['spesifikasi']; ?></p>
                    <p><strong>Stok:</strong> <?php echo $row['stok']; ?></p>
                    <p><strong>Harga:</strong> Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                    <div class="card-actions">
                        <a href="index.php?edit=<?php echo $row['id_laptop']; ?>" class="btn btn-edit">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id_laptop']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <p>&copy; 2024 LaptopMart. Semua Hak Dilindungi.</p>
            <p>Email: support@laptopmart.com | Telepon: +62 123 4567 890</p>
        </div>
    </footer>
</body>
</html>
