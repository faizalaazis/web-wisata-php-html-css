<?php
//memeriksa apakah user sudah login, cek kehadiran session name
//jika tidak ada, redirect ke login.php

session_start();
if (!isset($_SESSION["nama"])) {
	header("Location: login.php");
}

// buka koneksi dengan MySQL
include("connection.php");

// ambil pesan jika ada  
if (isset($_GET["pesan"])) {
$pesan = $_GET["pesan"];
}

// cek apakah form telah di submit
// berasal dari form pencairan, siapkan query 
if (isset($_GET["submit"])) {

// ambil nilai nama
$nama = htmlentities(strip_tags(trim($_GET["nama"])));

// filter untuk $nama untuk mencegah sql injection
$nama = mysqli_real_escape_string($link,$nama);

// buat query pencarian
$query  = "SELECT * FROM pengunjung WHERE nama LIKE '%$nama%' ";
$query .= "ORDER BY nama ASC";

// buat pesan
$pesan = "Hasil pencarian untuk nama <b>\"$nama\" </b>:";
} 
else {
// bukan dari form pencairan
// siapkan query untuk menampilkan seluruh data dari tabel pengunjung
$query = "SELECT * FROM pengunjung ORDER BY no_pengunjung ASC";
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<title>Sistem Informasi Wisata JogjaBay</title>
	<link href="style.css" rel="stylesheet" >
	<link rel="icon" href="img/icon.png" type="image/png" >
</head>
<body>
<div class="container">
<div id="header">
<h1 id="logo">Sistem Informasi <span>Wisata JogjaBay</span></h1>
<p id="tanggal"><?php echo date("d M Y"); ?></p>
</div>
<hr>
<nav>
<ul>
<li><a href="tampil_pengunjung.php">Tampil</a></li>
<li><a href="tambah_pengunjung.php">Tambah</a>
<li><a href="edit_pengunjung.php">Edit</a>
<li><a href="hapus_pengunjung.php">Hapus</a></li>
<li><a href="logout.php">Logout</a>
</ul>
</nav>
<form id="search" action="tampil_pengunjung.php" method="get">
<p>
<label for="nama">Nama : </label> 
<input type="text" name="nama" id="nama" placeholder="search..." >
<input type="submit" name="submit" value="Search">
</p>
</form>
<h2>Data Pengunjung</h2>
<?php
// tampilkan pesan jika ada
if (isset($pesan)) {
	echo "<div class=\"pesan\">$pesan</div>";
}
?>
<table border="1">
<tr>
<th>No Pengunjung</th>
<th>Nama</th>
<th>Alamat Email</th>
<th>Tempat Asal</th>
<th>Tanggal Kunjungan</th>
<th>Tujuan Destinasi</th>
<th>Pendapat</th>
<th>Penilaian</th>
</tr>
<?php
// jalankan query
$result = mysqli_query($link, $query);

if(!$result){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}

//buat perulangan untuk element tabel dari data mahasiswa
while($data = mysqli_fetch_assoc($result))
{ 
// konversi date MySQL (yyyy-mm-dd) menjadi dd-mm-yyyy
$tanggal_php = strtotime($data["tanggal_kunjungan"]);
$tanggal = date("d - m - Y", $tanggal_php);

echo "<tr>";
echo "<td>$data[no_pengunjung]</td>";
echo "<td>$data[nama]</td>";
echo "<td>$data[alamat_email]</td>";
echo "<td>$data[tempat_asal]</td>";
echo "<td>$tanggal</td>";
echo "<td>$data[tujuan_destinasi]</td>";
echo "<td>$data[pendapat]</td>";
echo "<td>$data[penilaian]</td>";
echo "</tr>";
}

// bebaskan memory 
mysqli_free_result($result);

// tutup koneksi dengan database mysql
mysqli_close($link);
?>
</table>
<div id="footer">
	Copyright © <?php echo date("Y"); ?> Kelompok3 JogjaBay
</div>
</div>
</body>
</html>
