<?php
	include "../koneksi.php";
	
	$no_btb	= $_POST['no_btb'];
	
	$sql	= "SELECT * FROM btb WHERE no_btb='$no_btb'";
	$qry	= mysql_query($sql);
	$result	= array();
	$num	= mysql_num_rows($qry);
	
	if($num>0){
		$row	=mysql_fetch_assoc($qry);
		$result	= array(
			'no_btb'	=> $row['no_btb'],
			'no_sj'	=> $row['no_sj'],
			'supplier'	=> $row['supplier'],
			'no_po'	=> $row['no_po'],
			'kode'	=> $row['kode'],
			'kodebb'	=> $row['kodebb'],
			'packing'	=> $row['packing'],
			'sat'	=> $row['sat'],
			'unit'	=> $row['unit'],
			'tonage'	=> $row['tonage'],
			'hrg_sat'	=> $row['hrg_sat'],
			'hrg_total'	=> $row['hrg_total'],
			'tgl_btb'	=> $row['tgl_btb'],
			'kategori'	=> $row['kategori'],
			'ket'	=> $row['ket']
		
		);
	}echo json_encode($result);
	
?>