<?php
// Menangani error yang mungkin terjadi
$error_message = "";
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'email_exists') {
        $error_message = "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        $error_message = "Terjadi kesalahan. Silakan coba lagi nanti.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gagal Pendaftaran</title>
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
        }
        .error-container {
            background: linear-gradient(135deg, #0097A7, #00BCD4);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
            color: white;
        }
        .error-container h2 {
            font-size: 26px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .error-message {
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #ffeb3b;
        }
        .form-button button {
            background-color: #00BCD4;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s;
        }
        .form-button button:hover {
            background-color: #0097A7;
        }
        .form-button button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h2>Gagal Mendaftar!</h2>
        <div class="error-message">
            <?php echo $error_message; ?>
        </div>
        <div class="form-button">
            <!-- Tombol kembali ke form pendaftaran -->
            <a href="form.html"><button>Kembali ke Form Pendaftaran</button></a>
        </div>
    </div>
</body>
</html>
