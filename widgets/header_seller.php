<?php
// --- Pastikan session sudah aktif ---
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil nama file yang sedang dibuka untuk highlight menu aktif
$currentPage = basename($_SERVER['PHP_SELF']);

// Ambil data session
$nama = $_SESSION['nama'] ?? 'Pengunjung';
?>

<!-- ===== NAVBAR / HEADER ===== -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <!-- Logo / Brand: Diarahkan ke home_seller.php -->
    <a class="navbar-brand fw-bold text-success" href="../seller/home_seller.php">PupukSmart</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <!-- Link Beranda -->
        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'home_seller.php' ? 'active' : '' ?>" 
             href="../seller/home_seller.php">Beranda</a>
        </li>
        
        <!-- Link Product -->
        <li class="nav-item">
          <a class="nav-link <?= strpos($currentPage, 'produk') !== false ? 'active' : '' ?>" 
             href="../produk/tampil_produk_seller.php">Product</a>
        </li>

        <!-- Link Buyer -->
        <li class="nav-item">
          <a class="nav-link <?= strpos($currentPage, 'buyer') !== false ? 'active' : '' ?>" 
             href="../buyer/tampil_buyer.php">Buyer</a>
        </li>

        <!-- Link Transaksi -->
        <li class="nav-item">
          <a class="nav-link <?= strpos($currentPage, 'transaksi') !== false ? 'active' : '' ?>" 
             href="../transaksi/tampil_transaksi_seller.php">Transaksi</a>
        </li>
      </ul>
    </div>

    <div class="d-flex">
      <span class="navbar-text me-3">
        Halo, <?= htmlspecialchars($nama) ?>
      </span>
      <a href="../auth/logout.php" class="btn btn-outline-success btn-sm">Logout</a>
    </div>
  </div>
</nav>