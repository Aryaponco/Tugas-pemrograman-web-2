<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk menyimpan data
$id = $nama = $email = $telepon = $alamat = "";
$jenis_tiket = $jumlah_tiket = $created_at = "";

// Langkah 1: Cari data berdasarkan ID
if (isset($_POST['cari'])) {
    $id = intval($_POST['id']); // Pastikan ID angka

    if ($id > 0) {
        $stmt = $conn->prepare("SELECT * FROM tbpendaftar WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $nama = $data['nama'];
            $email = $data['email'];
            $telepon = $data['telepon'];
            $alamat = $data['alamat'];
        } else {
            echo "<p style='color: red;'>Data dengan ID $id tidak ditemukan.</p>";
        }
        $stmt->close();

        // Ambil data tiket
        $stmt_tiket = $conn->prepare("SELECT * FROM pembelian_tiket WHERE nama_pendaftar = ?");
        $stmt_tiket->bind_param("s", $nama);
        $stmt_tiket->execute();
        $result_tiket = $stmt_tiket->get_result();

        if ($result_tiket && $result_tiket->num_rows > 0) {
            $data_tiket = $result_tiket->fetch_assoc();
            $jenis_tiket = $data_tiket['jenis_tiket'];
            $jumlah_tiket = $data_tiket['jumlah_tiket'];
            $created_at = $data_tiket['created_at'];
        } else {
            echo "<p style='color: red;'>Data tiket tidak ditemukan.</p>";
        }
        $stmt_tiket->close();
    }
}

// Langkah 2: Konfirmasi dan Hapus Data
if (isset($_POST['hapus'])) {
    $id = intval($_POST['id']);
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM tbpendaftar WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        if ($result) {
            echo "<p style='color: green;'>Data dengan ID $id berhasil dihapus.</p>";
        } else {
            echo "<p style='color: red;'>Gagal menghapus data: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Pendaftar</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #0097A7;
        }
        label {
            font-size: 1rem;
            color: #333;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }
        button {
            background-color: #0097A7;
            color: white;
            padding: 10px 20px;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #007C7F;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .danger-button {
            background-color: #f44336;
        }
        .danger-button:hover {
            background-color: #d32f2f;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .back-button-container {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 100%;
            text-align: center;
        }
        .readonly-field {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            color: #555;
            padding: 10px;
            font-size: 1rem;
            width: 100%;
            border-radius: 5px;
        }
        .table-data td {
            padding: 10px;
            vertical-align: middle;
        }
        .data-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hapus Data Pendaftar</h2>

    <!-- Form untuk mencari data berdasarkan ID -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="id">Masukkan ID yang ingin dihapus:</label>
            <input type="text" name="id" id="id" required>
        </div>
        <button type="submit" name="cari">Cari Data</button>
    </form>

    <?php if (!empty($nama)): ?>
        <div class="data-section">
            <h3>Data yang Akan Dihapus</h3>
            <table border="1" cellspacing="0" cellpadding="10" width="100%" style="border-collapse: collapse; text-align: left;">
                <tr>
                    <th>ID</th>
                    <td><?= htmlspecialchars($id); ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?= htmlspecialchars($nama); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td><?= htmlspecialchars($telepon); ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= htmlspecialchars($alamat); ?></td>
                </tr>
            </table>
        </div>

        <div class="data-section">
            <h3>Informasi Pembelian Tiket</h3>
            <div class="form-group">
                <label>Jenis Tiket:</label>
                <input type="text" value="<?= $jenis_tiket; ?>" class="readonly-field" readonly>
            </div>
            <div class="form-group">
                <label>Jumlah Tiket:</label>
                <input type="number" value="<?= $jumlah_tiket; ?>" class="readonly-field" readonly>
            </div>
            <div class="form-group">
                <label>Dibeli pada:</label>
                <input type="text" value="<?= $created_at; ?>" class="readonly-field" readonly>
            </div>
        </div>

        <!-- Konfirmasi Hapus Data -->
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="button-container">
                <button type="submit" name="hapus" class="danger-button">Hapus Data</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<!-- Tombol Kembali ke Dashboard di bawah -->
<div class="back-button-container">
    <a href="dashboard.php" style="text-decoration: none;">
        <button type="button" class="danger-button">Kembali ke Dashboard</button>
    </a>
</div>

</body>
</html>
