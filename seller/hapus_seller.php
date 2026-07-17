<?php
include 'koneksi.php';
$id = (int)$_GET['id'];
mysqli_query($koneksi,"DELETE FROM users WHERE id_user=$id AND role='seller'");
header("Location: tampil_seller.php");
