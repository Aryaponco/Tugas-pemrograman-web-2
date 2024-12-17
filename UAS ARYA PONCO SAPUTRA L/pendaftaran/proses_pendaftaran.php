<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpendaftaran"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $foto = $_FILES['foto']['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Cek jika email sudah ada di database
    $checkEmail = "SELECT * FROM tbpendaftar WHERE email = '$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        header("Location: error.php?error=email_exists");
        exit();
    }

    // Pindahkan foto ke folder 'uploads'
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($foto);
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO tbpendaftar (nama, email, telepon, alamat, tanggal_lahir, jenis_kelamin, foto, username, password) 
                VALUES ('$nama', '$email', '$telepon', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$foto', '$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman pembelian tiket
            header("Location: pembelian_tiket.php");
            exit();
        } else {
            header("Location: error.php?error=db_error");
            exit();
        }
    } else {
        header("Location: error.php?error=file_upload");
        exit();
    }
}
?>
