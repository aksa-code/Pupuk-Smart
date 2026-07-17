<?php
include __DIR__ . '/../koneksi.php';
session_start();

// --- Validasi ID
if(!isset($_GET['id']) || !ctype_digit($_GET['id'])){
    header("Location: tampil_gudang.php");
    exit;
}

$id = (int)$_GET['id'];

// --- Hapus data dengan prepared statement
$stmt = mysqli_prepare($koneksi, "DELETE FROM gudang WHERE id_gudang = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// --- Kembali ke daftar
header("Location: tampil_gudang.php");
exit;
