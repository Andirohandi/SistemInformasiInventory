<?php
	if(isset($_POST['refresh'])){
		header('location:input_keluar_barang.php');
	}else if(isset($_POST['databkb'])){
		header('location:data_keluar_barang.php');
	}else{
		header('location:pengeluaran_barang.php');
	}
?>