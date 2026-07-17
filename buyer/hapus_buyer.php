<?php
include './koneksi.php'; 
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'seller'){
    header("Location: ../auth/login.php");
    exit;
}

$id = (int)$_GET['id'];

// 1. Hapus dulu detail transaksinya (jika ada relasi ke detail)
mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE id_user=$id)");

// 2. Hapus data transaksinya
mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_user=$id");

// 3. Baru hapus usernya
mysqli_query($koneksi, "DELETE FROM users WHERE id_user=$id AND role='buyer'");

header("Location: tampil_buyer.php");
exit;