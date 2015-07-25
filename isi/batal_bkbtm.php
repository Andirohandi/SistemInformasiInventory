<?php
	include "../koneksi.php";
	$no_bkbtm = $_POST['no_bkbtm'];
	
	$sql = "SELECT * FROM bkbtm WHERE no_bkbtm='$no_bkbtm'";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$hasil = array();
	if($num>0){
		$del = "DELETE FROM bkbtm WHERE no_bkbtm='$no_bkbtm'";
		$qry_del = mysql_query($del);
		if($qry_del) $a = 1;
		else $a = 3;
	}else $a = 2;
	$hasil = array('confirm'=>$a);
	echo json_encode($hasil);
?>