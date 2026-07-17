<?php
include './koneksi.php';
$id = (int)$_GET['id'];
$produk = mysqli_fetch_assoc(
    mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk=$id")
);
$gudang = mysqli_query($koneksi,"SELECT * FROM gudang");
$seller = mysqli_query($koneksi,"SELECT * FROM users WHERE role='seller'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Produk – PupukSmart</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
    background:#f4fff4;
}
.form-box{
    max-width:550px;
    margin:70px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
</style>
</head>
<body>

<div class="form-box">
    <h3 class="text-center mb-4">Edit Produk</h3>

    <form method="post" action="proses_ubah_produk.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($produk['id_produk']) ?>">

        <div class="mb-3">
            <label class="form-label">Kode Produk</label>
            <input type="text" name="kode" class="form-control"
                   value="<?= htmlspecialchars($produk['kode_produk']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" class="form-control"
                   value="<?= htmlspecialchars($produk['nama_produk']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control"
                   value="<?= htmlspecialchars($produk['satuan']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"
                   value="<?= htmlspecialchars($produk['harga']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control"
                   value="<?= htmlspecialchars($produk['stok']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Seller</label>
            <select name="id_seller" class="form-select" required>
                <?php while($s = mysqli_fetch_assoc($seller)): ?>
                    <option value="<?= $s['id_user'] ?>"
                        <?= $s['id_user']==$produk['id_seller']?'selected':'' ?>>
                        <?= htmlspecialchars($s['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Kalau mau aktifkan lagi pilih gudang -->
        <!--
        <div class="mb-3">
            <label class="form-label">Gudang</label>
            <select name="id_gudang" class="form-select" required>
                <?php while($g = mysqli_fetch_assoc($gudang)): ?>
                    <option value="<?= $g['id_gudang'] ?>"
                        <?= $g['id_gudang']==$produk['id_gudang']?'selected':'' ?>>
                        <?= htmlspecialchars($g['nama_gudang']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        -->

        <div class="mb-3">
            <label class="form-label">Ganti Foto (jika perlu)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" name="update" class="btn btn-success w-100">Update</button>
    </form>
</div>

</body>
</html>
