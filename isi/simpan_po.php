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
 
	if($no_ppb=="" or $unit=="" or $tgl_kirim=="" or $supplier=="" or $attn=="" or $po_untuk=="" or $kirim_ke==""){
		$h = 3;
		$hasil = array('confirm'=>$h);//
	}else{
		$simpan = "INSERT into po(id_nm,no_po,supplier,no_ppb,kode,kodebb,packing,sat,unit,hrg_sat,hrg_total,tgl_po,tgl_kirim,sisa_po,attn,po_untuk,kirim_ke,kategori,ket) values('".$id_nm."','".$no_po."','".$supplier."','".$no_ppb."','".$kode."','".$kodebb."','".$packing."','".$sat."','".$unit."','".$hrg_sat."','".$hrg_total."','".$tgl_po."','".$tgl_kirim."','".$sisa_po."','".$attn."','".$po_untuk."','".$kirim_ke."','".$kategori."','".$ket."')";
		
		$qrsimpan = mysql_query($simpan);
		
		if($qrsimpan){ 
			//UPDATE NO PO untu data PPB
			$upd = "UPDATE ppb set no_po='".$no_po."' WHERE no_ppb='".$no_ppb."'";
			mysql_query($upd);
			
			$h = 1;
			$hasil = array('confirm'=>$h);//Berhasil disimpan
			
		}else{
			$h = 2;
			$hasil = array('confirm'=>$h);//Klik Perbarui
		}
	}
	echo json_encode($hasil);
?>