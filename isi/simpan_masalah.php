<?php
	include "../koneksi.php";
	$id_nm		= $_POST['id_nm'];
	$nama		= $_POST['nama'];
	$jam		= $_POST['jam'];
	$tanggal	= $_POST['tanggal'];
	$masalah	= $_POST['masalah'];
	
	$sql	= "INSERT INTO masalah(id_nm, nama, jam, tanggal, masalah) values('".$id_nm."', '".$nama."', '".$jam."','".$tanggal."','".$masalah."')";
	$qry	= mysql_query($sql);
	
	if($qry){
		$a = 1;
	}else{
		$a = 2;
	}
	
	$hasil = array('confirm'=>$a);
	
	Echo json_encode($hasil);
	
?>