<?php
// Ambil data dari query string
$nama_pendaftar = isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : '';
$jenis_tiket = isset($_GET['jenis']) ? htmlspecialchars($_GET['jenis']) : '';
$jumlah_tiket = isset($_GET['jumlah']) ? (int) $_GET['jumlah'] : 0;

// Tentukan harga berdasarkan jenis tiket
$harga_tiket = 0;
switch ($jenis_tiket) {
    case 'VVIP': $harga_tiket = 1000000; break;
    case 'VIP': $harga_tiket = 750000; break;
    case 'CAT 1': $harga_tiket = 500000; break;
    case 'CAT 2': $harga_tiket = 300000; break;
    case 'CAT 3': $harga_tiket = 200000; break;
    case 'CAT 4': $harga_tiket = 100000; break;
}

// Hitung total pembayaran
$total_pembayaran = $harga_tiket * $jumlah_tiket;

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menyimpan data pembelian tiket ke dalam database
$query = "INSERT INTO pembelian_tiket (nama_pendaftar, jenis_tiket, jumlah_tiket, total_pembayaran, tanggal_pembelian) 
          VALUES ('$nama_pendaftar', '$jenis_tiket', '$jumlah_tiket', $total_pembayaran, NOW())";
          
if ($conn->query($query) === TRUE) {
    // Jika berhasil, redirect ke halaman berhasil
    header("Location: berhasil.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
