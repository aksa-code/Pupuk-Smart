<?php
include './koneksi.php';
$id_produk = (int)$_GET['id'];
mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE id_produk=$id_produk");
mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk=$id_produk");
header("Location:../produk/tampil_produk_seller.php");
