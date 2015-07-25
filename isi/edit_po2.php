<?php
	include "../koneksi.php";
	
	$id_nm		= $_POST['id_nm'];
	$no_po		= $_POST['no_po'];
	$supplier	= $_POST['supplier'];
	$no_ppb		= $_POST['no_ppb'];
	$kode		= $_POST['kode'];
	$kodebb		= $_POST['kodebb'];
	$packing	= $_POST['packing'];
	$sat		= $_POST['sat'];
	$unit		= $_POST['unit'];
	$hrg_sat	= $_POST['hrg_sat'];
	$hrg_total	= $_POST['hrg_total'];
	$tgl_po		= $_POST['tgl_po'];
	$tgl_kirim	= $_POST['tgl_kirim'];
	$sisa_po	= $_POST['unit'];
	$attn		= $_POST['attn'];
	$po_untuk	= $_POST['po_untuk'];
	$kirim_ke	= $_POST['kirim_ke'];
	$kategori	= $_POST['kategori'];
	$ket		= $_POST['ket'];
	
	$sql_update = "SELECT * FROM po WHERE no_po='$no_po'";
	$qry_update = mysql_query($sql_update);
	$num_update = mysql_num_rows($qry_update);
	
	if($num_update>0){
		//====ambil no_po di ppb sebelum diupdate
		$sql_ppb 	= "SELECT * FROM po WHERE no_po='$no_po'";
		$qry_ppb	= mysql_query($sql_ppb);
		$row_ppb	= mysql_fetch_assoc($qry_ppb);
		$no_po_ppb	= $row_ppb['no_ppb'];
		$no_po_ks	= "";
		
		$upd_po	= "UPDATE ppb SET no_po='$no_po_ks' WHERE no_ppb='$no_po_ppb'";
		mysql_query($upd_po);
		
		if($no_ppb == "" OR $unit == "" OR $tgl_kirim == ""){
			$h = 3;
			$hasil = array('confirm'=>$h);//
		}else{
			$sql = "UPDATE po SET supplier='$supplier', no_ppb='$no_ppb', kode='$kode', kodebb='$kodebb', packing='$packing', sat=$sat, unit=$unit, hrg_sat=$hrg_sat, hrg_total=$hrg_total, tgl_po='$tgl_po', tgl_kirim='$tgl_kirim', sisa_po=$unit, attn='$attn', po_untuk='$po_untuk', kirim_ke='$kirim_ke', ket='$ket' WHERE no_po='$no_po' ";
			$qry = mysql_query($sql);
			
			if($qry){
				//UPDATE NO PO untu data PPB
				$upd = "UPDATE ppb set no_po='".$no_po."' WHERE no_ppb='".$no_ppb."'";
				mysql_query($upd);

				$h = 1;
				$hasil = array('confirm'=>$h);//Berhasil disimpan
			}
			else{
				
			}
		}
	}else{
		$d = 4;
		$hasil = array('confirm'=>$d);
	}
	
	echo json_encode($hasil);
?>