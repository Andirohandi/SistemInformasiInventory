<?php
	include "../koneksi.php";
	
	$no_bkbtm = $_POST['no_bkbtm'];
	
	$sql = "SELECT * FROM bkbtm WHERE no_bkbtm='$no_bkbtm'";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$hasil = array();
	if($num>0){
		$row = mysql_fetch_assoc($qry);
		$hasil = array(
			'kode'			=> $row['kode'],
			'kodebb'		=> $row['kodebb'],
			'sat'			=> $row['sat'],
			'unit'			=> $row['unit'],
			'tonage'		=> $row['tonage']
		);
	}
	echo json_encode($hasil);
	
?>