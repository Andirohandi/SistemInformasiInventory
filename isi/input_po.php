<?php
include "../koneksi.php";
if(isset($_POST['simpan'])){
	
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
 
	if($no_ppb==null or $unit==null or $tgl_kirim==null or $supplier==null or $attn==null or $po_untuk==null or $kirim_ke==null){
		echo "<script>alert('Maaf Data yang anda masukkan belum lengkap');window.history.go(-1);</script>";
	}else{
		$simpan = "INSERT into po(id_nm,no_po,supplier,no_ppb,kode,kodebb,packing,sat,unit,hrg_sat,hrg_total,tgl_po,tgl_kirim,sisa_po,attn,po_untuk,kirim_ke,kategori,ket) values('".$id_nm."','".$no_po."','".$supplier."','".$no_ppb."','".$kode."','".$kodebb."','".$packing."','".$sat."','".$unit."','".$hrg_sat."','".$hrg_total."','".$tgl_po."','".$tgl_kirim."','".$sisa_po."','".$attn."','".$po_untuk."','".$kirim_ke."','".$kategori."','".$ket."')";
		
		$qrsimpan = mysql_query($simpan);
		
		if($qrsimpan){ 
			//UPDATE NO PO untu data PPB
			$upd = "UPDATE ppb set no_po='".$no_po."' WHERE no_ppb='".$no_ppb."'";
			mysql_query($upd);
			echo "<script>alert('Data Berhasil Disimpan');window.location='buka_pembelianpo.php';</script>";
		}else{
			echo "<script>alert('Klik Perbarui untuk menyimpan hasil edit');history.go(-1);</script>";
		}
	}
}else if(isset($_POST['perbarui'])){

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
			echo "<script>alert('Maaf! Data yang ingin anda perbarui, belum lengkap!');window.history.go(-1);</script>";
		}else{
			$sql = "UPDATE po SET supplier='$supplier', no_ppb='$no_ppb', kode='$kode', kodebb='$kodebb', packing='$packing', sat=$sat, unit=$unit, hrg_sat=$hrg_sat, hrg_total=$hrg_total, tgl_po='$tgl_po', tgl_kirim='$tgl_kirim', sisa_po=$unit, attn='$attn', po_untuk='$po_untuk', kirim_ke='$kirim_ke', ket='$ket' WHERE no_po='$no_po' ";
			$qry = mysql_query($sql);
			
			if($qry){
				//UPDATE NO PO untu data PPB
				$upd = "UPDATE ppb set no_po='".$no_po."' WHERE no_ppb='".$no_ppb."'";
				mysql_query($upd);
				
				
				echo "<script>alert('Data Berhasil Diperbarui');window.location='buka_pembelianpo.php';</script>";
			}
			else{
				echo "<script>alert('Maaf! Data Gagal Perbarui');history.go(-1);</script>";
			}
		}
	}else{
		echo "<script>alert('Maaf! Data yang ingin anda perbarui belum tersedia dalam databae kami. Silahkan \'SIMPAN\' data anda terlebih dahulu');window.history.go(-1);</script>";
	}
	
}else if(isset($_POST['batal'])){
	$no_po = $_POST['no_po'];
	
	$pilih = "SELECT * FROM po WHERE no_po='$no_po'";
	$pilihqry = mysql_query($pilih);
	$jml = mysql_num_rows($pilihqry);
	if($jml>0){
		$sql = "DELETE FROM po WHERE no_po='$no_po'";
		$qry = mysql_query($sql);
		
			if($qry){
				echo "<script>alert('Data Berhasil Dibatalkan dan Dihapus');window.location='buka_pembelianpo.php';</script>";
			}
		}else{
			echo "<script>alert('Maaf! Data gagal dihapus. No PO belum tersedia di database');history.go(-1);</script>";
		}
	
}else if(isset($_POST['cetak'])){
	$id_cetak 	= $_POST['id_cetak'];
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
	$attn		= $_POST['attn'];
	$po_untuk	= $_POST['po_untuk'];
	$kirim_ke	= $_POST['kirim_ke'];
	$kategori	= $_POST['kategori'];
	$ket		= $_POST['ket'];
 
	$simpan = "INSERT into cetak_po(id_cetak,id_nm,no_po,supplier,no_ppb,kode,kodebb,packing,sat,unit,hrg_sat,hrg_total,tgl_po,tgl_kirim,attn,po_untuk,kirim_ke,kategori,ket) values('".$id_cetak."','".$id_nm."','".$no_po."','".$supplier."','".$no_ppb."','".$kode."','".$kodebb."','".$packing."','".$sat."','".$unit."','".$hrg_sat."','".$hrg_total."','".$tgl_po."','".$tgl_kirim."','".$attn."','".$po_untuk."','".$kirim_ke."','".$kategori."','".$ket."')";
	
	$qrsimpan = mysql_query($simpan);
	if($qrsimpan){ 
		echo "<script>window.open('cetak_po.php', 'popupwindow', 'width=700,height=700');history.go(-1);</script>";
	}else{
		echo "<script>alert('Refresh terlebih dahulu untuk mencetak ulang');window.location='buka_pembelianpo.php';</script>";
	}
	
}else if(isset($_POST['datapo'])){
	header ('location: data_pembelianpo.php');
	
	
}else if(isset($_POST['keluar'])){
	header ('location: pembelian_barang.php');
	
	
}else{
	header ('location: buka_pembelianpo.php');
}

?>