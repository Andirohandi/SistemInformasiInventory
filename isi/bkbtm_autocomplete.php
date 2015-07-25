<?php
	include "../koneksi.php";
	$no_bkbtm		= trim(strip_tags($_GET['term']));
	
	$sql	= "SELECT * FROM bkbtm WHERE no_bkbtm LIKE '%".$no_bkbtm."%' and no_val=''";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	$hasil	= array();
	$no = 0;
	
	if($num>0){
		while($row = mysql_fetch_assoc($qry)){
			$hasil[$no] = $row['no_bkbtm'];
			$no++;
		}
	}
	
	echo json_encode($hasil);
?>