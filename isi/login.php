<?php
	include "../koneksi.php";
	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	$log = "SELECT * from profile where username='".$user."' and password='".$pass."'";
	$login = mysql_query($log);
	$jml = mysql_num_rows($login);
	
	if($jml>0 && $user=="Siti Rahmawati Ramadhani"){
		session_start();
		$_SESSION['username'] = $user;
		header('location:permintaan_pembelian.php');
	}else if($jml>0 && $user=="Haerini"){
		session_start();
		$_SESSION['username'] = $user;
		header('location:pembelian_barang.php');
	}else if($jml>0 && $user=="Ejang Nurjaman"){
		session_start();
		$_SESSION['username'] = $user;
		header('location:penerimaan_barang.php');
	}else if($jml>0 && $user=="Asti"){
		session_start();
		$_SESSION['username'] = $user;
		header('location:pengeluaran_barang.php');
	}else if($jml>0 && $user=="Irma Iryani"){
		session_start();
		$_SESSION['username'] = $user;
		header('location:arus_stok_barang.php');
	}else if($jml>0 && $user=="Irma Iryani"){
		session_start();
		$_SESSION['username'] = $user;
		header('location:control_stock.php');
	}else if($jml>0 && $user=="Aef"){
		session_start();
		$_SESSION['username'] = $user;
		header('location:produksi.php');
	}else if($jml>0 && $user=="Andi Rohandi"){
		session_start();
		$_SESSION['username'] = $user;
		header('location:admin.php');
	}else{
	echo "<script>window.alert('Maaf Login Anda Gagal');window.location=('../index.php')</script>";
	}
?>