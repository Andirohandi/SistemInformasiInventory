<?php
	include "../koneksi.php";
	$no_ret = $_POST['no_ret'];
	
	$sql = "SELECT * FROM retur_prod WHERE no_ret='$no_ret'";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$hasil = array();
	if($num>0){
		$del = "DELETE FROM retur_prod WHERE no_ret='$no_ret'";
		$qry_del = mysql_query($del);
		if($qry_del) $a = 1;
		else $a = 3;
	}else $a = 2;
	$hasil = array('confirm'=>$a);
	echo json_encode($hasil);
?>