<!DOCTYPE html>
<html>
<head>
	<title>Membuat login dengan codeigniter | www.malasngoding.com</title>
</head>
<body>
	<h1>Login berhasil !</h1>
	<h2>Hai, 
	<?php 
		//method memanggil session untuk admin yang login
		echo $this->session->userdata("nama"); 
	?></h2>
	<a href="
	<?php 
		//menampilkan tombol link untuk logout
		echo base_url('login/logout'); 
	?>">Logout</a>
</body>
</html>