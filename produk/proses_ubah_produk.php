<?php
include './koneksi.php';
if(isset($_POST['update'])){
    $id    = (int)$_POST['id'];
    $kode  = mysqli_real_escape_string($koneksi,$_POST['kode']);
    $nama  = mysqli_real_escape_string($koneksi,$_POST['nama']);
    $satuan= mysqli_real_escape_string($koneksi,$_POST['satuan']);
    $harga = (int)$_POST['harga'];
    $stok  = (int)$_POST['stok'];
    // $id_gudang = (int)$_POST['id_gudang'];
    $id_seller = (int)$_POST['id_seller'];

    $foto_update = '';
    if(!empty($_FILES['foto']['name'])){
        $ext  = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_update = uniqid('prod_').'.'.$ext;
        move_uploaded_file($_FILES['foto']['tmp_name'],
            "../assets/foto_produk/".$foto_update);
        $foto_sql = ", foto_produk='$foto_update'";
    } else {
        $foto_sql = "";
    }

    $sql = "UPDATE produk SET
              kode_produk='$kode', nama_produk='$nama', satuan='$satuan',
              harga=$harga, stok=$stok, id_seller=$id_seller
              $foto_sql
            WHERE id_produk=$id";
    mysqli_query($koneksi,$sql);
    header("Location: tampil_produk_seller.php");
}
