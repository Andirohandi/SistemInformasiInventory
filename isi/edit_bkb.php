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
	
	$sel	= "SELECT * FROM bkb WHERE no_bkb='$no_bkb'";
	$qry_sel= mysql_query($sel);
	$num_sel= mysql_num_rows($qry_sel);
	
	if($num_sel>0){
		if($kode==null OR $unit==null OR $klr_ke==null){
			$a = 3;
			$hasil = array('confirm'=>$a);
		}else{
			//===== MENGELUARKAN NILAI SEBELUM DIUPDATE
			$sel_bkb = "SELECT * FROM bkb WHERE no_bkb='$no_bkb'";
			$qry_bkb = mysql_query($sel_bkb);
			$row_bkb = mysql_fetch_assoc($qry_bkb);
			$kode_b = $row_bkb['kode'];
			$unit_bkb_b = $row_bkb['unit'];
			$tonage_bkb_b = $row_bkb['tonage'];
			
			//====== MENAMBAH STOCK===
			$sel_stk	= "SELECT * FROM stock_barang WHERE kode='$kode_b'";
			$qry_stk	= mysql_query($sel_stk);
			$row_st		= mysql_fetch_assoc($qry_stk);
			$s_awal_stk	= $row_st['s_awal'];
			$masuk_stk	= $row_st['masuk'];
			$keluar_stk	= $row_st['keluar'];
			$s_akhir_stk= $row_st['s_akhir'];
			
			$keluar_akh	= $keluar_stk - $unit_bkb_b;
			$akhir_akh	= $s_akhir_stk + $unit_bkb_b;
			
			$upd_stk_b	= "UPDATE stock_barang SET keluar=$keluar_akh, s_akhir=$akhir_akh WHERE kode='$kode_b'";
			mysql_query($upd_stk_b);
			
			$sql	= "UPDATE bkb SET kode='$kode', kodebb='$kodebb', sat=$sat, unit=$unit, tonage=$tonage, klr_ke='$klr_ke', kategori='$kategori', ket='$ket' WHERE no_bkb='$no_bkb'";
			$qry	= mysql_query($sql);
					
			if($qry){
				//UPDATE STOK
				$stok_upd	= "SELECT * FROM stock_barang WHERE kode='$kode'";
				$qry_upd_s	= mysql_query($stok_upd);
				$st_row		= mysql_fetch_assoc($qry_upd_s);
				$s_awal		= $st_row['s_awal'];
				$masuk 		= $st_row['masuk'];
				$keluar		= $st_row['keluar'];
				$s_akhir	= $st_row['s_akhir'];
				$smin		= $st_row['smin'];
				$ket_s		= $st_row['ket'];
				
				$updkeluar	= $keluar + $unit;
				$upds_akhir = $s_akhir - $updkeluar;
				
				if($upds_akhir<$smin){
					$urg = "urgent";
				}else{
					$urg = "";
				}
				
				$updstock = "UPDATE stock_barang SET keluar=$updkeluar, s_akhir=$upds_akhir, ket='$urg' WHERE kode='$kode'";
				mysql_query($updstock);	
			
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