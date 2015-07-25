<?php
	include "../koneksi.php";
	
	$no_btb = $_POST['no_btb'];
	
	$sql 	= "SELECT * FROM btb WHERE no_btb='$no_btb'";
	$qry 	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	
	if($num>0){
		//===== MENGELUARKAN NILAI SEBELUM DIUPDATE
		$sel_btb = "SELECT * FROM btb WHERE no_btb='$no_btb'";
		$qry_btb = mysql_query($sel_btb);
		$row_btb = mysql_fetch_assoc($qry_btb);
		$no_po_b = $row_btb['no_po'];
		$kode_b = $row_btb['kode'];
		$unit_btb_b = $row_btb['unit'];
		$tonage_btb_b = $row_btb['tonage'];
		
		//===== MENGURANGI PO 
		$sel_po	= "SELECT * FROM po WHERE no_po='$no_po'";
		$qry_po	= mysql_query($sel_po);
		$row_po = mysql_fetch_assoc($qry_po);
		$unit_po_a = $row_po['unit'];
		$datang_po_a = $row_po['po_datang'];
		$sisa_po_a = $row_po['sisa_po'];
		
		$po_datang_b = $datang_po_a - $unit_btb_b;
		$sisa_po_b	= $sisa_po_a + $unit_btb_b;
		
		$sql_upd_a	= "UPDATE po SET po_datang=$po_datang_b, sisa_po=$sisa_po_b WHERE no_po='$no_po_b'";
		mysql_query($sql_upd_a);
		
		//====== MENGURANGI STOCK===
		$sel_stk	= "SELECT * FROM stock_barang WHERE kode='$kode_b'";
		$qry_stk	= mysql_query($sel_stk);
		$row_st		= mysql_fetch_assoc($qry_stk);
		$s_awal_stk	= $row_st['s_awal'];
		$masuk_stk	= $row_st['masuk'];
		$keluar_stk	= $row_st['keluar'];
		$s_akhir_stk= $row_st['s_akhir'];
		$smin		= $row_st['smin'];
		$ket_s		= $row_st['ket'];
		
		$masuk_akh	= $masuk_stk - $unit_btb_b;
		$akhir_akh	= $s_akhir_stk - $unit_btb_b;
		
		if($akhir_akh<$smin){
			$urg = "urgent";
		}else{
			$urg = "";
		}
		
		$upd_stk_b	= "UPDATE stock_barang SET masuk=$masuk_akh, s_akhir=$akhir_akh, ket='$urg' WHERE kode='$kode_b'";
		mysql_query($upd_stk_b);
		
		$sql_del	= "DELETE FROM btb WHERE no_btb='$no_btb'";
		$qry_del	= mysql_query($sql_del);
		
		if($qry_del){
			$a = 1;
		}else{
		
		}
	
	}else{
		$a = 2;
	}
	
	$hasil = array('confirm'=>$a);
	
	echo json_encode($hasil);


?>