<?php

$pahlawan = [
    [
        "nama" => "Soekarno",
        "gambar" => "Gambar pahlawan\soekarno.jpg",
        "deskripsi" => "Presiden pertama Republik Indonesia",
        "lahir" => "6 Juni 1901",
        "meninggal" => "21 Juni 1970",
    ],
    [
        "nama" => "Mohammad Hatta",
        "gambar" => "Gambar pahlawan\mo hatta.jpg",
        "deskripsi" => "Wakil Presiden pertama Republik Indonesia",
        "lahir" => "12 Agustus 1902",
        "meninggal" => "14 Maret 1980",
    ],
    [
        "nama" => "Cut Nyak Dien",
        "gambar" => "Gambar pahlawan\cut ntak dien.jpg",
        "deskripsi" => "Pahlawan perempuan dari Aceh yang melawan penjajah Belanda",
        "lahir" => "1848",
        "meninggal" => "6 November 1908",
    ],
    [
        "nama" => "R.A Kartini",
        "gambar" => "Gambar pahlawan\kartini.jpg",
        "deskripsi" => "Pejuang Hak asasi perempuan",
        "lahir" => "21 April 1879",
        "meninggal" => "17 September 1904",
    ],
    [
        "nama" => "Pangeran Diponegoro",
        "gambar" => "Gambar pahlawan\diponegoro.jpg",
        "deskripsi" => "Pemimpin perang Jawa (1825-1830) melawan kolonial belanda",
        "lahir" => "11 November 1785",
        "meninggal" => "8 Januari 1855",
    ],
    [
        "nama" => "Jenderal Sudirman",
        "gambar" => "Gambar pahlawan\sudirman.jpg",
        "deskripsi" => "Panglima besar TNI yang mempertahankan kemerdekaan Indonesia.",
        "lahir" => "24 Januari 1916",
        "meninggal" => "29 Januari 1950",
    ],
    [
        "nama" => "Ki Hajar Dewantara",
        "gambar" => "Gambar pahlawan\ki hajar dewantara.jpg",
        "deskripsi" => "Bapak Pendidikan Nasional dan pendiri Taman Siswa.",
        "lahir" => "2 Mei 1889",
        "meninggal" => "26 April 1959",
    ],
    [
        "nama" => "Sultan Hasanuddin",
        "gambar" => "Gambar pahlawan\hasanudin.jpg",
        "deskripsi" => "Pahlawan dari Makassar yang melawan VOC untuk mempertahankan kedaulatan Gowa.",
        "lahir" => "12 Januari 1631",
        "meninggal" => "12 Juni 1670",
    ],
    [
        "nama" => "Tuanku Imam Bonjol",
        "gambar" => "Gambar pahlawan\imam bonjol.jpg",
        "deskripsi" => "Pemimpin Perang Padri melawan Belanda di Sumatra Barat.",
        "lahir" => "1772",
        "meninggal" => "6 November 1864",
    ],
    [
       "nama" => "Patimura (Thomas Matulessy)",
        "gambar" => "Gambar pahlawan\pattimura.jpg",
        "deskripsi" => "Pahlawan dari Maluku yang memimpin perlawanan rakyat Maluku melawan Belanda.",
        "lahir" => "8 Juni 1783",
        "meninggal" => "16 Desember 1817",
    ],
];


$pahlawan_array = [
    "pahlawan" => $pahlawan,
];


echo "<table>";
echo "<tr>";
echo "<th>Nama</th>";
echo "<th>Gambar</th>";
echo "<th>Deskripsi</th>";
echo "<th>Lahir</th>";
echo "<th>Meninggal</th>";
echo "</tr>";

foreach ($pahlawan_array["pahlawan"] as $pahlawan) {
    echo "<tr>";
    echo "<td>" . $pahlawan["nama"] . "</td>";
    echo "<td><img src=\"" . $pahlawan["gambar"] . "\" width=\"100\" height=\"100\"></td>";
    echo "<td>" . $pahlawan["deskripsi"] . "</td>";
    echo "<td>" . $pahlawan["lahir"] . "</td>";
    echo "<td>" . $pahlawan["meninggal"] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>