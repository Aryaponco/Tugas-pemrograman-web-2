<?php
session_start(); // Memulai session

// Cek apakah pimpinan sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login_pimpinan.php"); // Arahkan ke login jika belum login
    exit;
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpendaftaran"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data pembelian tiket
$sql = "SELECT * FROM pembelian_tiket"; // Ganti dengan tabel yang sesuai
$result = $conn->query($sql);

// Import PhpSpreadsheet
require 'vendor/autoload.php'; // Pastikan path ini sesuai dengan lokasi autoload.php Anda
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Buat Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama Pendaftar');
$sheet->setCellValue('C1', 'Jenis Tiket');
$sheet->setCellValue('D1', 'Jumlah Tiket');
$sheet->setCellValue('E1', 'Total Pembayaran');
$sheet->setCellValue('F1', 'Tanggal Pembelian');

// Styling Tabel
$sheet->getStyle('A1:F1')->getFont()->setBold(true); // Bold Header
$sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center align header
$sheet->getStyle('A1:F1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN); // Border untuk header
$sheet->getStyle('A1:F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('4CAF50'); // Warna hijau untuk header

// Atur lebar kolom agar pas dengan konten
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);

// Isi data
if ($result->num_rows > 0) {
    $rowNumber = 2; // Mulai dari baris kedua (karena baris pertama untuk header)
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $no++); // Nomor urut
        $sheet->setCellValue('B' . $rowNumber, $row['nama_pendaftar']);
        $sheet->setCellValue('C' . $rowNumber, $row['jenis_tiket']);
        $sheet->setCellValue('D' . $rowNumber, $row['jumlah_tiket']);
        $sheet->setCellValue('E' . $rowNumber, 'Rp ' . number_format($row['total_pembayaran'], 0, ',', '.'));
        $sheet->setCellValue('F' . $rowNumber, $row['tanggal_pembelian']);
        $rowNumber++;
    }
}

// Judul file untuk Excel
$fileName = "Laporan_Pembelian_Tiket.xlsx";

// Kirim file Excel ke browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

// Buat writer Excel dan simpan ke output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Redirect kembali ke dashboard setelah download
header("Location: dashboard.php");
exit;
?>
