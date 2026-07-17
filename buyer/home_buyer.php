<?php
session_start();
// pastikan user buyer
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'buyer') {
  header('Location: ../auth/login.php');
  exit;
}
include '../widgets/header_buyer.php'; 
?>
<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home Buyer - PupukSmart</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome untuk ikon daun -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
/* ----- Custom hero style ----- */
.hero-section{
    background-color:#ecfdf5;       /* hijau muda lembut */
    min-height:90vh;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
}

.hero-content h1{
    font-weight:700;
    font-size:2.5rem;
}

.hero-content p{
    font-size:1.1rem;
    max-width:650px;
    margin:20px auto;
    color:#4b5563;
}

/* ✅ Atur ikon daun */
.hero-content .fa-seedling{
    font-size:5rem;        /* ➜ ikon lebih besar */
    color:#23B958;         /* hijau */
    margin-bottom:35px;    /* ➜ jarak bawah lebih lebar */
}
</style>
</head>

<body>

<!-- ===== Hero Section ===== -->
<section class="hero-section">
  <div class="container">
    <div class="hero-content">
      <i class="fa-solid fa-seedling"></i>

      <h1>“Solusi Cerdas untuk Pertanian Masa Depan”</h1>
      <p>PupukSmart menyediakan berbagai jenis pupuk berkualitas
         untuk mendukung pertanian yang lebih produktif, efisien,
         dan berkelanjutan.</p>

      <a href="../produk/tampil_produk_buyer.php"
         class="btn btn-success btn-lg rounded-pill px-4">
         Lihat Product
      </a>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
