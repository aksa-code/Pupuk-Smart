<?php
include './koneksi.php';

// Ambil kode terakhir
$q = mysqli_query($koneksi, "SELECT kode_produk FROM produk ORDER BY CAST(SUBSTRING(kode_produk, 4) AS UNSIGNED) DESC LIMIT 1");
$d = mysqli_fetch_assoc($q);

if ($d) {
    $lastKode = (int) substr($d['kode_produk'], 3);
    $nextKode = 'PRD' . str_pad($lastKode + 1, 4, '0', STR_PAD_LEFT);
} else {
    $nextKode = 'PRD0001';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header bg-success text-white">
        Tambah Produk
      </div>
      <div class="card-body">
        <form method="post" action="proses_produk.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label>Kode Produk</label>
            <input type="text" name="kode" class="form-control"
              value="<?= $nextKode ?>" readonly>
          </div>
          <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Foto Produk</label>
            <input type="file" name="foto" class="form-control">
          </div>
          <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
          <a href="tampil_produk_seller.php" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>
</body>

</html>