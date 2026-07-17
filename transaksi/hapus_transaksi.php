<?php
include './koneksi.php';
session_start();

// pastikan hanya seller yang bisa hapus
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'seller') {
    header("Location: ../auth/login.php");
    exit;
}

$id = (int)$_GET['id'];

// hapus dulu detail transaksi (foreign key)
mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE id_transaksi=$id");

// baru hapus transaksi utama
mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi=$id");

// kembali ke halaman list
header("Location: tampil_transaksi_seller.php");
exit;
