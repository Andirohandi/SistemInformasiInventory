<?php
	include "../koneksi.php";
	
	$id_nm		= $_POST['id_nm'];
	$no_bkbtm	= $_POST['no_bkbtm'];
	$kode		= $_POST['kode'];
	$kodebb		= $_POST['kodebb'];
	$sat		= $_POST['sat'];
	$unit		= $_POST['unit'];
	$tonage		= $_POST['tonage'];
	$no_bkb		= $_POST['no_bkb'];
	$tgl_bkbtm	= $_POST['tgl_bkbtm'];
	$kategori	= $_POST['kategori'];
	$ket		= $_POST['ket'];
	$hasil		= array();
	
	$sql	= "SELECT * FROM bkbtm WHERE no_bkbtm='$no_bkbtm'";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	
	
	if($num>0){
		$a = 2;
		$hasil = array('confirm'=>$a);
	}else{
		if($no_bkb == "" OR $unit == ""){
			$a = 3;
			$hasil = array('confirm'=>$a);
		}else{
			
			$ins_ret = "INSERT INTO bkbtm(id_nm, no_bkbtm, tgl_bkbtm, no_bkb, kode, kodebb, sat, unit, tonage, kategori, ket) values('".$id_nm."','".$no_bkbtm."', '".$tgl_bkbtm."', '".$no_bkb."', '".$kode."','".$kodebb."','".$sat."','".$unit."','".$tonage."', '".$kategori."','".$ket."')";
			$qry_ret = mysql_query($ins_ret);
			
			if($qry_ret){
				$a = 1;
				$hasil = array('confirm'=>$a);
			}
			
		}
	}
	
	echo json_encode($hasil);
?>