<?php
session_start();
include './koneksi.php';
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'buyer') {
    header("Location: ../auth/login.php");
    exit;
}

include "../koneksi.php";
include "../widgets/header_buyer.php";

$id = isset($_GET['id_produk']) ? (int)$_GET['id_produk'] : 0;

// Cek apakah id valid
if ($id <= 0) {
    echo "<div class='container py-5'><div class='alert alert-danger'>Produk tidak ditemukan.</div></div>";
    exit;
}

$qry_detail_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk=$id");
$dt_produk = mysqli_fetch_assoc($qry_detail_produk);

// Jika query gagal
if (!$qry_detail_produk) {
    die("Query error: " . mysqli_error($koneksi));
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Beli Produk – PupukSmart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f4fff4;}
.judul-beli{
    color:#198754;
    font-size:36px;
    font-weight:bold;
    margin:20px 0;
}
.card{
    border:none;
    border-radius:10px;
    box-shadow:0 0 8px rgba(0,0,0,0.1);
}
.table td{
    vertical-align:middle;
}
input[type="number"], input[readonly]{
    max-width:180px;
}
</style>
</head>
<body>

<div class="container py-5">
  <h2 class="judul-beli">Beli Produk</h2>
  <div class="row">
    <!-- Foto produk -->
    <div class="col-md-4 mb-3">
      <div class="card">
        <?php if (!empty($dt_produk['foto_produk'])): ?>
          <img src="../assets/foto_produk/<?= htmlspecialchars($dt_produk['foto_produk']) ?>" 
               class="card-img-top" alt="Foto produk">
        <?php else: ?>
          <img src="https://via.placeholder.com/400x400?text=No+Image" 
               class="card-img-top" alt="No Image">
        <?php endif; ?>
      </div>
    </div>

    <!-- Detail produk -->
    <div class="col-md-8">
      <div class="card p-4">
        <form action="../produk/proses_beli_produk.php" method="post">
          <!-- penting: kirim id produk -->
          <input type="hidden" name="id_produk" value="<?= $dt_produk['id_produk'] ?>">
          <table class="table table-borderless">
            <tr>
              <td><strong>Nama Produk</strong></td>
              <td><?= htmlspecialchars($dt_produk['nama_produk']) ?></td>
            </tr>
            <tr>
              <td><strong>Deskripsi</strong></td>
              <td><?= !empty($dt_produk['deskripsi']) ? nl2br(htmlspecialchars($dt_produk['deskripsi'])) : '-' ?></td>
            </tr>
            <tr>
              <td><strong>Harga</strong></td>
              <td>Rp <?= number_format($dt_produk['harga'],0,',','.') ?></td>
            </tr>
            <tr>
              <td><strong>Jumlah Beli</strong></td>
              <td>
                <input type="number" id="jumlah_beli" name="jumlah_beli" 
                       value="1" min="1" max="<?= (int)$dt_produk['stok'] ?>" 
                       class="form-control" oninput="hitungTotal()">
                <small class="text-muted">Stok tersedia: <?= (int)$dt_produk['stok'] ?></small>
              </td>
            </tr>
            <tr>
              <td><strong>Total</strong></td>
              <td>
                <input type="text" id="total_harga" class="form-control" readonly>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <button type="submit" class="btn btn-success">Beli</button>
                <!-- arahkan balik ke home buyer -->
                <a href="../produk/tampil_produk_buyer.php" class="btn btn-secondary">Kembali</a>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function hitungTotal(){
  var harga = <?= (int)$dt_produk['harga'] ?>;
  var jumlah = parseInt(document.getElementById('jumlah_beli').value) || 1;
  var total = harga * jumlah;
  document.getElementById('total_harga').value = "Rp " + total.toLocaleString('id-ID');
}
// jalankan pertama kali
hitungTotal();
</script>

</body>
</html>
