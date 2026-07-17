<?php
include 'koneksi.php';
if(isset($_POST['update'])){
    $id     = (int)$_POST['id'];
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email  = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp   = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $sql = "UPDATE users SET 
                nama='$nama', email='$email', alamat='$alamat', telp='$telp'
            WHERE id_user=$id AND role='seller'";
    mysqli_query($koneksi,$sql);

    if(!empty($_POST['password'])){
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($koneksi,
          "UPDATE users SET password='$pass' WHERE id_user=$id AND role='seller'");
    }
    header("Location: home_seller.php");
}
