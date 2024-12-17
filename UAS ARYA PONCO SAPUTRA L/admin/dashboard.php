<?php
session_start(); // Memulai session

// Cek apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit;
}

// Menampilkan nama admin yang login
$nama_admin = isset($_SESSION['nama_admin']) ? $_SESSION['nama_admin'] : 'Admin'; // Default ke 'Admin' jika tidak ada nama_admin
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa; /* Light Blue Background */
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #006064; /* Dark Blue */
            color: white;
            padding: 20px 0;
            text-align: center;
            font-size: 2rem;
            border-bottom: 4px solid #00bcd4; /* Light Blue */
        }

        .container {
            width: 90%;
            margin: 40px auto;
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative; /* Agar posisi profil bisa diatur relatif terhadap container */
        }

        .header-left {
            font-size: 1.5rem;
            color: #006064;
        }

        /* Styling untuk ikon profil di pojok kanan */
        .profile-icon {
            font-size: 1.5rem;
            color: #006064;
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-icon:hover {
            color: #00bcd4; /* Light Blue */
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .menu a {
            background-color: #00bcd4; /* Light Blue */
            color: white;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .menu a:hover {
            background-color: #006064; /* Dark Blue on hover */
            transform: translateY(-5px);
        }

        .logout-btn {
            display: block;
            width: 100%;
            text-align: center;
            background-color: #D32F2F; /* Red */
            color: white;
            padding: 15px;
            font-size: 1.2rem;
            text-decoration: none;
            border-radius: 10px;
            margin-top: 30px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #C62828; /* Dark Red on hover */
            transform: translateY(-5px);
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #006064; /* Dark Blue */
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>Selamat Datang di Dashboard Admin</h1>
</header>

<div class="container">
    <div class="header-left">
        <h2>Halo, <?php echo $nama_admin; ?>!</h2>
        <p>Anda berhasil login sebagai admin. Berikut adalah menu yang tersedia untuk Anda:</p>
    </div>
    
    <!-- Ikon Profil di pojok kanan atas -->
    <a href="tambah_data.php" class="profile-icon"><i class="fas fa-user-plus"></i></a>

    <div class="menu">
        <a href="lihat_data.php">Lihat Data</a>
        <a href="edit_data.php">Edit Data</a>
        <a href="hapus_data.php">Hapus Data</a>
    </div>
    
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<footer>
    <p>&copy; 2024 Sistem Pendaftaran | Semua Hak Dilindungi</p>
</footer>

</body>
</html>
