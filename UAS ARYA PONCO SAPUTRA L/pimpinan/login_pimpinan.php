<?php
session_start(); // Memulai session

// Koneksi ke database (gunakan parameter yang sesuai dengan database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpendaftaran";  // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses login jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    // Query untuk mengambil data dari tabel tb_pimpinan
    $sql = "SELECT * FROM tb_pimpinan WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah username ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password_input, $row['password'])) {
            $_SESSION['username'] = $username_input;
            $_SESSION['nama_pimpinan'] = $row['nama'];
            header("Location: dashboard_pimpinan.php");
            exit;
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username atau password salah!";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pimpinan</title>
    <style>
        /* Tampilan Utama */
/* Tampilan Utama */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(120deg, #00bcd4, #0097a7);
    color: #fff;
}

.form-container {
    background: #ffffff;
    color: #333;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-container h2 {
    margin-bottom: 30px;
    font-size: 28px;
    color: #0097a7;
}

.form-container form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;  /* Memastikan form mengisi ruang */
}

.form-container label {
    font-size: 14px;
    text-align: left;
    color: #555;
}

.form-container input[type="text"],
.form-container input[type="password"] {
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-container input[type="text"]:focus,
.form-container input[type="password"]:focus {
    border-color: #00bcd4;
    box-shadow: 0 0 8px rgba(0, 188, 212, 0.5);
    outline: none;
}

.form-container input[type="submit"] {
    background: #00bcd4;
    color: #fff;
    padding: 12px 15px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-container input[type="submit"]:hover {
    background: #0097a7;
    box-shadow: 0 8px 16px rgba(0, 151, 167, 0.3);
}

.form-container .error-message {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 20px; /* Menambahkan jarak atas */
    margin-bottom: 20px; /* Menambahkan jarak bawah */
    text-align: center; /* Menjaga perataan pesan */
    width: 100%; /* Memastikan pesan menggunakan seluruh lebar */
}

/* Responsive */
@media (max-width: 480px) {
    .form-container {
        padding: 20px;
    }
}

    </style>
</head>
<body>

<div class="form-container">
    <h2>Login Pimpinan</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>

        <input type="submit" value="Login">
    </form>

    <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
</div>

</body>
</html>
