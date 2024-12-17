<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .success-container {
            text-align: center;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .success-container h1 {
            font-size: 2rem;
            color: #23a5f0;
            margin-bottom: 20px;
        }
        .success-container p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #555;
        }
        .success-container .button-container {
            display: flex;
            justify-content: center;
        }
        .success-container a {
            text-decoration: none;
            color: white;
            background-color: #23a5f0;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            margin: 0 5px;
        }
        .success-container a:hover {
            background-color: #1e8cd1;
        }
    </style>
</head>
<body>

<div class="success-container">
    <h1>Pendaftaran Berhasil!</h1>
    <p>Terima kasih, <?= htmlspecialchars($_GET['name']); ?>, telah mendaftar. Kami akan segera menghubungi Anda!</p>
    <div class="button-container">
        <a href="Formulir.html">Kembali ke Form</a>
    </div>
</div>

</body>
</html>
