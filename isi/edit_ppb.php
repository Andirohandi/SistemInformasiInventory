<?php
	include "../koneksi.php";
	
	$no_ppb		= $_POST['no_ppb'];
	$kode		= $_POST['kode'];
	$kodebb		= $_POST['kodebb'];
	$packing	= $_POST['packing'];
	$sat		= $_POST['sat'];
	$tgl_ppb	= $_POST['tgl_ppb'];
	$hrg_sat	= $_POST['hrg_sat'];
	$unit 		= $_POST['unit'];
	$tonage		= $_POST['tonage'];
	$jthtmpo_ppb= $_POST['jthtmpo_ppb'];
	$kategori 	= $_POST['kategori'];
	$ket 		= $_POST['ket'];
	
	$sql_update = "SELECT * FROM ppb WHERE no_ppb='$no_ppb'";
	$qry_update = mysql_query($sql_update);
	$num_update = mysql_num_rows($qry_update);
	
	if($num_update>0){
		if($no_ppb == "" OR $unit == "" OR $jthtmpo_ppb == "" OR $kodebb==""){
			$g = 3;
			$hasil = array('confirm'=>$g);
		}else{
			$sql = "UPDATE ppb SET kode='$kode', kodebb='$kodebb', packing='$packing', sat=$sat, unit=$unit, tonage=$tonage, tgl_ppb='$tgl_ppb', jthtmpo_ppb='$jthtmpo_ppb', hrg_sat=$hrg_sat, kategori='$kategori', ket='$ket' WHERE no_ppb='$no_ppb'";
			$qry = mysql_query($sql);
			
			if($qry){
				$h = 1;
				$hasil = array('confirm'=>$h);
			}else{
				$d = 4;
				$hasil = array('confirm'=>$d);
			}
		}
	}else{
		$f = 2;
		$hasil = array('confirm'=>$f);
	}
	
	echo json_encode($hasil);
?>