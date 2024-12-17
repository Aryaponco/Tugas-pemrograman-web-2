<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Variabel untuk menampung pesan error atau sukses
$error = $success = "";

// Cek jika form disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $username = $koneksi->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $nama_admin = $koneksi->real_escape_string($_POST['nama_admin']); // Ambil nama_admin dari form
    $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash password

    // Query untuk memasukkan data admin baru
    $query = "INSERT INTO tbadmin (username, password, nama_admin) VALUES ('$username', '$password_hash', '$nama_admin')";

    if ($koneksi->query($query) === TRUE) {
        $success = "Admin baru berhasil ditambahkan.";
    } else {
        $error = "Gagal menambahkan admin: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Admin</title>
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
            background-image: url('https://www.transparenttextures.com/patterns/diamonds.png');
        }
        .form-container {
            background: linear-gradient(135deg, #0097A7, #00BCD4);
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            animation: fadeIn 1s ease-out;
            margin: 20px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .form-group {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #fff;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #0097A7;
            border-radius: 10px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .form-group input[type="text"], 
        .form-group input[type="password"] {
            font-size: 16px;
        }
        .form-group input:focus {
            border-color: #00BCD4;
            outline: none;
        }
        .form-button {
            text-align: center;
        }
        .form-button button {
            background-color: #00BCD4;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            box-sizing: border-box;
            transition: background-color 0.3s;
        }
        .form-button button:hover {
            background-color: #0097A7;
        }
        .form-button button:active {
            transform: scale(0.98);
        }

        .form-message {
            text-align: center;
            margin-top: 20px;
        }

        .form-message p {
            font-size: 16px;
            font-weight: bold;
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
    <div class="form-container">
        <h2>Pendaftaran Admin Baru</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="nama_admin">Nama Admin:</label>
                <input type="text" name="nama_admin" id="nama_admin" required>
            </div>
            <div class="form-button">
                <button type="submit" name="submit">Daftar</button>
            </div>
        </form>
        
        <div class="form-message">
            <?php if ($error) { echo "<p style='color:red;'>$error</p>"; } ?>
            <?php if ($success) { echo "<p style='color:green;'>$success</p>"; } ?>
        </div>
    </div>
</body>
</html>
