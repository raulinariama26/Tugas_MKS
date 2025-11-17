<?php
session_start();

if (!isset($_POST['pdf_file'], $_POST['pendamping_name'], $_POST['code_input'])) {
    die("Akses tidak valid.");
}

$pdfFile  = $_POST['pdf_file'];
$pendamping = $_POST['pendamping_name'];
$inputCode = $_POST['code_input'];

if (!isset($_SESSION['codes'][$pdfFile][$pendamping])) {
    die("Data verifikasi tidak ditemukan.");
}

$correctCode = $_SESSION['codes'][$pdfFile][$pendamping];

if ($inputCode !== $correctCode) {
    die("Kode verifikasi salah.");
}

// Lokasi file
$filePath = "pdf_files/" . $pdfFile;

if (!file_exists($filePath)) {
    die("File tidak ditemukan.");
}

// Kirim file ke browser
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
readfile($filePath);
exit;