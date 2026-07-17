<?php
// --- Pastikan session sudah aktif ---
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil nama file yang sedang dibuka
$currentPage = basename($_SERVER['PHP_SELF']);

// Ambil data session jika ada
$nama = $_SESSION['nama'] ?? 'Pengunjung';
$role = $_SESSION['role'] ?? '';   // '' jika belum login
?>
<!-- ===== NAVBAR / HEADER ===== -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <!-- Logo / Brand -->
    <!-- Versi Dinamis (Lebih Aman) -->
<a class="navbar-brand fw-bold text-success" href="<?= ($role == 'seller') ? '../seller/home_seller.php' : '../buyer/home_buyer.php' ?>">
    PupukSmart
</a>

    <!-- Button toggle mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">

        <!-- Link Beranda (khusus buyer) -->
        <li class="nav-item">
          <a class="nav-link <?= $currentPage=='../buyer/home_buyer.php' ? 'active' : '' ?>"
             href="../buyer/home_buyer.php">
             Beranda
          </a>
        </li>
        
        <!-- Link Product -->
        <li class="nav-item">
          <a class="nav-link <?= strpos($currentPage,'produk')!==false ? 'active' : '' ?>"
             href="../produk/tampil_produk_buyer.php">Product</a>
        </li>

        <!-- Link Transaksi hanya untuk Buyer -->
        <li class="nav-item">
          <a class="nav-link <?= $currentPage=='../transaksi/tampil_transaksi_buyer.php' ? 'active' : '' ?>"
             href="../transaksi/tampil_transaksi_buyer.php">Transaksi Saya</a>
        </li>
      </ul>
    </div>

    <!-- Kanan: Nama user + Logout -->
    <div class="d-flex">
      <span class="navbar-text me-3">
        Halo, <?= htmlspecialchars($nama) ?>
      </span>

      <?php if ($role): ?>
        <a href="../auth/logout.php" class="btn btn-outline-success btn-sm">Logout</a>
      <?php else: ?>
        <a href="../auth/login.php" class="btn btn-success btn-sm">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
