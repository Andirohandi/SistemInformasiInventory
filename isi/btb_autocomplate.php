<?php 
	include "../koneksi.php";
	
	$no_btb	= trim(strip_tags($_GET['term']));
	
	$sql	= "SELECT * FROM btb WHERE no_btb LIKE '%".$no_btb."%' LIMIT 10";
	$qry	= mysql_query($sql);
	$no		= 0;
	$num 	= mysql_num_rows($qry);
	$result = array();
	
	if($num>0){
		while($row=mysql_fetch_assoc($qry)){
			$result[$no] = $row['no_btb'];
			$no++;
		}
	}
	echo json_encode($result);
?>