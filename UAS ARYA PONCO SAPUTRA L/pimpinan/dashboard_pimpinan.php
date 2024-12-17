<?php
session_start(); // Memulai session

// Cek apakah pimpinan sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login_pimpinan.php"); // Arahkan ke login jika belum login
    exit;
}

// Cek apakah session 'nama_pimpinan' sudah ada
$nama_pimpinan = isset($_SESSION['nama_pimpinan']) ? $_SESSION['nama_pimpinan'] : 'Pimpinan';

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #006064, #00bcd4);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        header h1 {
            font-size: 36px;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .container {
            background: #ffffff;
            color: #333333;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            text-align: center;
            width: 100%;
        }

        .container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #006064;
            font-weight: bold;
        }

        .menu {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .menu a {
            background: #006064;
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 18px;
            text-decoration: none;
            text-align: center; /* Memastikan teks berada di tengah */
            font-weight: bold;
            transition: all 0.3s ease;
            width: 200px;
            margin: 10px 0;
            display: flex; /* Flexbox untuk memastikan tombol fleksibel */
            align-items: center; /* Vertikal center */
            justify-content: center; /* Horizontal center */
        }

        .menu a:hover {
            background: #00bcd4;
            transform: scale(1.05);
            box-shadow: 0px 4px 12px rgba(0, 188, 212, 0.4);
        }

        .logout-btn {
            display: inline-block;
            margin-top: 30px;
            background: #d32f2f;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #c62828;
            transform: scale(1.05);
            box-shadow: 0px 4px 12px rgba(211, 47, 47, 0.4);
        }

        footer {
            margin-top: 40px;
            font-size: 14px;
            color: #ffffff;
        }

        /* Responsif */
        @media (max-width: 480px) {
            .container {
                padding: 25px;
            }

            header h1 {
                font-size: 28px;
            }

            .container h2 {
                font-size: 24px;
            }

            .menu a {
                font-size: 14px;
                padding: 12px;
                width: 150px;
            }
        }

    </style>
</head>
<body>

<header>
    <h1>Dashboard Pimpinan</h1>
</header>

<div class="container">
    <h2>Selamat datang, <?php echo $nama_pimpinan; ?>!</h2>
    <div class="menu">
        <a href="lihat_data.php">Lihat Data</a>
        <a href="download_data.php">Download Laporan</a>
        <a href="cetak_laporan.php">Cetak Laporan</a>
        <a href="lihat_data_admin.php">Lihat Data Admin</a>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<footer>
    <p>&copy; 2024 Sistem Pendaftaran | Semua Hak Dilindungi</p>
</footer>

</body>
</html>
