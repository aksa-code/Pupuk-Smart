<?php
include './koneksi.php';
session_start();
$id_buyer = $_SESSION['id_user'];
$cart = $_SESSION['cart']; // array id_produk, qty, harga
mysqli_begin_transaction($koneksi);

$total = 0;
foreach($cart as $c){ $total += $c['qty'] * $c['harga']; }

mysqli_query($koneksi,"INSERT INTO transaksi(id_buyer,total_harga)
                       VALUES($id_buyer,$total)");
$id_transaksi = mysqli_insert_id($koneksi);

foreach($cart as $c){
    $sub = $c['qty'] * $c['harga'];
    mysqli_query($koneksi,"INSERT INTO detail_transaksi
       (id_transaksi,id_produk,qty,harga_satuan,subtotal)
       VALUES($id_transaksi,{$c['id_produk']},{$c['qty']},{$c['harga']},$sub)");
    mysqli_query($koneksi,"UPDATE produk
                           SET stok = stok - {$c['qty']}
                           WHERE id_produk = {$c['id_produk']}");
}
mysqli_commit($koneksi);
unset($_SESSION['cart']);
echo "Transaksi sukses, ID: $id_transaksi";
