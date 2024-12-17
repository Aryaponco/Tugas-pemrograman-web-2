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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Berhasil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: linear-gradient(135deg, #006064, #00BCD4);
            color: white;
            max-width: 600px;
            margin: 20px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s ease-out;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        p {
            font-size: 18px;
            margin-bottom: 15px;
        }
        .total {
            font-size: 24px;
            font-weight: bold;
            margin-top: 15px;
            background-color: #00796B;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        button {
            background-color: #009688;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #00796B;
        }
        button:active {
            transform: scale(0.98);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pembelian Tiket Berhasil!</h1>
        <p>Terima kasih, <strong><?= $nama_pendaftar; ?></strong>, telah melakukan pembelian tiket.</p>
        <p>Anda membeli tiket jenis <strong><?= $jenis_tiket; ?></strong> sebanyak <strong><?= $jumlah_tiket; ?></strong> tiket.</p>
        <div class="total">
            Total Pembayaran: Rp <?= number_format($total_pembayaran, 0, ',', '.'); ?>
        </div>
        <a href="pembelian_tiket.php">
            <button>Beli Tiket Lagi</button>
        </a>
    </div>
</body>
</html>
