<?php
// memeriksa apakah user sudah login, cek kehadiran session name
// jika tidak ada, redirect ke login.php
session_start();
if (!isset($_SESSION["nama"])) {
	header("Location: login.php");
}

// buka koneksi dengan MySQL
include("connection.php");

// cek apakah form telah di submit (untuk menghapus data)
if (isset($_POST["submit"])) {
// form telah disubmit, proses data

// ambil nilai no_pengunjung
$no_pengunjung = htmlentities(strip_tags(trim($_POST["no_pengunjung"])));
// filter data
$no_pengunjung= mysqli_real_escape_string($link,$no_pengunjung);

//jalankan query DELETE
$query = "DELETE FROM pengunjung WHERE no_pengunjung='$no_pengunjung' ";
$hasil_query = mysqli_query($link, $query);

//periksa query, tampilkan pesan kesalahan jika gagal
if($hasil_query) {
// DELETE berhasil, redirect ke tampil_pengunjung.php + pesan
	$pesan = "Pengunjung dengan no_pengunjung= \"<b>$no_pengunjung</b>\" sudah berhasil di hapus";
	$pesan = urlencode($pesan);
	header("Location: tampil_pengunjung.php?pesan={$pesan}");
}
else {
	die ("Query gagal dijalankan: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Informasi Wisata DjogjaBay</title>
<link href="style.css" rel="stylesheet" >
<link rel="icon" href="img/favicon.png" type="image/png" >
</head>
<body>
<div class="container">
<div id="header">
<h1 id="logo">Sistem Informasi <span>Wisata Djogja</span></h1>
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
<label for="no_pengunjung">Nama : </label>
      <input type="text" name="nama" id="nama" placeholder="search..." >
      <input type="submit" name="submit" value="Search">
    </p>
  </form>
<h2>Hapus Data Pengunjung</h2>
<?php
// tampilkan pesan jika ada
if ((isset($_GET["pesan"]))) {
	echo "<div class=\"pesan\">{$_GET["pesan"]}</div>";
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
<th></th>
</tr>

<?php
// buat query untuk menampilkan seluruh data tabel pengunjung
$query = "SELECT * FROM pengunjung ORDER BY no_pengunjung ASC";
$result = mysqli_query($link, $query);

if(!$result){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}

//buat perulangan untuk element tabel dari data mahasiswa
while($data = mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>$data[no_pengunjung]</td>";
echo "<td>$data[nama]</td>";
echo "<td>$data[alamat_email]</td>";
echo "<td>$data[tempat_asal]</td>";
echo "<td>$data[tanggal_kunjungan]</td>";
echo "<td>$data[tujuan_destinasi]</td>";
echo "<td>$data[pendapat]</td>";
echo "<td>$data[penilaian]</td>";
echo "<td>";
?>
<form action="hapus_pengunjung.php" method="post" >
<input type="hidden" name="no_pengunjung" value="<?php echo "$data[no_pengunjung]"; ?>" >
<input type="submit" name="submit" value="Hapus" >
</form>
<?php
echo "</td>";
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
