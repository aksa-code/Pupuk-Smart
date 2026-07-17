<?php
include './koneksi.php';
session_start();

$id = (int)$_GET['id'];
$role = $_SESSION['role'] ?? '';

// ambil detail item transaksi
$sql = "SELECT d.*, p.nama_produk, p.harga
        FROM detail_transaksi d
        JOIN produk p ON d.id_produk=p.id_produk
        WHERE d.id_transaksi=$id";
$data = mysqli_query($koneksi,$sql);

// ambil info transaksi
$trans = mysqli_fetch_assoc(
    mysqli_query($koneksi,"SELECT * FROM transaksi WHERE id_transaksi=$id")
);

// tentukan link kembali sesuai role
if ($role === 'buyer') {
    $backLink = "tampil_transaksi_buyer.php";
} else {
    $backLink = "tampil_transaksi_seller.php";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Transaksi #<?= htmlspecialchars($id) ?> – PupukSmart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
body{ background:#f4fff4; }
.container-box{
    max-width:900px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
</style>
</head>
<body>

<div class="container-box">
    <h3 class="mb-3">Detail Transaksi #<?= htmlspecialchars($id) ?></h3>
    <p><strong>Tanggal:</strong> <?= date('Y-m-d', strtotime($trans['tanggal_transaksi'])) ?></p>

    <table class="table table-striped table-hover mt-3">
        <thead class="table-success">
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        mysqli_data_seek($data,0);
        while($row = mysqli_fetch_assoc($data)):
            $total += $row['subtotal'];
        ?>
            <tr>
                <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
                <td><?= htmlspecialchars($row['jumlah']) ?></td>
                <td>Rp <?= number_format($row['subtotal'],0,',','.') ?></td>
            </tr>
        <?php endwhile; ?>
            <tr class="table-light">
                <td colspan="3" class="text-end"><strong>Total</strong></td>
                <td><strong>Rp <?= number_format($total,0,',','.') ?></strong></td>
            </tr>
        </tbody>
    </table>

    <!-- tombol kembali dinamis -->
    <a href="<?= $backLink ?>" class="btn btn-secondary mt-2">Kembali</a>
</div>

</body>
</html>
