<?php
	include "../koneksi.php";
	
	$no_bkbtm	= $_POST['search'];
	
	$sql = "SELECT * FROM bkbtm WHERE no_bkbtm LIKE '%".$no_bkbtm."%' and no_val=''";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$hasil = array();
	
	if($num>0){
		$row = mysql_fetch_assoc($qry);
		$hasil = array(
		'no_bkbtm'		=> $row['no_bkbtm'],
		'no_bkb'		=> $row['no_bkb'],
		'tgl_bkbtm'		=> $row['tgl_bkbtm'],
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