<?php
include 'db.php';

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM Laptops WHERE id_laptop = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman utama jika berhasil
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}
?>
