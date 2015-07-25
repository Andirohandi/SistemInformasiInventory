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

	if(isset($_POST['simpan'])){
		
		if($unit == '' or $no_po == ''){
			echo "<script>alert('Maaf, anda belum menginputkan jumlah barang yang datang');history.go(-1);</script>";
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
				echo "<script>alert('Data Berhasil disimpan !');window.location='input_terima_barang.php';</script>";
			}else{
				echo "<script>alert('Maaf! Data yang anda input telah tersedia di database. Silahkan klik \'Perbarui\' untuk melakukan pembaruan!');window.history.go(-1);</script>";
			}
		}
	}
	else if(isset($_POST['perbarui'])){
		$sql	= "SELECT * FROM btb WHERE no_btb='$no_btb'";
		$qry	= mysql_query($sql);
		$num	= mysql_num_rows($qry);
		
		if($num>0){
			if($no_po == "" OR $unit == ""){
				echo "<script>alert('Maaf! Data yang anda input belum lengkap');window.history.go(-1);</script>";
			}else{
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
				
				$masuk_akh	= $masuk_stk - $unit_btb_b;
				$akhir_akh	= $s_akhir_stk - $unit_btb_b;
				
				$upd_stk_b	= "UPDATE stock_barang SET masuk=$masuk_akh, s_akhir=$akhir_akh WHERE kode='$kode_b'";
				mysql_query($upd_stk_b);
				
				
				$sql_upd = "UPDATE btb SET no_sj='$no_sj', supplier='$supplier', no_po='$no_po', kode='$kode', kodebb='$kodebb', packing='$packing', sat=$sat, unit=$unit, tonage=$tonage, hrg_sat=$hrg_sat, hrg_total=$hrg_total, tgl_btb='$tgl_btb', kategori='$kategori', ket='$ket' WHERE no_btb='$no_btb'";
				$qry_upd = mysql_query($sql_upd);
				
				
				if($qry_upd){
					//======= UPDATE SISA PO
					$upd_po	= "SELECT * FROM po WHERE no_po = '$no_po' ";
					$qry_po	= mysql_query($upd_po);
					$row_po	= mysql_fetch_assoc($qry_po);
					$jml_po = $row_po['unit'];
					$btb_s  = $row_po['po_datang'];
					$sisa_po2  = $row_po['sisa_po'];
					
					$btb_a	= $btb_s + $unit;
					$sisa_po= $jml_po - $btb_a;
					
					$inp_s	= "UPDATE po SET po_datang=$btb_a, sisa_po=$sisa_po WHERE no_po = '$no_po'";
					mysql_query($inp_s);
					
					//======= INPUT KE STOK
					$inp_st	= "SELECT * FROM stock_barang WHERE kode='$kode'";
					$qry_st	= mysql_query($inp_st);
					$num_st	= mysql_num_rows($qry_st);
					
					if($num_st>0){
						$row_st	= mysql_fetch_assoc($qry_st);
						$s_awal	= $row_st['s_awal'];
						$masuk 	= $row_st['masuk'];
						$keluar	= $row_st['keluar'];
						$s_akhir= $row_st['s_akhir'];
						$smin= $row_st['smin'];
						$ket_s= $row_st['ket'];
						
						$masuk_r= $masuk + $unit;
						$akhir_r= $s_awal + $masuk_r - $keluar;
						
						if($akhir_r<$smin){
							$urg = "urgent";
						}else{
							$urg = "";
						}
						
						$upd_st	= "UPDATE stock_barang SET masuk=$masuk_r, s_akhir=$akhir_r, ket='$urg' WHERE kode='$kode'";
						mysql_query($upd_st);
					
					}else{
					
					}
					
					echo "<script>alert('Data berhasil diperbaharui');window.location='input_terima_barang.php';</script>";
				
				}else{
					echo "<script>alert('Maaf! Data tidak berhasil diperbaharui');window.history.go(-1);</script>";
				}
			}
		}else{
			echo "<script>alert('Maaf! Data yang ingin anda input belum tersedia');window.history.go(-1);</script>";
		}
	}else if(isset($_POST['batal'])){
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
				echo "<script>alert('Data berhasil dihapus dan dibatalkan');window.location='input_terima_barang.php';</script>";
			}else{
			
			}
		
		}else{
			echo "<script>alert('Maaf! Data yang ingin anda batalkan belum tersedia');window.history.go(-1);</script>";
		
		}
	
	
	}else if(isset($_POST['refresh'])){
		header('location:input_terima_barang.php');
	}else if(isset($_POST['databtb'])){
		header('location:data_penerimaan_barang.php');
	}else{
		header('location:penerimaan_barang.php');
	
	}
?>