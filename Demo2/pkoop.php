<?php
// Definisikan class BilanganChecker
class BilanganChecker
{
    private $n;

    // Konstruktor untuk menerima input nilai n
    public function __construct($n)
    {
        $this->n = $n;
    }

    // Method untuk memeriksa dan mencetak hasil sesuai ketentuan
    public function cetakBilangan()
    {
        // Cek apakah input adalah bilangan bulat positif
        if (!is_numeric($this->n) || $this->n <= 0) {
            echo "Masukkan bilangan bulat positif.\n";
            return;
        }

        // Perulangan dari 1 hingga n
        for ($i = 1; $i <= $this->n; $i++) {
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
            // Kondisi jika bilangan tidak memenuhi salah satu kondisi di atas
            else {
                echo "$i\n";
            }
        }
    }
}

// Meminta input dari pengguna
echo "Masukkan bilangan bulat positif: ";
$n = trim(fgets(STDIN));

// Membuat objek dari class BilanganChecker dan memanggil method cetakBilangan
$checker = new BilanganChecker($n);
$checker->cetakBilangan();
