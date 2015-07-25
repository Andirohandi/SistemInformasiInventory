<?php
	include "../koneksi.php";
	$id_nm		= $_POST['id_nm'];
	$no_bkb	 	= $_POST['no_bkb'];
	$tgl_bkb	= $_POST['tgl_bkb'];
	$klr_ke	= $_POST['klr_ke'];
	$kode 		= $_POST['kode'];
	$kodebb 	= $_POST['kodebb'];
	$packing	= $_POST['packing'];
	$sat 		= $_POST['sat'];
	$unit 		= $_POST['unit'];
	$tonage		= $_POST['tonage'];
	$kategori 	= $_POST['kategori'];
	$ket 		= $_POST['ket'];
	$hasil		= array();
	
	if($kode==null OR $klr_ke==null OR $unit==null){
		$a	= 3;
		$hasil = array('confirm'=>$a);
	}else{
		$sql	= "INSERT INTO bkb(id_nm, no_bkb, kode, kodebb, sat, unit, tonage, tgl_bkb, klr_ke, kategori, ket) values('".$id_nm."','".$no_bkb."','".$kode."','".$kodebb."','".$sat."','".$unit."','".$tonage."','".$tgl_bkb."','".$klr_ke."','".$kategori."','".$ket."')";
		$qry	= mysql_query($sql);
		
		if($qry){
			//Update Stock
			$selstock = "SELECT * FROM stock_barang WHERE kode='$kode'";
			$qryselstock = mysql_query($selstock);
			$num = mysql_num_rows($qryselstock);
			$rows = mysql_fetch_assoc($qryselstock);
			$s_awal 	= $rows['s_awal'];
			$masuk 		= $rows['masuk'];
			$keluar 	= $rows['keluar'];
			$s_akhir 	= $rows['s_akhir'];
			$smin 		= $rows['smin'];
			$ket_s 		= $rows['ket'];
			
			$updkeluar	= $keluar + $unit;
			$upds_akhir = $s_awal + $masuk - $updkeluar;
			
			if($upds_akhir<$smin){
				$urg = "urgent";
			}else{
				$urg = "";
			}
			
			$updstock = "UPDATE stock_barang SET keluar=$updkeluar, s_akhir=$upds_akhir, ket='$urg' WHERE kode='$kode'";
			mysql_query($updstock);
			
			$a	= 1;
			$hasil = array('confirm'=>$a);
		}else{
			$a	= 2;
			$hasil = array('confirm'=>$a);
		}
	}
	echo json_encode($hasil);
?>