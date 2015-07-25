<?php
	include "../koneksi.php";
	
	$no_bkb = $_POST['no_bkb'];
	$hasil  = array();
	
	$sel = "SELECT * FROM bkb WHERE no_bkb='$no_bkb'";
	$ada = mysql_query($sel);
	$num = mysql_num_rows($ada);
	$row = mysql_fetch_assoc($ada);
	$kode= $row['kode'];
	$unit= $row['unit'];
	
	if($num>0){
	
	$sql = "DELETE FROM bkb WHERE no_bkb='$no_bkb'";
	$qry = mysql_query($sql);
	
		if($qry){
			$stok = "SELECT * FROM stock_barang WHERE kode='$kode'";
			$stk  = mysql_query($stok);
			$amb  = mysql_fetch_assoc($stk);
			$keluar = $amb['keluar'];
			$s_akhir = $amb['s_akhir'];
			$smin = $amb['smin'];
			
			$klr	= $keluar - $unit;
			$akhir	= $s_akhir + $unit;
			$ket 	= "";
			if($akhir<$smin){
				$ket="urgent";
			}else{
				$ket="";
			}
			
			$upd = "UPDATE stock_barang SET keluar=$klr, s_akhir=$akhir, ket='$ket' WHERE kode='$kode'";
			mysql_query($upd);
			
			$a = 1;
			$hasil = array('confirm'=>$a);
		}
	
	}else{
		$a = 2;
		$hasil = array('confirm'=>$a);
	}
	
	echo json_encode($hasil);
?>