<?php  

include "koneksi.php";
session_start();
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$nama=$_SESSION['nama'];

$idbarang=mysqli_real_escape_string($koneksi, $_POST['idbar']);
$_SESSION['idbar']=$idbarang;
$idsukucadang=mysqli_real_escape_string($koneksi, $_POST['id']);
$query = mysqli_query($koneksi,"select * from suku_cadang where id_suku_cadang=$idsukucadang"); 
$data = mysqli_fetch_array($query);
$waktu=mysqli_real_escape_string($koneksi, $_POST['waktu']);
// $keterangan=$data['keterangan'];
$harga=$data['harga'];
$keuntungan=$data['untung'];
$untung=$keuntungan*0.8;
$upah=$keuntungan*0.2;

// echo $idbarang;
// echo "<br>";
// echo $_SESSION['idbar'];
// echo "<br>";
// echo $idsukucadang;
// echo "<br>";
// // echo $keterangan;
// // echo "<br>";
// echo $harga;
// echo "<br>";
// echo $keuntungan;
// echo "<br>";
// echo $untung;
// echo "<br>";
// echo $upah;
// echo "<br>";
// echo $waktu;
// echo "<br>";



$queryTambahBarang = mysqli_query($koneksi,"update barang set total_biaya=total_biaya-$harga, total_untung=total_untung-$untung, total_upah=total_upah-$upah where id_barang=$idbarang");
$queryTambahJasa = mysqli_query($koneksi,"delete from trans_sukucadang where id_suku_cadang=$idsukucadang and id_barang=$idbarang and waktu='$waktu'");
// // $queryLog = mysqli_query($koneksi,"insert into log_aktivitas values ('[ $nama ] [ $level ] menambah Jasa Transaksi[$idbarang]['keterangan']','Transaksi', now())");

	header("Location: ../$level/tambahjasa.php?msg=HapusSKSukses");


?>