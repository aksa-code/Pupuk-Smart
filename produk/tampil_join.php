<?php
include './koneksi.php';
$sql = "SELECT p.id_produk, p.kode_produk, p.nama_produk, g.nama_gudang, g.golongan,
               p.satuan, p.harga, p.foto_produk
        FROM produk p
        JOIN gudang g ON p.id_gudang = g.id_gudang";
$data = mysqli_query($koneksi,$sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>List Produk + Gudang – PupukSmart</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
    background:#f4fff4;
}
.container-box{
    max-width:1100px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
.product-img{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:5px;
}
</style>
</head>
<body>

<div class="container-box">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="m-0">List Produk + Gudang (Join Table)</h3>
        <a href="tambah_produk.php" class="btn btn-success">+ Tambah Produk</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-success">
            <tr>
                <th>Action</th>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Gudang</th>
                <th>Golongan</th>
                <th>Satuan</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td>
                    <a href="ubah_produk.php?id=<?= $row['id_produk'] ?>"
                       class="btn btn-sm btn-primary">Edit</a>
                </td>
                <td>
                    <img src="../assets/foto_produk/<?= htmlspecialchars($row['foto_produk']) ?>"
                         class="product-img" alt="">
                </td>
                <td><?= htmlspecialchars($row['kode_produk']) ?></td>
                <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td><?= htmlspecialchars($row['nama_gudang']) ?></td>
                <td><?= htmlspecialchars($row['golongan']) ?></td>
                <td><?= htmlspecialchars($row['satuan']) ?></td>
                <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
