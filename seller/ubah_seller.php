<?php
include 'koneksi.php';
$id = (int)$_GET['id'];
$q = mysqli_query($koneksi,"SELECT * FROM users WHERE id_user=$id AND role='seller'");
$seller = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Seller – PupukSmart</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
    background:#f4fff4;
}
.form-box{
    max-width:500px;
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
    <h3 class="text-center mb-4">Edit Seller</h3>

    <form method="post" action="proses_ubah_seller.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($seller['id_user']) ?>">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control"
                   value="<?= htmlspecialchars($seller['nama']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($seller['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2"><?= htmlspecialchars($seller['alamat']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telp" class="form-control"
                   value="<?= htmlspecialchars($seller['telp']) ?>">
        </div>

        <p class="small text-muted">(Kosongkan password jika tidak diganti)</p>

        <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" name="update" class="btn btn-success w-100">Update</button>
    </form>
</div>

</body>
</html>
