<?php
include __DIR__ . '/../koneksi.php';
session_start();

// Pembatasan akses: Hanya seller yang boleh masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'seller') {
    header('Location: ../auth/login.php');
    exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM users WHERE role='buyer'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buyer – PupukSmart</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4fff4; }
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

<?php include '../widgets/header_seller.php'; ?>

<div class="container-box">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="m-0">Daftar Buyer</h3>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-success">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($data) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= htmlspecialchars($row['telp']) ?></td>
                    <td>
                        <a href="hapus_buyer.php?id=<?= $row['id_user'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Hapus buyer ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Belum ada data buyer.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>