<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Variabel untuk menyimpan data
$id = $nama = $email = $telepon = $alamat = $tanggal_lahir = $jenis_kelamin = $foto = "";
$jenis_tiket = $jumlah_tiket = $created_at = "";

// Cek form pencarian ID
if (isset($_POST['cari'])) {
    $id = intval($_POST['id']);
    // Ambil data dari tabel tbpendaftar
    $query = "SELECT * FROM tbpendaftar WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $id = $data['id'];
        $nama = $data['nama'];
        $email = $data['email'];
        $telepon = $data['telepon'];
        $alamat = $data['alamat'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $jenis_kelamin = isset($data['jenis_kelamin']) ? $data['jenis_kelamin'] : '';
        $foto = $data['foto'];
    } else {
        echo "<p style='color: red; text-align: center;'>Data dengan ID $id tidak ditemukan.</p>";
    }

    // Ambil data dari tabel pembelian_tiket
    $query_tiket = "SELECT * FROM pembelian_tiket WHERE nama_pendaftar = ?";
    $stmt_tiket = $koneksi->prepare($query_tiket);
    $stmt_tiket->bind_param("s", $nama);
    $stmt_tiket->execute();
    $result_tiket = $stmt_tiket->get_result();

    if ($result_tiket && $result_tiket->num_rows > 0) {
        $data_tiket = $result_tiket->fetch_assoc();
        $jenis_tiket = $data_tiket['jenis_tiket'];
        $jumlah_tiket = $data_tiket['jumlah_tiket'];
        $created_at = $data_tiket['created_at'];
    } else {
        echo "<p style='color: red; text-align: center;'>Data tiket tidak ditemukan.</p>";
    }

    $stmt->close();
    $stmt_tiket->close();
}

// Cek form submit edit data
if (isset($_POST['submit'])) {
    $id_edit = intval($_POST['id']);
    $nama_edit = $koneksi->real_escape_string($_POST['nama']);
    $email_edit = $koneksi->real_escape_string($_POST['email']);
    $telepon_edit = $koneksi->real_escape_string($_POST['telepon']);
    $alamat_edit = $koneksi->real_escape_string($_POST['alamat']);
    $tanggal_lahir_edit = $_POST['tanggal_lahir'];
    $jenis_kelamin_edit = $_POST['jenis_kelamin'];
    $foto_edit = $_POST['foto'];

    $update_query = "UPDATE tbpendaftar SET nama = ?, email = ?, telepon = ?, alamat = ?, tanggal_lahir = ?, jenis_kelamin = ?, foto = ? WHERE id = ?";
    $stmt = $koneksi->prepare($update_query);
    $stmt->bind_param("sssssssi", $nama_edit, $email_edit, $telepon_edit, $alamat_edit, $tanggal_lahir_edit, $jenis_kelamin_edit, $foto_edit, $id_edit);
    $result = $stmt->execute();

    echo $result ? "<p style='color: green; text-align: center;'>Data berhasil diperbarui.</p>" : "<p style='color: red;'>Gagal memperbarui data.</p>";
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pendaftar</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
            color: #009688;
            margin-bottom: 20px;
        }
        form .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        form .form-group label {
            flex: 1;
            font-weight: bold;
            margin-right: 10px;
        }
        form .form-group input,
        form .form-group textarea,
        form .form-group select {
            flex: 2;
            padding: 8px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form .form-group input[type="radio"] {
            margin-right: 10px;
        }
        button {
            background: #009688;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background: #00796b;
        }
        .info {
            text-align: center;
            margin: 20px 0;
            font-size: 1.1rem;
            color: #666;
        }
        hr {
            margin: 20px 0;
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
        /* Posisi tombol kembali ke dashboard di tengah bawah */
        .back-button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        /* Styling untuk readonly fields */
        .readonly-field {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Cari dan Edit Data Pendaftar</h2>

    <!-- Form untuk mencari data berdasarkan ID -->
    <form method="POST">
        <div class="form-group">
            <label for="id">Masukkan ID Pendaftar:</label>
            <input type="text" name="id" id="id" required>
        </div>
        <button type="submit" name="cari">Cari</button>
    </form>
    
    <?php if (!empty($id)): ?>
        <hr>
        <h3>Edit Data</h3>
        <p class="info">
            Anda sedang mengedit data milik <strong><?= htmlspecialchars($nama); ?></strong> (ID: <?= $id; ?>)
        </p>

        <!-- Form untuk mengedit data -->
        <form method="POST">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" value="<?= $nama; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= $email; ?>" required>
            </div>

            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" name="telepon" id="telepon" value="<?= $telepon; ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" required><?= $alamat; ?></textarea>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?= $tanggal_lahir; ?>" required>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <div>
                    <input type="radio" name="jenis_kelamin" value="L" <?= (isset($jenis_kelamin) && $jenis_kelamin == 'L') ? 'checked' : ''; ?>> Laki-laki
                    <input type="radio" name="jenis_kelamin" value="P" <?= (isset($jenis_kelamin) && $jenis_kelamin == 'P') ? 'checked' : ''; ?>> Perempuan
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Foto (link):</label>
                <input type="text" name="foto" id="foto" value="<?= $foto; ?>">
            </div>

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

            <button type="submit" name="submit">Simpan Perubahan</button>
        </form>
    <?php endif; ?>
</div>

<!-- Tombol Kembali ke Dashboard Admin di tengah bawah -->
<div class="back-button-container">
    <a href="dashboard.php" style="text-decoration: none;">
        <button type="button" class="back-button">Kembali ke Dashboard Admin</button>
    </a>
</div>

</body>
</html>
