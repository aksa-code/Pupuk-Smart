<?php
session_start();
include 'koneksi.php';

// Cek apakah sudah login & role seller
if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 'seller'){
    header("Location: ../auth/login.php");
    exit;
}

// Ambil data dari session
$id_user = $_SESSION['id_user'];
$nama    = $_SESSION['nama'];

// Kalau mau ambil ulang nama dari database:
$q = mysqli_query($koneksi, "SELECT nama FROM users WHERE id_user = $id_user AND role='seller'");
$d = mysqli_fetch_assoc($q);
if ($d) {
    $nama = $d['nama'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Seller – PupukSmart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
body {
    background:#f4fff4;
}
.container-box {
    max-width:1000px; 
    margin:40px auto; 
    background:#fff;
    padding:30px; 
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PupukSmart Seller</a>
    <div class="d-flex">
      <span class="navbar-text text-white me-3">
        Halo, <?= htmlspecialchars($nama) ?>
      </span>
      <a class="btn btn-outline-light btn-sm" href="../auth/logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container-box">
    <!-- Sapaan untuk seller -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4>Selamat datang, <span class="text-success"><?= htmlspecialchars($nama) ?></span> 👋</h4>
            <p class="mb-0 text-muted">Senang melihat Anda kembali di dashboard seller PupukSmart.</p>
        </div>
        <div>
            <a href="../seller/ubah_seller.php?id=<?= $id_user ?>" class="btn btn-warning btn-sm">
                ✏️ Edit Profil
            </a>
        </div>
    </div>

    <h5 class="mb-3">Menu Seller</h5>
    <div class="list-group">
      <a href="../buyer/tampil_buyer.php" class="list-group-item list-group-item-action">
        Lihat Data Buyer
      </a>
      <a href="../produk/tampil_produk_seller.php" class="list-group-item list-group-item-action">
        Kelola Produk
      </a>
      <a href="../transaksi/tampil_transaksi_seller.php" class="list-group-item list-group-item-action">
        Lihat Transaksi
      </a>
    </div>
</div>

</body>
</html>
