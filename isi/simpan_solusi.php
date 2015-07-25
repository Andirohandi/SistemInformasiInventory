<?php
	include "../koneksi.php";
	$id_s = $_POST['id_s'];
	$jam = $_POST['jam'];
	$tanggal = $_POST['tanggal'];
	$solusi = $_POST['solusi'];
	$id_nm = $_POST['id_nm'];
	$hasil = array();
	
	$sql = "INSERT into solusi(id_s, id_ms, jam_s, tanggal_s, solusi) values('".$id_s."', '".$id_nm."', '".$jam."', '".$tanggal."', '".$solusi."')";
	$qry = mysql_query($sql);
	
	if($qry){
		$sql_s = "UPDATE masalah SET id_s='$id_s' WHERE id_nm='$id_nm'";
		mysql_query($sql_s);
		
		$a = 1;
	}
	
	$hasil = array('confirm'=>$a);
	echo json_encode($hasil);
?>