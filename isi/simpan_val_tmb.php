<?php
	include "../koneksi.php";
	$id_nm	= $_POST['id_nm'];
	$kode	= $_POST['kode'];
	$no_val	= $_POST['no_val'];
	$tgl_val= $_POST['tgl_val'];
	$no_bkbtm	= $_POST['no_bkbtm'];
	$unit	= $_POST['unit'];
	
	$sel = "SELECT * FROM bkbtm WHERE no_bkbtm='$no_bkbtm' and no_val=''";
	$qry_s = mysql_query($sel);
	$num_s = mysql_num_rows($qry_s);
	
	if($num_s>0){
		$sql = "INSERT INTO val_bkb(id_nm, no_val, no_bkb, tgl_val) values('".$id_nm."', '".$no_val."', '".$no_bkbtm."', '".$tgl_val."')";
		$qry = mysql_query($sql);
		
		$stok	= "SELECT * FROM stock_barang WHERE kode='$kode'";
		$stokq  = mysql_query($stok);
		$row	= mysql_fetch_assoc($stokq);
		$s_awal = $row['s_awal'];
		$s_awal = $row['masuk'];
		$keluar = $row['keluar'];
		$st_smin = $row['st_smin'];
		$s_akhir = $row['s_akhir'];
		$ket = $row['ket'];
		
		
		
		if($qry){
			$sql_ret = "UPDATE bkbtm SET no_val='".$no_val."' WHERE no_bkbtm='$no_bkbtm'";
			mysql_query($sql_ret);
			
			$keluar_a = $keluar + $unit;
			$saldo_a  = $s_akhir - $unit;
			$st_smin_a = $saldo_a - $st_smin;
			
			if($saldo_a<$st_smin){
				$kete = 'urgent';
			}else{
				$kete = '';
			}
			
			$upd_st = "UPDATE stock_barang SET keluar=$keluar_a, s_akhir=$saldo_a, st_min=$st_min_a, ket='$kete' WHERE kode='$kode'";
			mysql_query($upd_st);
			
			$a = 1;
			$hasil = array('confirm'=>$a);
		}else{
			$a = 3;
			$hasil = array('confirm'=>$a);
		}
	}else{
		$a = 2;
		$hasil = array('confirm'=>$a);
	}
	echo json_encode($hasil);
?>