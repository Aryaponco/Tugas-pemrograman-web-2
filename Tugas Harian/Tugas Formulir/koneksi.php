<?php
$host = 'localhost'; // Ganti dengan host MySQL Anda jika berbeda
$username = 'root'; // Ganti dengan username MySQL Anda
$password = ''; // Ganti dengan password MySQL Anda jika ada
$dbname = 'pendaftaran'; // Nama database yang sudah dibuat

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
