<?php
	include "../koneksi.php";
	$id = $_POST['i'];
	
	$sql = "SELECT * FROM masalah WHERE id_nm='".$id."'";
	$qry = mysql_query($sql);
	$hasil = array();
	$row = mysql_fetch_assoc($qry);
	$hasil = array(
		'nama' =>$row['nama'],
		'masalah' =>$row['masalah'],
		'id_nm' =>$row['id_nm']
	);
	
	echo json_encode($hasil);
?>