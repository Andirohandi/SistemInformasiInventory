<?php
	include "../koneksi.php";
	$id_nm	= $_POST['id_nm'];
	$no_val	= $_POST['no_val'];
	$tgl_val= $_POST['tgl_val'];
	$kode	= $_POST['kode'];
	$unit	= $_POST['unit'];
	$no_ret	= $_POST['no_ret'];
	
	$sel = "SELECT * FROM retur_prod WHERE no_ret='$no_ret' and no_val=''";
	$qry_s = mysql_query($sel);
	$num_s = mysql_num_rows($qry_s);
	
	if($num_s>0){
		$sql = "INSERT INTO val_ret(id_nm, no_val, no_ret_v, tgl_val) values('".$id_nm."', '".$no_val."', '".$no_ret."', '".$tgl_val."')";
		$qry = mysql_query($sql);
		
		$stok	= "SELECT * FROM stock_barang WHERE kode='$kode'";
		$stokq  = mysql_query($stok);
		$row	= mysql_fetch_assoc($stokq);
		$s_awal = $row['s_awal'];
		$masuk = $row['masuk'];
		$keluar = $row['keluar'];
		$s_akhir = $row['s_akhir'];
		
		if($qry){
			$sql_ret = "UPDATE retur_prod SET no_val='".$no_val."' WHERE no_ret='$no_ret'";
			mysql_query($sql_ret);
			
			$masuk_a = $masuk + $unit;
			$saldo_a  = $s_akhir + $unit;
			
			$upd_st = "UPDATE stock_barang SET masuk=$masuk_a, s_akhir=$saldo_a WHERE kode='$kode'";
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