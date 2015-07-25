<?php
include "../koneksi.php";
	$id_nm		= $_POST['id_nm'];
	$no_ppb	 	= $_POST['no_ppb'];
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
	$ket 		= $_POST['ket'];
	
	if($kode==null or $unit==null or $jthtmpo_ppb==null){
		$g = 3;
		$hasil = array('confirm'=>$g);
	}else{
		$simpan = "INSERT into ppb(id_nm,no_ppb,kode,kodebb,packing,sat,unit,tonage,tgl_ppb,jthtmpo_ppb,hrg_sat,kategori,ket) values('".$id_nm."','".$no_ppb."','".$kode."','".$kodebb."','".$packing."','".$sat."','".$unit."','".$tonage."','".$tgl_ppb."','".$jthtmpo_ppb."','".$hrg_sat."','".$kategori."','".$ket."')";
		$qrsimpan = mysql_query($simpan);
		
		if($qrsimpan){
			$h = 1;
			$hasil = array('confirm'=>$h);
			
		}else{
			$f = 2;
			$hasil = array('confirm'=>$f);
		}
	}
	
	echo json_encode($hasil);

?>