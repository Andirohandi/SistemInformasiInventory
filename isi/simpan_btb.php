<?php
	include "../koneksi.php";

	$no_btb 	= $_POST['no_btb'];
	$tgl_btb 	= $_POST['tgl_btb'];
	$no_sj 		= $_POST['no_sj'];
	$no_po 		= $_POST['no_po'];
	$supplier 	= $_POST['supplier'];
	$kategori 	= $_POST['kategori'];
	$kode 		= $_POST['kode'];
	$kodebb 	= $_POST['kodebb'];
	$packing 	= $_POST['packing'];
	$sat 		= $_POST['sat'];
	$unit 		= $_POST['unit'];
	$tonage		= $sat * $unit;
	$hrg_sat 	= $_POST['hrg_sat'];
	$hrg_total 	= $_POST['hrg_total'];
	$ket 		= $_POST['ket'];
	
	if($unit == '' or $no_po == '' or $no_sj==''){
		$a = 3;
		$hasil = array('confirm'=>$a);
	}else{
	
		$ins = "INSERT into btb (no_btb, no_sj, supplier, no_po, kode, kodebb, packing, sat, unit, tonage, hrg_sat, hrg_total, tgl_btb, kategori, ket) values('".$no_btb."','".$no_sj."','".$supplier."','".$no_po."','".$kode."','".$kodebb."','".$packing."','".$sat."','".$unit."','".$tonage."','".$hrg_sat."','".$hrg_total."','".$tgl_btb."','".$kategori."','".$ket."')";
		$qryins = mysql_query($ins);
		
		//----- UPDATE PO
		$selpo = "SELECT * FROM po WHERE no_po = '$no_po' ";
		$qryselpo = mysql_query($selpo);
		$row = mysql_fetch_assoc($qryselpo);
		$unit_po 	= $row['unit'];
		$po_datang	= $row['po_datang'];
		$sisa_po 	= $row['sisa_po'];
		$hasil2 = $po_datang + $unit;
		$hasil = $unit_po - $hasil2;
		$updpo = "UPDATE po SET po_datang=$hasil2, sisa_po=$hasil WHERE no_po='$no_po' ";
		mysql_query($updpo);
		
		//-----UPDATE STOCK
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
		
		$updmasuk	= $masuk + $unit;
		$upds_akhir = $s_awal + $masuk - $keluar + $unit;
		
		if($upds_akhir<$smin){
			$urg = "urgent";
		}else{
			$urg = "";
		}
		
		$updstock = "UPDATE stock_barang SET masuk=$updmasuk, s_akhir=$upds_akhir, ket='$urg' WHERE kode='$kode'";
		mysql_query($updstock);
		
		if($qryins){
			$a = 1;
			$hasil = array('confirm'=>$a);
		}else{
			$a = 2;
			$hasil = array('confirm'=>$a);
		}
	}
	echo json_encode($hasil);
	
?>