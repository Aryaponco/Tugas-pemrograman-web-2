<?php
$servername = "localhost";
$username = "root"; // username untuk koneksi ke MySQL
$password = ""; // password untuk koneksi ke MySQL
$dbname = "dbpendaftaran"; // ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
