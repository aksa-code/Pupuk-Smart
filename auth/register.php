<?php
include __DIR__ . '/../koneksi.php';
session_start();

if (isset($_POST['register'])) {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email  = mysqli_real_escape_string($koneksi, $_POST['email']);
    $pass   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role   = $_POST['role']; // seller / buyer
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp   = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $cek = mysqli_query($koneksi, "SELECT id_user FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Email sudah terdaftar, silakan gunakan email lain.";
    } else {
        $sql = "INSERT INTO users (nama,email,password,role,alamat,telp)
                VALUES ('$nama','$email','$pass','$role','$alamat','$telp')";
        if (mysqli_query($koneksi, $sql)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Gagal mendaftar: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register – PupukSmart</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
    background:#f4fff4;
}
.register-box{
    max-width:450px;
    margin:70px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
</style>
</head>
<body>

<div class="register-box">
    <h3 class="text-center mb-4">Daftar PupukSmart</h3>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text" name="telp" class="form-control">
        </div>

        <button type="submit" name="register" class="btn btn-success w-100">Daftar</button>
    </form>

    <p class="mt-3 text-center">
        Sudah punya akun? <a href="login.php">Login di sini</a>
    </p>
</div>

</body>
</html>
