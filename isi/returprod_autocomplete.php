<?php
	include "../koneksi.php";
	$no_ret		= trim(strip_tags($_GET['term']));
	
	$sql	= "SELECT * FROM retur_prod WHERE no_ret LIKE '%".$no_ret."%' and no_val=''";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	$hasil	= array();
	$no = 0;
	
	if($num>0){
		while($row = mysql_fetch_assoc($qry)){
			$hasil[$no] = $row['no_ret'];
			$no++;
		}
	}
	
	echo json_encode($hasil);
?>