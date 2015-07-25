<?php
	include "../koneksi.php";
	
	$no_ret	= $_POST['search'];
	
	$sql = "SELECT * FROM retur_prod WHERE no_ret LIKE '%".$no_ret."%' and no_val=''";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$hasil = array();
	
	if($num>0){
		$row = mysql_fetch_assoc($qry);
		$hasil = array(
		'no_ret'		=> $row['no_ret'],
		'no_bkb'		=> $row['no_bkb'],
		'tgl_ret'		=> $row['tgl_ret'],
		'kategori'		=> $row['kategori'],
		'ket'			=> $row['ket'],
		'id_nm'			=> $row['id_nm'],
		'kode'			=> $row['kode'],
		'kodebb'		=> $row['kodebb'],
		'sat'			=> $row['sat'],
		'unit'			=> $row['unit'],
		'tonage'		=> $row['tonage']
		);
	}else{
	
	}
	echo json_encode($hasil);
?>