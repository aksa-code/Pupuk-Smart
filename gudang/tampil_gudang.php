<!-- <?php
include __DIR__ . '/../koneksi.php';
$data = mysqli_query($koneksi,"SELECT * FROM gudang");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Gudang – PupukSmart</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
    background:#f4fff4;
}
.container-box{
    max-width:1000px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
</style>
<?php include '../widgets/header.php'; ?>
<body>

<div class="container-box">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="m-0">Daftar Gudang</h3>
        <a href="tambah_gudang.php" class="btn btn-success">+ Tambah Gudang</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-success">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Golongan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= htmlspecialchars($row['kode_gudang']) ?></td>
                <td><?= htmlspecialchars($row['nama_gudang']) ?></td>
                <td><?= htmlspecialchars($row['golongan']) ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td>
                    <a href="ubah_gudang.php?id=<?= $row['id_gudang'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="hapus_gudang.php?id=<?= $row['id_gudang'] ?>"
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html> -->
