<?php
$koneksi = mysqli_connect("localhost","root","","pupuk");
if(!$koneksi){
    die("Koneksi gagal: ".mysqli_connect_error());
}
?>
