<?php
include 'koneksi.php'; // Koneksi database

// Cek jika admin sudah login
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Cek jika data admin sudah lengkap
$username = $_SESSION['username'];
$sql_check = "SELECT * FROM tbadmin WHERE username = '$username'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    $admin_data = $result->fetch_assoc();
    if (!empty($admin_data['nama_lengkap']) && !empty($admin_data['telepon']) && !empty($admin_data['alamat'])) {
        header("Location: dashboard.php"); // Jika data sudah lengkap, redirect ke dashboard
        exit();
    }
}

if (isset($_POST['submit'])) {
    // Verifikasi username dan password
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Cek apakah username dan password sesuai
    if ($input_username === $_SESSION['username'] && password_verify($input_password, $admin_data['password'])) {
        // Ambil data dari form
        $nama_lengkap = $_POST['nama_lengkap'];
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];

        // Proses upload foto
        $foto = $_FILES['foto']['name'];
        $tmp_foto = $_FILES['foto']['tmp_name'];
        $folder = "../uploads/";

        // Cek jika folder belum ada, maka buat
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($tmp_foto, $folder . $foto)) {
            // Query untuk update data admin
            $sql = "UPDATE tbadmin 
                    SET nama_lengkap='$nama_lengkap', telepon='$telepon', alamat='$alamat', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', foto='$foto' 
                    WHERE username='$username'";

            if ($conn->query($sql) === TRUE) {
                // Jika data berhasil diperbarui, tampilkan pesan
                $success = true;
            } else {
                $error = "Error: " . $conn->error;
            }
        } else {
            $error = "Gagal mengupload foto.";
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Data Admin</title>
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

        .container {
            background: #ffffff;
            color: #333333;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #006064;
        }

        .container label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            text-align: left;
            display: block;
        }

        .container input[type="text"], .container input[type="date"], .container textarea, .container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .container input[type="radio"] {
            margin-right: 10px;
        }

        .container button {
            background-color: #006064;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container button:hover {
            background-color: #00bcd4;
        }

        .container .btn-kembali {
            background-color: #f44336;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .container .btn-kembali:hover {
            background-color: #e53935;
        }

        .success-message {
            color: #4caf50;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error-message {
            color: #f44336;
            margin-bottom: 20px;
            font-weight: bold;
        }

        footer {
            margin-top: 30px;
            font-size: 14px;
            color: #ffffff;
        }

        /* Responsif */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .container h2 {
                font-size: 20px;
            }

            .container label {
                font-size: 14px;
            }

            .container input[type="text"], .container input[type="date"], .container textarea, .container input[type="file"], .container button {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (isset($success) && $success): ?>
        <p class="success-message">Data admin berhasil dilengkapi!</p>
        <a href="dashboard.php" class="btn-kembali">Kembali ke Dashboard</a>
    <?php else: ?>
        <h2>Lengkapi Data Admin</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Verifikasi Username dan Password -->
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" readonly>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" required>

            <label for="telepon">Telepon:</label>
            <input type="text" name="telepon" id="telepon" required>

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" id="alamat" rows="4" required></textarea>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>

            <label>Jenis Kelamin:</label>
            <div class="radio-group">
                <input type="radio" name="jenis_kelamin" value="L" required> Laki-laki
                <input type="radio" name="jenis_kelamin" value="P" required> Perempuan
            </div>

            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto" required>

            <button type="submit" name="submit">Simpan Data</button>
        </form>
        <a href="dashboard.php" class="btn-kembali">Kembali ke Dashboard</a>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Sistem Pendaftaran | Semua Hak Dilindungi</p>
</footer>

</body>
</html>
