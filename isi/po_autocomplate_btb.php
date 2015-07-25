<?php
include "../koneksi.php";
	$term = trim(strip_tags($_GET['term']));
	
	$sql = "SELECT * FROM po WHERE no_po LIKE '%$term%' and sisa_po != 0";
	$qry = mysql_query($sql);
	$arr = array();
	$a = 0;
	while($row = mysql_fetch_assoc($qry)){
		$arr[$a] = $row['no_po'];
		$a++;
	}
	
	echo json_encode($arr);
?>