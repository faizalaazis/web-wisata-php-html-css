	 <?php
//berikut ini digunakan untuk membuat koneksi database mysql
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$link   = mysqli_connect($dbhost,$dbuser,$dbpass);

//memerikasa koneksi apakah ada kesalahan jika ada tampilkan pesan gagal
if(!$link){
	die ("Koneksi dengan database gagal: ".mysqli_connect_errno().
	" - ".mysqli_connect_error());
}

//membuat database wisata_jogjabay jika belum ada
$query = "CREATE DATABASE IF NOT EXISTS wisata_djogjabay";
$result = mysqli_query($link, $query);

if(!$result){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
else {
	echo "Database <b>'wisata djogjabay'</b> berhasil dibuat... <br>";
}

//memilih database wisata_jogjabay
$result = mysqli_select_db($link,"wisata_djogjabay");

if(!$result){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
else {
	echo "Database <b>'wisata_djogjabay'</b> berhasil dipilih... <br>";
	}

// cek apakah tabel pengunjung sudah ada. jika ada, hapus tabel
$query = "DROP TABLE IF EXISTS pengunjung";
$hasil_query = mysqli_query($link, $query);

if(!$hasil_query){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
else {
	echo "Tabel <b>'pengunjung'</b> berhasil dihapus... <br>";
}

// membuat query untuk CREATE tabel pengunjung
$query  = "CREATE TABLE pengunjung (no_pengunjung CHAR(4), nama VARCHAR(100),";
$query .= "alamat_email varchar(50), tempat_asal VARCHAR(50), tanggal_kunjungan DATE, ";
$query .= "tujuan_destinasi VARCHAR(50), pendapat VARCHAR(50), ";
$query .= "penilaian DECIMAL(2,1), PRIMARY KEY (no_pengunjung))";

$hasil_query = mysqli_query($link, $query);

if(!$hasil_query){
	die ("Query Error: ".mysqli_errno($link). 
	" - ".mysqli_error($link));
	}
else {
	echo "Tabel <b>'pengunjung'</b> berhasil dibuat... <br>";
	}

// buat query untuk INSERT data ke tabel pengunjung
$query  = "INSERT INTO pengunjung VALUES ";
$query .= "('0001', 'Muhammad Azis', 'Azis11@gmail.com', 'Karanganyar', '2020-09-12', ";
$query .= "'Memo racer', 'Bagus', 8.1), ";
$query .= "('0002', 'Sabar sadewa', 'Sabar12@gmail.com', 'Malang', '2020-12-23', ";
$query .= "'Museum Air', 'Sangat Bagus', 9.5), ";
$query .= "('0004', 'Ruri Faujana', 'Ruri01@gmail.com', 'Jakarta', '2020-10-09', ";
$query .= "'Bekti Adventure', 'Cukup', 6.4), ";
$query .= "('0003', 'Arwindita Ayu', 'Arwntn@gmail.com', 'Jogja', '2020-11-29', ";
$query .= "'The Harbour Theater', 'Kurang Bagus', 3.4), ";
$query .= "('0005', 'Irsyad Bagas', 'Irsad02@gmail.com', 'Surakarta', '2020-12-14', ";
$query .= "'Jolie Raft River','Sangat Bagus', 8.9)";

$hasil_query = mysqli_query($link, $query);

if(!$hasil_query){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
else {
	echo "Tabel <b>'pengunjung'</b> berhasil diisi... <br>";
}

// cek apakah tabel admin sudah ada. jika ada, hapus tabel
$query = "DROP TABLE IF EXISTS admin";
$hasil_query = mysqli_query($link, $query);

if(!$hasil_query){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
else {
	echo "Tabel <b>'admin'</b> berhasil dihapus... <br>";
}

// buat query untuk CREATE tabel admin
$query  = "CREATE TABLE admin (username VARCHAR(50), password CHAR(40))";

$hasil_query = mysqli_query($link, $query);

if(!$hasil_query){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
else {
	echo "Tabel <b>'admin'</b> berhasil dibuat... <br>";
}

// buat username dan password untuk admin
$username = "adminganteng";
$password = sha1("rujakjeruk");

// buat query untuk INSERT data ke tabel admin
$query  = "INSERT INTO admin VALUES ('$username','$password')";

$hasil_query = mysqli_query($link, $query);

if(!$hasil_query){
	die ("Query Error: ".mysqli_errno($link).
	" - ".mysqli_error($link));
}
else {
	echo "Tabel <b>'admin'</b> berhasil diisi... <br>";
}

// tutup koneksi dengan database mysql
mysqli_close($link);

?>