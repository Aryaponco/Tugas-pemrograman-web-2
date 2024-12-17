<?php
$koneksi = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
