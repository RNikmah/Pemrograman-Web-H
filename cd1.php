<?php
function segitigaNaik($n) {
    for ($i = 1; $i <= $n; $i++) {
        // Cetak spasi
        for ($j = $n; $j > $i; $j--) {
            echo "&nbsp;&nbsp;";
        }
        // Cetak bintang
        for ($k = 1; $k <= (2 * $i - 1); $k++) {
            echo "* ";
        }
        echo "<br>";
    }
}


$n = 9;

// Segitiga naik
segitigaNaik($n);

?>
