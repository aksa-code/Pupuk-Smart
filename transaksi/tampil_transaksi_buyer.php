<?php
include './koneksi.php';
session_start();

$role = $_SESSION['role'];
$id_user = intval($_SESSION['id_user']);

if ($role == 'buyer') {
    // REVISI: Ganti id_buyer jadi id_user, dan tgl_transaksi jadi tanggal_transaksi
    $sql = "SELECT * FROM transaksi 
            WHERE id_user=$id_user 
            ORDER BY tanggal_transaksi DESC";
} else {
    // REVISI: Ganti tgl_transaksi jadi tanggal_transaksi
    $sql = "SELECT DISTINCT t.* 
            FROM transaksi t
            JOIN detail_transaksi d ON t.id_transaksi=d.id_transaksi
            JOIN produk p ON d.id_produk=p.id_produk
            WHERE p.id_seller=$id_user
            ORDER BY t.tanggal_transaksi DESC";
}
$data = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Transaksi – PupukSmart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
body {
    background:#f4fff4;
}
.container-box {
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

<?php include '../widgets/header_buyer.php'; ?>

<div class="container-box">
    <h3 class="mb-4 text-center">Data Transaksi</h3>

    <table class="table table-striped table-hover">
        <thead class="table-success">
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($data) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_transaksi']) ?></td>
                    <td><?= date('Y-m-d', strtotime($row['tanggal_transaksi'])) ?></td>

                    <td>
                        <a href="detail_transaksi.php?id=<?= $row['id_transaksi'] ?>"
                           class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center text-muted">Belum ada transaksi.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
