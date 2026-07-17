<?php
include './koneksi.php';
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['role']) || !isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$role    = $_SESSION['role'];
$id_user = intval($_SESSION['id_user']);

if ($role === 'buyer') {
    // Transaksi milik buyer
    // REVISI: Mengubah tgl_transaksi menjadi tanggal_transaksi, dan id_buyer menjadi id_user
    $sql = "SELECT t.id_transaksi, t.tanggal_transaksi, u.nama AS nama_buyer
            FROM transaksi t
            JOIN users u ON t.id_user = u.id_user
            WHERE t.id_user = $id_user
            ORDER BY t.tanggal_transaksi DESC";
} else {
    // Transaksi seller: seluruh transaksi yang melibatkan produk milik seller ini
    // REVISI: Mengubah tgl_transaksi menjadi tanggal_transaksi, dan id_buyer menjadi id_user
    $sql = "SELECT DISTINCT t.id_transaksi, t.tanggal_transaksi, u.nama AS nama_buyer, p.nama_produk
            FROM transaksi t
            JOIN users u ON t.id_user = u.id_user
            JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN produk p ON d.id_produk = p.id_produk
            WHERE p.id_seller = $id_user
            ORDER BY t.tanggal_transaksi DESC";
}

$data = mysqli_query($koneksi, $sql) or die("Query error: " . mysqli_error($koneksi));
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
body { background:#f4fff4; }
.container-box {
    max-width: 1000px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
</style>
</head>
<body>

<?php 
include '../widgets/header_seller.php';
?>

<div class="container-box">
    <h3 class="mb-4 text-center">Data Transaksi</h3>

    <table class="table table-striped table-hover">
        <thead class="table-success">
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <?php if ($role === 'seller'): ?>
                    <th>Buyer</th>
                    <th>Produk</th>
                <?php endif; ?>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($data) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_transaksi']) ?></td>
                    <!-- Di sini sudah benar menggunakan tanggal_transaksi -->
                    <td><?= date('Y-m-d H:i', strtotime($row['tanggal_transaksi'])) ?></td>
                    
                    <?php if ($role === 'seller'): ?>
                        <td><?= htmlspecialchars($row['nama_buyer']) ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                    <?php endif; ?>

                    <td>
                        <a href="detail_transaksi.php?id=<?= $row['id_transaksi'] ?>" 
                           class="btn btn-sm btn-primary">Detail</a>
                        <?php if ($role === 'seller'): ?>
                            <a href="hapus_transaksi.php?id=<?= $row['id_transaksi'] ?>" 
                               class="btn btn-sm btn-danger ms-2"
                               onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?= ($role === 'seller') ? 5 : 3 ?>" class="text-center text-muted">
                    Belum ada transaksi.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>