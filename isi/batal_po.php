<?php
	include "../koneksi.php";
	
	$no_po = $_POST['no_po'];
	
	$pilih = "SELECT * FROM po WHERE no_po='$no_po'";
	$pilihqry = mysql_query($pilih);
	$jml = mysql_num_rows($pilihqry);
	
	if($jml>0){
		$sql = "DELETE FROM po WHERE no_po='$no_po'";
		$qry = mysql_query($sql);
		
		if($qry){
			$h = 1;
			$hasil = array('confirm'=>$h);//Berhasil
		}else{
		
		}
	}else{
		$h = 2;
		$hasil = array('confirm'=>$h);
	}
	echo json_encode($hasil);
?>