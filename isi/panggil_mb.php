<?php
	include "../koneksi.php";
	$kode 	= $_POST['kode'];
	$sql	= "SELECT * FROM master_barang WHERE kode='$kode' and kategori = 'Bahan Baku'";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	$hasil	= array();
	
	if($num>0){
		$row = mysql_fetch_assoc($qry);
		$hasil = array(
			'id'	=> $row['id'],
			'kategori'	=> $row['kategori'],
			'sat'		=> $row['sat'],
			'smin'		=> $row['smin'],
			'packing'	=> $row['packing'],
			'rop'		=> $row['rop'],
			'isi'		=> $row['isi'],
			'smax'		=> $row['smax'],
			'supplier'	=> $row['supplier'],
			'hrg_sat'	=> $row['hrg_sat'],
			'kode'		=> $row['kode'],
			'kodebb'	=> $row['kodebb'],
			'LT'		=> $row['LT'],
			'ket'		=> $row['ket']
		);
	}
	echo json_encode($hasil);
?>