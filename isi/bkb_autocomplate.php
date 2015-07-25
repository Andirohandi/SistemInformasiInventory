<?php
	include "../koneksi.php";
	
	$no_bkb = trim(strip_tags($_GET['term']));
	
	$sql= "SELECT * FROM bkb WHERE no_bkb LIKE '%".$no_bkb."%'";
	$qry = mysql_query($sql);
	$arr = array();
	$a = 0;
	while($row=mysql_fetch_assoc($qry)){
		$arr[$a] = $row['no_bkb'];
		$a++;
	}
	echo json_encode($arr);
?>