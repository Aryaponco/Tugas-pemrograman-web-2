<?php
for ($angka = 1; $angka <= 20; $angka++) {
    $a = 0;
    for ($j = 1; $j <= $angka; $j++) {
        if ($angka % $j == 0) {
            $a++;
        }
    }

    if ($a == 2) { 
        $prima = true;
    } else {
        $prima = false;
    }

    if ($angka % 2 == 1) {
        if ($prima) {
            echo "<li>angka $angka adalah bilangan ganjil sekaligus bilangan prima";
        } else {
            echo "<li>angka $angka adalah bilangan ganjil";
        }
    } elseif ($angka % 2 == 0) {
        if ($prima) {
            echo "<li>angka $angka adalah bilangan genap sekaligus bilangan prima";
        } else {
            echo "<li>angka $angka adalah bilangan genap";
        }
    }
}
?>