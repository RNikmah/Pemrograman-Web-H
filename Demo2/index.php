<?php
// Meminta input dari pengguna
echo "Masukkan bilangan: ";
$n = trim(fgets(STDIN));

// Fungsi untuk mencetak hasil sesuai dengan ketentuan
function cetakBilangan($n) {
    // Cek apakah input adalah bilangan bulat positif
    if (!is_numeric($n) || $n <= 0) {
        echo "Masukkan bilangan bulat positif.\n";
        return;
    }

    // Perulangan dari 1 hingga n
    for ($i = 1; $i <= $n; $i++) {
        // Kondisi bilangan habis dibagi 4 dan 6
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo "Pemrograman Website 2024\n";
        }
        // Kondisi bilangan habis dibagi 5
        elseif ($i % 5 == 0) {
            echo "2024\n";
        }
        // Kondisi bilangan hanya habis dibagi 4 tetapi tidak habis dibagi 6
        elseif ($i % 4 == 0) {
            echo "Pemrograman\n";
        }
        // Kondisi bilangan hanya habis dibagi 6 tetapi tidak habis dibagi 4
        elseif ($i % 6 == 0) {
            echo "Website\n";
        }
        else {
            echo "$i\n";
        }
    }
}

cetakBilangan($n);
