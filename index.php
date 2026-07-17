<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PupukSmart</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PupukSmart</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* style tambahan agar mirip mockup */
        body { background-color:#f4fff4; }
        .navbar-brand { font-weight:bold; }
        .hero { background:#e8f9e8; padding:80px 0; text-align:center; }
        .hero h1 { font-weight:600; }
        .product-card img { height:180px; object-fit:cover; }
        .section-title { font-size:1.5rem; font-weight:600; margin-top:2rem; }
    </style>
    <!-- ⬆⬆ Selesai -->
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">PupukSmart</a>
    <div class="ms-auto">
      <a href="product.php" class="btn btn-success">+ Add Product</a>
    </div>
  </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Solusi Cerdas untuk Pertanian Masa Depan</h1>
        <p class="lead">
          PupukSmart menyediakan berbagai jenis pupuk berkualitas untuk mendukung
          pertanian yang lebih produktif, efisien, dan berkelanjutan.
        </p>
        <a href="tampil_produk_buyer.php" class="btn btn-success btn-lg mt-3">Lihat Product</a>
    </div>
</section>

</body>
</html>
