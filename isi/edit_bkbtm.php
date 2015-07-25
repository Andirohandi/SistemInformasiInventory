<?php
	include "../koneksi.php";
	$id_nm		= $_POST['id_nm'];
	$no_bkbtm		= $_POST['no_bkbtm'];
	$kode		= $_POST['kode'];
	$kodebb		= $_POST['kodebb'];
	$sat		= $_POST['sat'];
	$unit		= $_POST['unit'];
	$tonage		= $_POST['tonage'];
	$no_bkb		= $_POST['no_bkb'];
	$tgl_ret	= $_POST['tgl_ret'];
	$kategori	= $_POST['kategori'];
	$ket		= $_POST['ket'];
	$hasil		= array();
	
	$sql	= "SELECT * FROM bkbtm WHERE no_bkbtm='$no_bkbtm'";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	
	if($num>0){
		if($no_bkb == "" OR $unit == ""){
			$a = 3;
			$hasil = array('confirm'=>$a);
		}else{
			$upd = "UPDATE bkbtm SET no_bkb='$no_bkb', kode='$kode', kodebb='$kodebb', sat=$sat, unit=$unit, tonage=$tonage, kategori='$kategori', ket='$ket' WHERE no_bkbtm='$no_bkbtm'";
			$qry_up = mysql_query($upd);
		
			if($qry_up){
				$a = 1;
				$hasil = array('confirm'=>$a);
			}else{
				$a = 4;
				$hasil = array('confirm'=>$a);
			}
		}
	}else{
		$a = 2;
		$hasil = array('confirm'=>$a);
	}
	
	echo json_encode($hasil);
?>