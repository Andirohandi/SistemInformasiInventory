<?php
	include "../koneksi.php";
	
	$id = $_POST['i'];
	$sql = "SELECt * FROM masalah WHERE id_s='$id'";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	
	$hasil = array('confirm'=>$num);
	
	echo json_encode($hasil);
?>