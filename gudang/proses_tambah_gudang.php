<?php
include __DIR__ . '/../koneksi.php';
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$gol = $_POST['golongan'];
$ket = $_POST['ket'];
mysqli_query($koneksi,"INSERT INTO gudang(kode_gudang,nama_gudang,golongan,keterangan)
                      VALUES('$kode','$nama','$gol','$ket')");
header("Location: tampil_gudang.php");
