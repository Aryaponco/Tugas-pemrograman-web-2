<?php
// Include koneksi ke database
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Simpan data ke database
    $sql = "INSERT INTO formulir (name, email, phone, birthdate, gender, address)
            VALUES ('$name', '$email', '$phone', '$birthdate', '$gender', '$address')";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman sukses
        header("Location: sukses.php?name=" . urlencode($name));
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}
?>
