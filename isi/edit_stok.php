<?php
	include "../koneksi.php";
	
	$kode = $_POST['i'];
	
	$sql  = "SELECT * FROM stock_barang WHERE kode='$kode'";
	$qry  = mysql_query($sql);
	$hasil= array();
	
	$row  = mysql_fetch_assoc($qry);
	$hasil = array(
		'kode'	=> $row['kode'],
		'kodebb'	=> $row['kodebb'],
		'sat'	=> $row['sat'],
		's_awal'	=> $row['s_awal'],
		'masuk'	=> $row['masuk'],
		'keluar'	=> $row['keluar'],
		'smin'	=> $row['smin'],
		'rop'	=> $row['rop'],
		'smax'	=> $row['smax'],
		's_akhir'	=> $row['s_akhir']
	);
	echo json_encode($hasil);
	
	
?>