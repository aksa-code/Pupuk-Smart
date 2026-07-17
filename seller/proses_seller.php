<?php
include 'koneksi.php';
if(isset($_POST['simpan'])){
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email  = mysqli_real_escape_string($koneksi, $_POST['email']);
    $pass   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp   = mysqli_real_escape_string($koneksi, $_POST['telp']);

    mysqli_query($koneksi,"INSERT INTO users(nama,email,password,role,alamat,telp)
                           VALUES('$nama','$email','$pass','seller','$alamat','$telp')");
    header("Location: tampil_seller.php");
}
