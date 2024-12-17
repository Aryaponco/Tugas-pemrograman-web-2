<?php
session_start();

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "dbpendaftaran");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$error = "";

// Cek jika form login disubmit
if (isset($_POST['submit'])) {
    $username = $koneksi->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Query untuk mengambil data admin berdasarkan username
    $query = "SELECT * FROM tbadmin WHERE username = '$username'";
    $result = $koneksi->query($query);

    // Verifikasi jika data ditemukan
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $data['password'])) {
            // Set session untuk login
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama_admin'] = $data['nama_admin'];

            // Redirect ke halaman dashboard setelah login sukses
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
            background: linear-gradient(135deg, #0097A7, #00BCD4);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .login-container label {
            display: block;
            text-align: left;
            color: #fff;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #0097A7;
            border-radius: 10px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .login-container input:focus {
            border-color: #00BCD4;
            outline: none;
        }

        .login-container button {
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

        .login-container button:hover {
            background-color: #0097A7;
        }

        .login-container .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login Admin</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" name="submit">Login</button>
    </form>
    <?php if ($error) { echo "<p class='error'>$error</p>"; } ?>
</div>

</body>
</html>
