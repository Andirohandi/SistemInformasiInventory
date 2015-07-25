<?php
include "../koneksi.php";

	$term = $_POST['term'];
	
	$sql = "SELECT * FROM master_barang WHERE kode LIKE '%$term%' OR kodebb LIKE '%$term%' ";
	$qry = mysql_query($sql);
	$jml = mysql_num_rows($qry);
	$hasil = array();
	$i = 0;
	if($jml>0){
		while($row = mysql_fetch_assoc($qry)){
			$hasil[$i] = array(
			'kode' => $row['kode'],
			'kodebb' => $row['kodebb'],
			'sat' => $row['sat'],
			'smin' => $row['smin'],
			'rop' => $row['rop'],
			'smax' => $row['smax'],
			'LT' => $row['LT'],
			'ket' => $row['ket']
			);
			$i++;
		}
	}
	
	echo json_encode($hasil);
?>