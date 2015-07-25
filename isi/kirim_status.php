<?php
	session_start();
	include "../koneksi.php";
	$pengirim 	= $_SESSION['username'];
	$id_nm		= $_POST['id_nm'];
	$waktu		= $_POST['waktu'];
	$masalah	= ($_POST['status']);
	$hasil = array();
	
	$sql	= "INSERT INTO status values('".$id_nm."', '".$pengirim."', '".$waktu."', '".$masalah."')";
	$qry	= mysql_query($sql);
	if($qry){
		$a = 1;
	}else{
		$a = 2;
	}
	
	$hasil = array('confirm'=>$a);
	echo json_encode($hasil);
?>