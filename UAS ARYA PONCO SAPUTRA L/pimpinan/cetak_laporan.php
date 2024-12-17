<?php
session_start();

// Periksa apakah pimpinan sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login_pimpinan.php");
    exit;
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpendaftaran"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari tabel (contoh: tb_pendaftaran)
$sql = "SELECT * FROM tbpendaftar"; // Ganti dengan tabel Anda
$result = $conn->query($sql);

// Query untuk mengambil data pembelian tiket
$sql = "SELECT * FROM pembelian_tiket"; // Ganti dengan tabel yang sesuai
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: #e0f7fa;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #004D40;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background: linear-gradient(135deg, #00796B, #009688);
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #e0f7fa;
        }

        .print-btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #00796B, #009688);
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s;
        }

        .print-btn:hover {
            background: #004D40;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

<h1>Laporan Pembelian Tiket</h1>

<!-- Tabel untuk data pembelian tiket -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pendaftar</th>
            <th>Jenis Tiket</th>
            <th>Jumlah Tiket</th>
            <th>Total Pembayaran</th>
            <th>Tanggal Pembelian</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_pendaftar']); ?></td>
                    <td><?= htmlspecialchars($row['jenis_tiket']); ?></td>
                    <td><?= htmlspecialchars($row['jumlah_tiket']); ?></td>
                    <td>Rp <?= number_format($row['total_pembayaran'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($row['tanggal_pembelian']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Tidak ada data pembelian tiket.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Tombol Cetak -->
<div style="text-align: center;">
    <a href="#" onclick="window.print()" class="print-btn">Cetak Laporan</a>
</div>

<footer>
    &copy; 2024 Sistem Pendaftaran | Semua Hak Dilindungi
</footer>

</body>
</html>
