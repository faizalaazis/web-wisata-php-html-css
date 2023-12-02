<?php

// buka koneksi dengan MySQL
include("connection.php");

// cek apakah form telah di submit
if (isset($_POST["submit"])) {
// form telah disubmit, proses data

// ambil semua nilai form
$no_pengunjung	  = htmlentities(strip_tags(trim($_POST["no_pengunjung"])));
$nama			  = htmlentities(strip_tags(trim($_POST["nama"])));
$alamat_email     = htmlentities(strip_tags(trim($_POST["alamat_email"])));	
$tempat_asal	  = htmlentities(strip_tags(trim($_POST["tempat_asal"])));
$tujuan_destinasi = htmlentities(strip_tags(trim($_POST["tujuan_destinasi"])));
$pendapat		  = htmlentities(strip_tags(trim($_POST["pendapat"])));
$penilaian		  = htmlentities(strip_tags(trim($_POST["penilaian"])));
$tgl			  = htmlentities(strip_tags(trim($_POST["tgl"])));
$bln			  = htmlentities(strip_tags(trim($_POST["bln"])));
$thn			  = htmlentities(strip_tags(trim($_POST["thn"])));

// siapkan variabel untuk menampung pesan error
$pesan_error="";

// cek apakah "no_pengunjung" sudah diisi atau tidak
if (empty($no_pengunjung)) {
	$pesan_error .= "No Pengunjung belum diisi <br>";
}
// No Pengunjung harus angka dengan 4 digit
elseif (!preg_match("/^[0-9]{4}$/",$no_pengunjung) ) {
	$pesan_error .= "No Pengunjung harus berupa 4 digit angka <br>";
}

// cek ke database, apakah sudah ada nomor No Pengunjung yang sama
// filter data $no_pengunjung
$no_pengunjung = mysqli_real_escape_string($link,$no_pengunjung);
$query = "SELECT * FROM pengunjung WHERE no_pengunjung='$no_pengunjung'";
$hasil_query = mysqli_query($link, $query);

// cek jumlah record (baris), jika ada, $no_pengunjung tidak bisa diproses
$jumlah_data = mysqli_num_rows($hasil_query);
if ($jumlah_data >= 1 ) {
	$pesan_error .= "No Pengunjung yang sama sudah digunakan <br>";
}

// cek apakah "nama" sudah diisi atau tidak
if (empty($nama)) {
	$pesan_error .= "Nama belum diisi <br>";
}
// cek apakah "alamat email" sudah diisi atau tidak
if (empty($alamat_email)) {
	$pesan_error .= "Alamat email belum diisi <br>";
}
// cek apakah "tempat asal" sudah diisi atau tidak
if (empty($tempat_asal)) {
	$pesan_error .= "Tempat asal belum diisi <br>";
}

// cek apakah "tujuan_destinasi" sudah diisi atau tidak
if (empty($tujuan_destinasi)) {
	$pesan_error .= "Tujuan Destinasi belum diisi <br>";
}

// siapkan variabel untuk menggenerate pilihan pendapat
$select_sangat_bagus=""; $select_bagus=""; $select_cukup="";
$select_kurang_bagus=""; $select_sangat_kurang_bagus="";

switch($pendapat) {
	case "Sangat Bagus" : $select_sangat_bagus = "selected";  break;
	case "Bagus" : $select_bagus= "selected";  break;
	case "Cukup" : $select_cukup= "selected";  break;
	case "Kurang Bagus" : $select_kurang_bagus= "selected";  break;
	case "Sangat Kurang Bagus" : $select_sangat_kurang_bagus= "selected";  break;
}

// Penilaian harus berupa angka dan tidak boleh negatif
if (!is_numeric($penilaian) OR ($penilaian <=0)) {
	$pesan_error .= "Penilaian harus diisi dengan angka";
}

// jika tidak ada error, input ke database
if ($pesan_error === "") {

// filter semua data
	$no_pengunjung		 = mysqli_real_escape_string($link,$no_pengunjung);
	$nama				 = mysqli_real_escape_string($link,$nama );
	$alamat_email		 = mysqli_real_escape_string($link,$alamat_email );
	$asal_tempat		 = mysqli_real_escape_string($link,$tempat_asal);
	$tujuan_destinasi	 = mysqli_real_escape_string($link,$tujuan_destinasi);
	$pendapat			 = mysqli_real_escape_string($link,$pendapat);
	$tgl				 = mysqli_real_escape_string($link,$tgl);
	$bln				 = mysqli_real_escape_string($link,$bln);
	$thn				 = mysqli_real_escape_string($link,$thn);
	$penilaian			 = (float) $penilaian;

//gabungkan format tanggal agar sesuai dengan date MySQL
	$tgl_lhr = $thn."-".$bln."-".$tgl;
//buat dan jalankan query INSERT
$query = "INSERT INTO pengunjung VALUES ";
$query .= "('$no_pengunjung', '$nama', '$alamat_email','$tempat_asal', ";
$query .= "'$tgl_kunjungan','$tujuan_destinasi','$pendapat',$penilaian)";

$result = mysqli_query($link, $query);

//periksa hasil query
if($result) {
// INSERT berhasil, redirect ke tampil_pengunjung.php + pesan
	$pesan = "Pengunjung dengan nama = \"<b>$nama</b>\" sudah berhasil di tambah";
	$pesan = urlencode($pesan);
	header("Location: tambah_pengunjung.php?pesan={$pesan}");
}
else {
	die ("Query gagal dijalankan: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
}
}
else {
// form belum disubmit atau halaman ini tampil untuk pertama kali
// berikan nilai awal untuk semua isian form
$pesan_error       = "";
$no_pengunjung	   = "";
$nama              = "";
$alamat_email      = "";
$tempat_asal       = "";
$tujuan_destinasi      = "";
$select_sangat_bagus = "selected";
$select_bagus = ""; $select_cukup = ""; $select_kurang_bagus = "";
$select_sangat_kurang_bagus = "";
$pendapat = "";
$penilaian = "";
$tgl=1;$bln="1";$thn=2020;
}

// siapkan array untuk nama bulan
$arr_bln = array( "1"=>"Januari",
				  "2"=>"Februari",
				  "3"=>"Maret",
				  "4"=>"April",
				  "5"=>"Mei",
				  "6"=>"Juni",
				  "7"=>"Juli",
				  "8"=>"Agustus",
				  "9"=>"September",
				  "10"=>"Oktober",
				  "11"=>"Nopember",
				  "12"=>"Desember" );
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Informasi Wisata JogjaBay</title>
<link href="style.css" rel="stylesheet" >
<link rel="icon" href="img/favicon.png" type="image/png" >
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
<label for="no">Nama : </label>
<input type="text" name="nama" id="nama" placeholder="search..." >
<input type="submit" name="submit" value="Search">
</p>
</form>
<h2>Tambah Data Pengunjung</h2>
<?php
// tampilkan error jika ada
if ($pesan_error !== "") {
	echo "<div class=\"error\">$pesan_error</div>";
}
?>
<form id="form_mahasiswa" action="tambah_pengunjung.php" method="post">
<fieldset>
<legend>Pengunjung Baru</legend>
<p>
<label for="no_pengunjung">No Pengunjung : </label>
<input type="text" name="no_pengunjung" id="no_pengunjung" value="<?php echo $no_pengunjung ?>"
placeholder="Contoh: 1234">(4 digit angka)
</p>
<p>
<label for="nama">Nama : </label>
<input type="text" name="nama" id="nama" value="<?php echo $nama ?>">
</p>
<p>
<label for="alamat_email">Alamat Email : </label>
<input type="text" name="alamat_email" id="alamat_email" value="<?php echo $alamat_email ?>">
</p>
<p>
<label for="tempat_asal">Tempat Asal : </label>
<input type="text" name="tempat_asal" id="tempat_asal" value="<?php echo $tempat_asal ?>">
</p>
<p>
<label for="tgl" >Tanggal Kunjungan : </label>
<select name="tgl" id="tgl">
<?php
for ($i = 1; $i <= 31; $i++) {
if ($i==$tgl){
	echo "<option value = $i selected>";
}
else {
	echo "<option value = $i >";
}
echo str_pad($i,2,"0",STR_PAD_LEFT);
	echo "</option>";
	}
?>
</select>
<select name="bln">
<?php
foreach ($arr_bln as $key => $value) {
if ($key==$bln){
	echo "<option value=\"{$key}\" selected>{$value}</option>";
}
else {
	echo "<option value=\"{$key}\">{$value}</option>";
}
}
?>
</select>
<select name="thn">
<?php
for ($i = 2015; $i <= 2021; $i++) {
if ($i==$thn){
	echo "<option value = $i selected>";
}
else {
echo "<option value = $i >";
}
echo "$i </option>";
}
?>
</select>
</p>
<p>
<label for="tujuan_destinasi">Tujuan Destinasi   </label>
<input type="text" name="tujuan_destinasi" id="tujuan_destinasi" value="<?php echo $tujuan_destinasi ?>">
</p> 

<p>
<label for="pendapat" >Pendapat: </label>
<select name="pendapat" id="pendapat">
<option value="Sangat Bagus" <?php echo $select_sangat_bagus ?>>
Sangat Bagus </option>
<option value="Bagus" <?php echo $select_bagus ?>>
Bagus</option>
<option value="Cukup" <?php echo $select_cukup ?>>
Cukup</option>
<option value="Kurang Bagus" <?php echo $select_kurang_bagus ?>>
Kurang Bagus</option>
<option value="Sangat Kurang Bagus" <?php echo $select_sangat_kurang_bagus ?>>
Sangat Kurang Bagus</option>
</select>
</p>
<p >
<label for="penilaian">Penilaian : </label>
<input type="text" name="penilaian" id="penilaian" value="<?php echo $penilaian ?>"
placeholder="Contoh: 9.6">
(angka desimal dipisah dengan karakter titik ".")
</p>

</fieldset>
<br>
<p>
<input type="submit" name="submit" value="Tambah Data">
</p>
</form>

<div id="footer">
Copyright © <?php echo date("Y"); ?> Kelompok3 JogjaBay
</div>

</div>

</body>
</html>
<?php
// tutup koneksi dengan database mysql
mysqli_close($link);
?>
