<?php
	include "../koneksi.php";
	
	$no_ppb = trim(strip_tags($_GET['term']));
	
	$sql= "SELECT * FROM ppb WHERE no_ppb LIKE '%".$no_ppb."%' and no_po=''";
	$qry = mysql_query($sql);
	$arr = array();
	$a = 0;
	while($row=mysql_fetch_assoc($qry)){
		$arr[$a] = $row['no_ppb'];
		$a++;
	}
	echo json_encode($arr);
?>