<?php
include "../koneksi.php";

	$kode = $_POST['kode'];
	
	$bb = "SELECT * FROM master_barang WHERE kode = '".$kode."'";
	$qrbb = mysql_query($bb);
	$jmlbb = mysql_num_rows($qrbb);
	
	$result = 0;
	if($jmlbb > 0){
		$row = mysql_fetch_assoc($qrbb);
		$result = array(
			'kodebb'	 => $row['kodebb'],
			'packing'	 => $row['packing'],
			'sat' 		 => $row['sat'],
			'hrg_sat' 	 => $row['hrg_sat'],
			'kategori'	 => $row['kategori']
		);
	}
	
echo json_encode($result);
?>