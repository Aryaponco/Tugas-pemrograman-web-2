<?php 
// Koneksi ke database
include 'koneksi.php';

// Ambil data pendaftar dari database
$sql = "SELECT nama, email, username, foto FROM tbpendaftar ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$data_pendaftar = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pendaftar = $_POST['nama_pendaftar'];
    $jenis_tiket = $_POST['jenis_tiket'];
    $jumlah_tiket = $_POST['jumlah_tiket'];

    // Simpan data ke tabel pembelian_tiket
    $sql_insert = "INSERT INTO pembelian_tiket (nama_pendaftar, jenis_tiket, jumlah_tiket) 
                   VALUES ('$nama_pendaftar', '$jenis_tiket', '$jumlah_tiket')";
    if ($conn->query($sql_insert) === TRUE) {
        // Redirect ke halaman pembayaran dengan membawa data tambahan (optional)
        header("Location: pembayaran.php?nama=$nama_pendaftar&jenis=$jenis_tiket&jumlah=$jumlah_tiket");
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.'); window.location='pembelian_tiket.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Tiket Motionime</title>
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
            background: #ffffff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            max-width: 800px;
            padding: 30px;
            width: 100%;
            animation: fadeIn 1s ease-out;
        }
        h1 {
            color: #009688;
            font-size: 36px;
            text-align: center;
            margin-bottom: 30px;
        }
        h2 {
            color: #00796B;
            font-size: 28px;
            margin-bottom: 20px;
            text-align: left;
        }
        .data-pendaftar {
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #009688;
            color: white;
        }
        img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        select, input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        button {
            background-color: #009688;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
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
        <!-- Judul Halaman -->
        <h1>Pembelian Tiket Motionime</h1>

        <!-- Data Pendaftar -->
        <div class="data-pendaftar">
            <h2>Data Pendaftar</h2>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Foto</th>
                </tr>
                <tr>
                    <td><?= htmlspecialchars($data_pendaftar['nama']); ?></td>
                    <td><?= htmlspecialchars($data_pendaftar['email']); ?></td>
                    <td><?= htmlspecialchars($data_pendaftar['username']); ?></td>
                    <td>
                        <img src="uploads/<?= htmlspecialchars($data_pendaftar['foto']); ?>" alt="Foto Pendaftar">
                    </td>
                </tr>
            </table>
        </div>

        <!-- Form Pembelian Tiket -->
        <h2>Form Pembelian Tiket</h2>
        <form method="POST" action="">
            <label for="nama_pendaftar">Nama Pendaftar:</label>
            <input type="text" name="nama_pendaftar" id="nama_pendaftar" 
                   value="<?= htmlspecialchars($data_pendaftar['nama']); ?>" readonly>

            <label for="jenis_tiket">Jenis Tiket:</label>
            <select name="jenis_tiket" id="jenis_tiket" required>
                <option value="VVIP">VVIP</option>
                <option value="VIP">VIP</option>
                <option value="CAT 1">CAT 1</option>
                <option value="CAT 2">CAT 2</option>
                <option value="CAT 3">CAT 3</option>
                <option value="CAT 4">CAT 4</option>
            </select>

            <label for="jumlah_tiket">Jumlah Tiket:</label>
            <input type="number" name="jumlah_tiket" id="jumlah_tiket" min="1" required>

            <button type="submit">Beli Tiket</button>
        </form>
    </div>
</body>
</html>
