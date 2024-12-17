<?php
session_start(); // Memulai session

// Cek apakah pimpinan sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login_pimpinan.php"); // Arahkan ke login jika belum login
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data admin
$query_admin = "SELECT * FROM tbadmin";
$result_admin = $conn->query($query_admin);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
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

        table {
            width: 100%;
            margin-top: 20px;
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
    <h2>Data Admin</h2>
    <?php
    // Tampilkan data admin
    if ($result_admin && $result_admin->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Nama Admin</th><th>Nama Lengkap</th><th>Telepon</th><th>Alamat</th><th>Tanggal Lahir</th><th>Jenis Kelamin</th><th>Foto</th></tr>";
        while ($row = $result_admin->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['nama_admin'] . "</td>";
            echo "<td>" . $row['nama_lengkap'] . "</td>";
            echo "<td>" . $row['telepon'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>" . $row['tanggal_lahir'] . "</td>";
            echo "<td>" . $row['jenis_kelamin'] . "</td>";
            echo "<td><img src='uploads/" . $row['foto'] . "' alt='Foto Admin' style='width: 50px; height: 50px; border-radius: 50%; object-fit: cover;'></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>Tidak ada data admin ditemukan.</p>";
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
