<?php include './koneksi.php';
$data = mysqli_query($koneksi, "SELECT p.*, g.nama_gudang FROM produk p LEFT JOIN gudang g ON p.id_gudang = g.id_gudang"); ?>
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
            background: #f4fff4;
        }

        .container-box {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .img-produk {
            width: 70px;   /* ukuran fix */
            height: 70px;
            object-fit: cover;  /* biar ga gepeng */
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <?php include '../widgets/header_seller.php'; ?>

    <div class="container-box">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="m-0">Daftar Produk</h3>
            <a href="tambah_produk.php" class="btn btn-success">+ Tambah Produk</a>
        </div>
        <table class="table table-striped table-hover">
            <thead class="table-success">
                <tr>
                    <th>Kode</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gudang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['kode_produk']) ?></td>
                        <td>
                            <?php if (!empty($row['foto_produk'])): ?>
                                <img src="../assets/foto_produk/<?= htmlspecialchars($row['foto_produk']) ?>"
                                     class="img-produk">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/70x70?text=No+Image"
                                     class="img-produk">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td><?= htmlspecialchars($row['satuan']) ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['stok']) ?></td>
                        <td><?= htmlspecialchars($row['nama_gudang']) ?></td>
                        <td>
                            <a href="ubah_produk.php?id=<?= $row['id_produk'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="hapus_produk.php?id=<?= $row['id_produk'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Hapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
