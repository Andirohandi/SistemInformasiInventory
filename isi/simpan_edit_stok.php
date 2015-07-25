<?php
	include "../koneksi.php";
	
	$masuk	= $_POST['masuk'];
	$keluar	= $_POST['keluar'];
	$s_akhir= $_POST['s_akhir'];
	$kode	= $_POST['kode'];
	$hasil = array();
	
	$sql = "UPDATE stock_barang SET masuk=$masuk, keluar=$keluar, s_akhir=$s_akhir WHERE kode='$kode'";
	$qry = mysql_query($sql);
	
	if($qry){
		$a = 1;
	}else{
		$a = 2;
	}
	
	$hasil = array('confirm' =>$a);
	
	echo json_encode($hasil);

?>