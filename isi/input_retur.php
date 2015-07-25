<?php
	if(isset($_POST['refresh'])){
		header('location:input_retur_barang.php');
	}else if(isset($_POST['dataretur'])){
		header('location:data_retur_prod.php');
	}else if(isset($_POST['databkbtm'])){
		header('location:data_keluar_tamb.php');
	}else{
		header('location:produksi.php');
	}
?>