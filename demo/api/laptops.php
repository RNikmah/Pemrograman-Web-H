<?php
include '../db.php';
header("Content-Type: application/json");

// Method Check
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET': // READ
        if (isset($_GET['id'])) { // Get Product by ID
            $id = $_GET['id'];
            $query = $conn->query("SELECT * FROM Laptops WHERE id_laptop = $id");
            $result = $query->fetch_assoc();
            echo json_encode($result ? $result : ["error" => "Data not found"]);
        } else { // Get All Products
            $query = $conn->query("SELECT * FROM Laptops");
            $result = [];
            while ($row = $query->fetch_assoc()) {
                $result[] = $row;
            }
            echo json_encode($result);
        }
        break;

    case 'POST': // CREATE
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['nama'], $data['merk'], $data['spesifikasi'], $data['stok'], $data['harga'])) {
            $nama = $data['nama'];
            $merk = $data['merk'];
            $spesifikasi = $data['spesifikasi'];
            $stok = $data['stok'];
            $harga = $data['harga'];

            $query = $conn->query("INSERT INTO Laptops (nama, merk, spesifikasi, stok, harga) VALUES ('$nama', '$merk', '$spesifikasi', $stok, $harga)");
            echo json_encode($query ? ["message" => "Product created successfully"] : ["error" => $conn->error]);
        } else {
            echo json_encode(["error" => "Invalid input"]);
        }
        break;

    case 'PUT': // UPDATE
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['nama'], $data['merk'], $data['spesifikasi'], $data['stok'], $data['harga'])) {
                $nama = $data['nama'];
                $merk = $data['merk'];
                $spesifikasi = $data['spesifikasi'];
                $stok = $data['stok'];
                $harga = $data['harga'];

                $query = $conn->query("UPDATE Laptops SET nama = '$nama', merk = '$merk', spesifikasi = '$spesifikasi', stok = $stok, harga = $harga WHERE id_laptop = $id");
                echo json_encode($query ? ["message" => "Product updated successfully"] : ["error" => $conn->error]);
            } else {
                echo json_encode(["error" => "Invalid input"]);
            }
        } else {
            echo json_encode(["error" => "Product ID is required"]);
        }
        break;

    case 'DELETE': // DELETE
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = $conn->query("DELETE FROM Laptops WHERE id_laptop = $id");
            echo json_encode($query ? ["message" => "Product deleted successfully"] : ["error" => $conn->error]);
        } else {
            echo json_encode(["error" => "Product ID is required"]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}
?>
