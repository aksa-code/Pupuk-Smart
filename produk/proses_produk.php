<?php
include 'koneksi.php';
session_start();

if(isset($_POST['simpan'])){
    $kode  = mysqli_real_escape_string($koneksi,$_POST['kode']);
    $nama  = mysqli_real_escape_string($koneksi,$_POST['nama']);
    $satuan= mysqli_real_escape_string($koneksi,$_POST['satuan']);
    $harga = (int)$_POST['harga'];
    $stok  = (int)$_POST['stok'];
    
    // ambil dari session, bukan post
    $id_seller = $_SESSION['id_user'];  

    $foto = '';
    if(!empty($_FILES['foto']['name'])){
        $ext  = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto = uniqid('prod_').'.'.$ext;
        move_uploaded_file($_FILES['foto']['tmp_name'],
            "../assets/foto_produk/".$foto);
    }

    $sql = "INSERT INTO produk(kode_produk,nama_produk,satuan,harga,stok,id_seller,foto_produk)
            VALUES ('$kode','$nama','$satuan', $harga, $stok, $id_seller, '$foto')";
    mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
    header("Location: tampil_produk_seller.php");
}
