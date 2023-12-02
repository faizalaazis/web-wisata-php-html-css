<?php
//mengambil pesan jika ada
if (isset($_GET["pesan"])) {
	$pesan = $_GET["pesan"];
}

// cek apakah form telah di submit
if (isset($_POST["submit"])) {
// form telah disubmit, proses data

// ambil nilai form
$username = htmlentities(strip_tags(trim($_POST["username"])));
$password = htmlentities(strip_tags(trim($_POST["password"])));

// siapkan variabel untuk menampung pesan error
$pesan_error="";

// cek apakah "username" sudah diisi atau tidak
if (empty($username)) {
	$pesan_error .= "Username belum diisi <br>";
}

// cek apakah "password" sudah diisi atau tidak
if (empty($password)) {
	$pesan_error .= "Password belum diisi <br>";
}

// buat koneksi ke mysql dari file connection.php
include("connection.php");

// filter dengan mysqli_real_escape_string
$username = mysqli_real_escape_string($link,$username);
$password = mysqli_real_escape_string($link,$password);

// generate hashing
$password_sha1 = sha1($password);

// cek apakah username dan password ada di tabel admin
$query = "SELECT * FROM admin WHERE username = '$username'

AND password = '$password_sha1'";
$result = mysqli_query($link,$query);

if(mysqli_num_rows($result) == 0 )  {
// data tidak ditemukan, buat pesan error
	$pesan_error .= "Username atau Password salah";
}


// bebaskan memory
mysqli_free_result($result);

// tutup koneksi dengan database MySQL
mysqli_close($link);

// jika lolos validasi, set session
if ($pesan_error === "") {
	session_start();
	$_SESSION["nama"] = $username;
	header("Location: tampil_pengunjung.php");
	}
}
else {
// form belum disubmit atau halaman ini tampil untuk pertama kali
// berikan nilai awal untuk semua isian form
	$pesan_error = "";
	$username = "";
$password = "";
}


?>

<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Informasi Wisata jogjaBay</title>
<link rel="icon" href="img/icon.png" type="image/png" >
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

body{
	margin: 0;
	padding: 0;
	font-family: 'Poppins', sans-serif;
	background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/loginbg.jpg') no-repeat top center / cover;
}

.box{
	width: 400px;
	padding: 20px;
	margin: auto;
	margin-top: 110px;
	background: #191919;
	text-align: center;
	box-shadow: 0 3px 5px 0px rgba(10, 10, 10, 0.2);
}

.box h1{
	color: white;
	text-transform: uppercase;
	font-weight: 500;
}

.box h3{
	color: white;
	text-transform: uppercase;
	font-weight: 500;
	margin-top: -28px;
}

.box input[type = "text"],.box input[type = "password"]{
	border:0;
	background: none;
	font-family: 'Poppins', sans-serif;
	display: block;
	margin: 20px auto;
	text-align: center;
	border: 2px solid #fff;
	padding: 14px 10px;
	width: 200px;
	outline: none;
	color: #85C1E9;
	border-radius: 24px;
	transition: 0.25s;
}

.box input[type = "text"]:focus,.box input[type = "password"]:focus{
	width: 220px;
	background: #fff;
	transition: 0.5s;
}

.box input[type = "submit"]{
	border:0;
	background: none;
	font-family: 'Poppins', sans-serif;
	display: block;
	margin: 25px auto;
	text-align: center;
	border: 2px solid #85C1E9;
	padding: 10px 40px;
	outline: none;
	color: white;
  	border-radius: 24px;
  	transition: 0.25s;
	cursor: pointer;
}

.box input[type = "submit"]:hover{
	background: #85C1E9;
	color: #000;
}

a {
	text-decoration: none;
	color: #85C1E9;
}

a:hover {
	color: red;
	text-shadow: 0px 0px 5px red ;
	transition: 0.5s;
}

.error {
	background: none;
	font-family: 'Poppins', sans-serif;
	color: red;
	padding: 10px 15px;
	margin: 0 0 20px 0;
	border: 1px solid red;
	border-radius: 20px;
	box-shadow: 0px 0px 10px red ;
}
</style>
</head>
<body>
	<div class="box">
<h1>SELAMAT DATANG</h1>
  <h3>Sistem Informasi Wisata JogjaBay</h3>
<?php
// tampilkan pesan jika ada
if (isset($pesan)) {
	echo "<div class=\"pesan\">$pesan</div>";
}

// tampilkan error jika ada
if ($pesan_error !== "") {
	echo "<div class=\"error\">$pesan_error</div>";
}
?>
<form action="login.php" method="post">
  <input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username ?>">
  <input type="password" name="password" id="password" placeholder="Password" value="<?php echo $username ?>">
  <input type="submit" name="submit" value="LOGIN">
  <a href="../index.php">Back to Home</a>
</form>
</div>
</body>
</html>
