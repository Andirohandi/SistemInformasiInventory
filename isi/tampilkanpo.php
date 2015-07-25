<?php
	include "../koneksi.php";
	$no_po = $_POST['no_po'];
	
	$sql = "SELECT * FROM po WHERE no_po = '$no_po' and sisa_po != 0 ";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$hasil = array();
	
	if($num > 0){
		$row = mysql_fetch_assoc($qry);
		$hasil = array(
		'supplier'	=> $row['supplier'],
		'kode' 		=> $row['kode'],
		'kodebb'	=> $row['kodebb'],
		'packing'	=> $row['packing'],
		'sat'		=> $row['sat'],
		'hrg_sat'	=> $row['hrg_sat'],
		'kategori' 	=> $row['kategori']
		);
	}
	
	echo json_encode($hasil);
?>