<?php

// memeeriksa apakah user sudah login, cek kehadiran session name
// jika tidak ada, redirect ke login.php
session_start();
if (!isset($_SESSION["nama"])) {
	header("Location: login.php");
}

// buka koneksi dengan MySQL
include("connection.php");

// cek apakah form telah di submit
if (isset($_POST["submit"])) {
// form telah disubmit, cek apakah berasal dari edit_mahasiswa.php
// atau update data dari form_edit.php

if ($_POST["submit"]=="Edit") {
//nilai form berasal dari halaman edit_mahasiswa.php

// ambil nilai no_pengunjung
$no_pengunjung = htmlentities(strip_tags(trim($_POST["no_pengunjung"])));
// filter data
$no_pengunjung = mysqli_real_escape_string($link,$no_pengunjung);

// ambil semua data dari database untuk menjadi nilai awal form
$query = "SELECT * FROM pengunjung WHERE no_pengunjung='$no_pengunjung'";$result = mysqli_query($link, $query);

if(!$result){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
// tidak perlu pakai perulangan while, karena hanya ada 1 record
$data = mysqli_fetch_assoc($result);

$nama			  = $data["nama"];
$tempat_asal	  = $data["tempat_asal"];
$tujuan_destinasi = $data["tujuan_destinasi"];
$pendapat		  = $data["pendapat"];
$penilaian		  = $data["penilaian"];

// untuk tanggal 
$tgl = substr($data["tanggal_kunjungan"],8,2);
$bln = substr($data["tanggal_kunjungan"],5,2);
$thn = substr($data["tanggal_kunjungan"],0,4);

// bebaskan memory
mysqli_free_result($result);
}

else if ($_POST["submit"]=="Update Data") {
// nilai form berasal dari halaman form_edit.php
// ambil semua nilai form
$no_pengunjung		= htmlentities(strip_tags(trim($_POST["no_pengunjung"])));
$nama				= htmlentities(strip_tags(trim($_POST["nama"])));
$tempat_asal	 	= htmlentities(strip_tags(trim($_POST["tempat_asal"])));
$tujuan_destinasi	= htmlentities(strip_tags(trim($_POST["tujuan_destinasi"])));
$pendapat			 = htmlentities(strip_tags(trim($_POST["pendapat"])));
$penilaian			 = htmlentities(strip_tags(trim($_POST["penilaian"])));
$tgl          = htmlentities(strip_tags(trim($_POST["tgl"])));
$bln          = htmlentities(strip_tags(trim($_POST["bln"])));
$thn          = htmlentities(strip_tags(trim($_POST["thn"])));
}

// proses validasi form
// siapkan variabel untuk menampung pesan error
$pesan_error="";

// cek apakah "no_pengunjung" sudah diisi atau tidak
if (empty($no_pengunjung)) {
	$pesan_error .= "No Pengunjung belum diisi <br>";
}
//No Pengunjung harus angka dengan 4 digit
elseif (!preg_match("/^[0-9]{4}$/",$no_pengunjung) ) {
	$pesan_error .= "No Pengunjung harus berupa 4 digit angka <br>";
}

// cek apakah "nama" sudah diisi atau tidak
if (empty($nama)) {
$pesan_error .= "Nama belum diisi <br>";
}

// cek apakah "tempat lahir" sudah diisi atau tidak
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
if (($pesan_error === "") AND ($_POST["submit"]=="Update Data")) {

// buka koneksi dengan MySQL
include("connection.php");

// filter semua data
	$no_pengunjung		 = mysqli_real_escape_string($link,$no_pengunjung);
	$nama				 = mysqli_real_escape_string($link,$nama );
	$tempat_asal		 = mysqli_real_escape_string($link,$tempat_asal);
	$tujuan_destinasi	 = mysqli_real_escape_string($link,$tujuan_destinasi);
	$pendapat			 = mysqli_real_escape_string($link,$pendapat);
	$tgl				 = mysqli_real_escape_string($link,$tgl);
	$bln				 = mysqli_real_escape_string($link,$bln);
	$thn				 = mysqli_real_escape_string($link,$thn);
	$penilaian			 = (float) $penilaian;

//gabungkan format tanggal agar sesuai dengan date MySQL
	$tgl_lhr = $thn."-".$bln."-".$tgl;

//buat dan jalankan query UPDATE
$query  = "UPDATE pengunjung SET ";
$query .= "nama = '$nama', tempat_asal = '$tempat_asal', ";
$query .= "tanggal_kunjungan = '$tgl_lhr', tujuan_destinasi='$tujuan_destinasi', ";
$query .= "pendapat = '$pendapat', penilaian=$penilaian ";
$query .= "WHERE no_pengunjung = '$no_pengunjung'";

$result = mysqli_query($link, $query);

//periksa hasil query
if($result) {
// INSERT berhasil, redirect ke tampil_pengunjung.php + pesan
	$pesan = "Pengunjung dengan nama = \"<b>$nama</b>\" sudah berhasil di update";
	$pesan = urlencode($pesan);
	header("Location: tampil_pengunjung.php?pesan={$pesan}");
}
else {
	die ("Query gagal dijalankan: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
}
}
else {
// form diakses secara langsung!
// redirect ke edit_penilaian.php
header("Location: edit_penilaian.php");
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
<title>Sistem Informasi Wisata DjogjaBay</title>
<link href="style.css" rel="stylesheet" >
<link rel="icon" href="img/favicon.png" type="image/png" >
</head>
<body>
<div class="container">
<div id="header">
<h1 id="logo">Sistem Informasi <span>Wisata DjogjaBay</span></h1>
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
</ul>  </nav>
<form id="search" action="tampil_pengunjung.php" method="get">
<p>
<label for="no_pengunjung">Nama : </label>
<input type="text" name="nama" id="nama" placeholder="search..." >
<input type="submit" name="submit" value="Search">
</p>
</form>
<h2>Edit Data Pengunjung</h2>
<?php
// tampilkan error jika ada
if ($pesan_error !== "") {
	echo "<div class=\"error\">$pesan_error</div>";
}
?>
<form id="form_pengunjung" action="form_edit.php" method="post">
<fieldset>
<legend>Pengunjung Baru</legend>
<p>
<label for="no_pengunjung">No Pengunjung : </label>
<input type="text" name="no_pengunjung" id="no_pengunjung" value="<?php echo $no_pengunjung ?>" readonly>
(tidak bisa diubah di menu edit)
</p>
<p>
<label for="nama">Nama : </label>
<input type="text" name="nama" id="nama" value="<?php echo $nama ?>">
</p>
<p>
<label for="tempat_asal">Tempat Asal : </label>
<input type="text" name="tempat_asal" id="tempat_asal"
value="<?php echo $tempat_asal ?>">
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
<p>
<label for="penilaian">Penilaian : </label>
<input type="text" name="penilaian" id="penilaian" value="<?php echo $penilaian ?>">
(angka desimal dipisah dengan karakter titik ".")
</p>

</fieldset>
<br>
<p>
<input type="submit" name="submit" value="Update Data">
</p>
</form>

</div>

</body>
</html>
<?php
// tutup koneksi dengan database mysql
mysqli_close($link);
?>


