<?php
// Memulai session
session_start();

// Hapus semua session yang aktif
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: login_pimpinan.php");
exit;
?>
