<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data pembelian tiket
$query_pembelian = "SELECT * FROM pembelian_tiket";
$result_pembelian = $conn->query($query_pembelian);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian Tiket</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        table {
            width: 80%;
            margin: 40px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #1E3D58;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        .container {
            width: 90%;
            margin: 40px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #0097A7;
        }
        .back-button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .back-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        .back-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Pembelian Tiket</h2>
    <?php
    // Tampilkan data pembelian tiket
    if ($result_pembelian && $result_pembelian->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nama Pendaftar</th><th>Jenis Tiket</th><th>Jumlah Tiket</th><th>Total Pembayaran</th><th>Tanggal Pembelian</th></tr>";
        while ($row = $result_pembelian->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nama_pendaftar'] . "</td>";
            echo "<td>" . $row['jenis_tiket'] . "</td>";
            echo "<td>" . $row['jumlah_tiket'] . "</td>";
            echo "<td>Rp " . number_format($row['total_pembayaran'], 0, ',', '.') . "</td>";
            echo "<td>" . $row['tanggal_pembelian'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>Tidak ada data pembelian tiket ditemukan.</p>";
    }
    ?>
</div>

<!-- Tombol Kembali ke Dashboard Admin di tengah bawah -->
<div class="back-button-container">
    <a href="dashboard_pimpinan.php" style="text-decoration: none;">
        <button type="button" class="back-button">Kembali ke Dashboard</button>
    </a>
</div>

</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
