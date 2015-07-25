<?php
	include "../koneksi.php";
	date_default_timezone_set("Asia/Jakarta");
	
	$no_ppb 	= $_POST['no_ppb'];
	$kode 		= $_POST['kode'];
	$kodebb 	= $_POST['kodebb'];
	$packing	= $_POST['packing'];
	$sat 		= $_POST['sat'];
	$unit 		= $_POST['unit'];
	$tonage		= $_POST['tonage'];
	$tgl_ppb 	= $_POST['tgl_ppb'];
	$jthtmpo_ppb= $_POST['jthtmpo_ppb'];
	$hrg_sat	= $_POST['hrg_sat'];
	$kategori 	= $_POST['kategori'];
	$status		= "Batal";
	$tgl_ppb_batal = date("d M Y");
	$ket 		= $_POST['ket'];
	
	$sql_update = "SELECT * FROM ppb WHERE no_ppb='$no_ppb'";
	$qry_update = mysql_query($sql_update);
	$num_update = mysql_num_rows($qry_update);
	
	if($num_update>0){
		$sql = "DELETE FROM ppb WHERE no_ppb='".$no_ppb."' and kode='".$kode."'";
		$qry = mysql_query($sql);
		
		if($qry){
			$inp_batal = "INSERT INTO ppb_batal(no_ppb, kode, kodebb, packing, sat, unit, tonage, tgl_ppb, jthtmpo_ppb, hrg_sat, kategori, status, tgl_ppb_batal, ket) values('".$no_ppb."','".$kode."','".$kodebb."','".$packing."','".$sat."','".$unit."','".$tonage."','".$tgl_ppb."','".$jthtmpo_ppb."','".$hrg_sat."','".$kategori."', '".$status."', '".$tgl_ppb_batal."', '".$ket."')";
			$qry_btl = mysql_query($inp_batal);
		
			$h = 1;
			$hasil = array('confirm'=>$h);
		}else{
			$g = 3;
			$hasil = array('confirm'=>$g);
		}
	}else{
		$d = 2;
		$hasil = array('confirm'=>$d);
	}
	
	echo json_encode($hasil);
?>