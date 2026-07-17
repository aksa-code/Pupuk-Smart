<?php
// Pastikan path koneksi sudah benar (keluar satu folder ke root)
include './koneksi.php';
session_start();

// 1. Perbaikan Role: pastikan role sesuai dengan yang tersimpan di session ('buyer')
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'buyer') {
    header("Location: ../auth/login.php");
    exit;
}

// Validasi input post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../produk/tampil_produk_buyer.php");
    exit;
}

$id_user    = $_SESSION['id_user'];
$id_produk  = intval($_POST['id_produk']);
$jumlah     = intval($_POST['jumlah_beli']);
$tgl        = date("Y-m-d H:i:s");

// Ambil data produk
$q = mysqli_query($koneksi, "SELECT harga, stok FROM produk WHERE id_produk=$id_produk");
$produk = mysqli_fetch_assoc($q);

if (!$produk || $jumlah > $produk['stok']) {
    die("Stok tidak mencukupi atau produk tidak ditemukan.");
}

$harga_satuan = $produk['harga'];
$subtotal     = $harga_satuan * $jumlah;

// 2. Insert ke transaksi (Gunakan 'tanggal_transaksi' sesuai database Anda)
$query_transaksi = "INSERT INTO transaksi (id_user, tanggal_transaksi, total_bayar, status)
                    VALUES ($id_user, '$tgl', $subtotal, 'pending')";
mysqli_query($koneksi, $query_transaksi) or die("Error Transaksi: " . mysqli_error($koneksi));

$id_transaksi = mysqli_insert_id($koneksi);

// 3. Insert ke detail_transaksi
// Menggunakan 'jumlah' sesuai dengan screenshot tabel Anda
$query_detail = "INSERT INTO detail_transaksi (id_transaksi, id_produk, jumlah, harga_satuan, subtotal)
                 VALUES ($id_transaksi, $id_produk, $jumlah, $harga_satuan, $subtotal)";
mysqli_query($koneksi, $query_detail) or die("Error Detail: " . mysqli_error($koneksi));

// 4. Update stok produk
mysqli_query($koneksi, "UPDATE produk SET stok = stok - $jumlah WHERE id_produk=$id_produk");

// Redirect ke transaksi buyer
header("Location: ../transaksi/tampil_transaksi_buyer.php");
exit;
?>