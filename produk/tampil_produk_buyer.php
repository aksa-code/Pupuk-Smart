<?php
include './koneksi.php';
$data = mysqli_query(
    $koneksi,
    "SELECT p.*, g.nama_gudang 
     FROM produk p 
     LEFT JOIN gudang g ON p.id_gudang = g.id_gudang"
);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk – PupukSmart</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f4fff4;
        }

        .produk-heading {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #2e7d32;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-weight: bold;
            color: #2e7d32;
            font-size: 1.2rem;
        }

        .card-text {
            color: #444;
            font-size: 0.95rem;
        }

        .btn-action {
            font-size: 0.85rem;
            padding: 6px 12px;
        }
    </style>
</head>

<body>
    <?php include '../widgets/header_buyer.php'; ?>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="produk-heading">Daftar Produk</h2>
        </div>

        <div class="row g-4">
            <?php while ($row = mysqli_fetch_assoc($data)): ?>
                <div class="col-md-3">
                    <div class="card h-100">
                        <?php if (!empty($row['foto_produk'])): ?>
                            <img src="../assets/foto_produk/<?= htmlspecialchars($row['foto_produk']) ?>"
                                class="card-img-top"
                                style="height:300px; object-fit:cover;">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/300x300?text=No+Image"
                                class="card-img-top"
                                style="height:300px; object-fit:cover;">
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($row['nama_produk']) ?></h5>
                            <p class="card-text mb-1">Stok: <?= htmlspecialchars($row['stok']) ?></p>
                            <p class="card-text mb-1">Harga: Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                            <p class="card-text mb-2"><small class="text-muted">Gudang: <?= htmlspecialchars($row['nama_gudang']) ?></small></p>

                            <div class="mt-auto d-flex justify-content-end">
                                <a href="../produk/beli_produk.php?id_produk=<?= $row['id_produk'] ?>"
                                    class="btn btn-sm btn-success btn-action">Beli</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>

</html>