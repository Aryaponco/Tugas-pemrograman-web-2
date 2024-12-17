<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_pimpinan = $_POST['nama_pimpinan'];

    // Hash password menggunakan password_hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data ke dalam database
    $query = "INSERT INTO tb_pimpinan (username, password, nama_pimpinan) 
              VALUES ('$username', '$hashed_password', '$nama_pimpinan')";

    if ($koneksi->query($query) === TRUE) {
        echo "Pimpinan berhasil didaftarkan!";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pimpinan</title>
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
        .form-button input[type="submit"] {
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
        .form-button input[type="submit"]:hover {
            background-color: #0097A7;
        }
        .form-button input[type="submit"]:active {
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
    <div class="form-container">
        <h2>Pendaftaran Pimpinan</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="nama_pimpinan">Nama Pimpinan:</label>
                <input type="text" id="nama_pimpinan" name="nama_pimpinan" required>
            </div>

            <div class="form-button">
                <input type="submit" value="Daftar">
            </div>
        </form>
    </div>
</body>
</html>
