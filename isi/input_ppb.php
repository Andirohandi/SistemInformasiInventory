<?php
include "../koneksi.php";

if(isset($_POST['simpan'])){
	
	$id_nm		= $_POST['id_nm'];
	$no_ppb	 	= $_POST['no_ppb'];
	$kode 		= $_POST['kode'];
	$kodebb 	= $_POST['kodebb'];
	$packing	= $_POST['packing'];
	$sat 		= $_POST['sat'];
	$unit 		= $_POST['unit'];
	$tonage		= $_POST['tonage'];
	$tgl_ppb 	= $_POST['tgl_ppb'];
	$jthtmpo_ppb= $_POST['jthtmpo_ppb'];
	$hrg_sat	= $_POST['hrg_sat'];
	$kategori 	= $_POST['kategori'];
	$ket 		= $_POST['ket'];
	
	if($kode==null or $unit==null or $jthtmpo_ppb==null){
		echo "<script>alert('Maaf!! Anda harus melengkapi data yang akan disimpan');history.go(-1);</script>";
	}else{
	$simpan = "INSERT into ppb(id_nm,no_ppb,kode,kodebb,packing,sat,unit,tonage,tgl_ppb,jthtmpo_ppb,hrg_sat,kategori,ket) values('".$id_nm."','".$no_ppb."','".$kode."','".$kodebb."','".$packing."','".$sat."','".$unit."','".$tonage."','".$tgl_ppb."','".$jthtmpo_ppb."','".$hrg_sat."','".$kategori."','".$ket."')";
	$qrsimpan = mysql_query($simpan);
	
	if($qrsimpan){
		echo "<script>alert('Data Berhasil Disimpan');window.location='buka_permintaan.php';</script>";
	}else{
		echo "<script>alert('Klik Perbarui untuk Menyimpan Hasil Edit ');history.go(-1);</script>";
	}
	}
}else if(isset($_POST['perbarui'])){

	$no_ppb		= trim($_POST['no_ppb']);
	$kode		= trim($_POST['kode']);
	$kodebb		= trim($_POST['kodebb']);
	$packing	= trim($_POST['packing']);
	$sat		= trim($_POST['sat']);
	$tgl_ppb	= trim($_POST['tgl_ppb']);
	$hrg_sat	= trim($_POST['hrg_sat']);
	$unit 		= trim($_POST['unit']);
	$tonage		= trim($_POST['tonage']);
	$jthtmpo_ppb= trim($_POST['jthtmpo_ppb']);
	$kategori 	= trim($_POST['kategori']);
	$ket 		= trim($_POST['ket']);
	
	$sql_update = "SELECT * FROM ppb WHERE no_ppb='$no_ppb'";
	$qry_update = mysql_query($sql_update);
	$num_update = mysql_num_rows($qry_update);
	
	if($num_update>0){
		if($no_ppb == "" OR $unit == "" OR $jthtmpo_ppb == ""){
			echo "<script>alert('Maaf! Data yang ingin anda perbarui, belum lengkap!');window.history.go(-1);</script>";
		}else{
			$sql = "UPDATE ppb SET kode='$kode', kodebb='$kodebb', packing='$packing', sat=$sat, unit=$unit, tonage=$tonage, tgl_ppb='$tgl_ppb', jthtmpo_ppb='$jthtmpo_ppb', hrg_sat=$hrg_sat, kategori='$kategori', ket='$ket' WHERE no_ppb='$no_ppb'";
			$qry = mysql_query($sql);
			
			if($qry){
				echo "<script>alert('Data Berhasil Diperbarui');window.location='buka_permintaan.php';</script>";
			}else{
				echo "<script>alert('Maaf! Data gagal diperbarui');history.go(-1);</script>";
			}
		}
	}else{
		echo "<script>alert('Maaf! Data yang ingin anda perbarui belum tersedia dalam databae kami. Silahkan \'SIMPAN\' data anda terlebih dahulu');window.history.go(-1);</script>";
	}
}else if(isset($_POST['batal'])){
	date_default_timezone_set("Asia/Jakarta");
	
	$no_ppb 	= $_POST['no_ppb'];
	$kode 		= $_POST['kode'];
	$kodebb 	= $_POST['kodebb'];
	$packing	= $_POST['packing'];
	$sat 		= $_POST['sat'];
	$unit 		= $_POST['unit'];
	$tonage		= $_POST['tonage'];
	$tgl_ppb 	= $_POST['tgl_ppb'];
	$jthtmpo_ppb= $_POST['jthtmpo_ppb'];
	$hrg_sat	= $_POST['hrg_sat'];
	$kategori 	= $_POST['kategori'];
	$status		= "Batal";
	$tgl_ppb_batal = date("d M Y");
	$ket 		= $_POST['ket'];
	
	if($kode==null or $unit==null or $jthtmpo_ppb==null){
		echo "<script>alert('Maaf!! No PPB yang anda maksud tidak tersedia di database');history.go(-1);</script>";
	}else{
		$sql = "DELETE FROM ppb WHERE no_ppb='".$no_ppb."' and kode='".$kode."'";
		$qry = mysql_query($sql);
		
		
		$inp_batal = "INSERT INTO ppb_batal(no_ppb, kode, kodebb, packing, sat, unit, tonage, tgl_ppb, jthtmpo_ppb, hrg_sat, kategori, status, tgl_ppb_batal, ket) values('".$no_ppb."','".$kode."','".$kodebb."','".$packing."','".$sat."','".$unit."','".$tonage."','".$tgl_ppb."','".$jthtmpo_ppb."','".$hrg_sat."','".$kategori."', '".$status."', '".$tgl_ppb_batal."', '".$ket."')";
		$qry_btl = mysql_query($inp_batal);
		
		
		if($qry){
			echo "<script>alert('Data Berhasil Dihapus');window.location='buka_permintaan.php';</script>";
		}else{
			echo "<script>alert('Maaf ! Data Gagal Dihapus');window.location='buka_permintaan.php';</script>";
		}
		
	}
}else if(isset($_POST['cetak'])){
	$id_cetak 	= $_POST['id_cetak'];
	$no_ppb 	= $_POST['no_ppb'];
	$kode 		= $_POST['kode'];
	$kodebb 	= $_POST['kodebb'];
	$sat 		= $_POST['sat'];
	$unit 		= $_POST['unit'];
	$tgl_ppb 	= $_POST['tgl_ppb'];
	$jthtmpo_ppb= $_POST['jthtmpo_ppb'];
	$kategori 	= $_POST['kategori'];
	$ket 		= $_POST['ket'];
	
	//echo "$id_cetak, $no_ppb, $kode, $kodebb, $sat, $unit, $tgl_ppb, $jthtmpo_ppb, $kategori, $ket";
	$sql = "INSERT into cetak_ppb(id_cetak,no_ppb,kode,kodebb, sat,unit,tgl_ppb,jthtmpo_ppb,kategori,ket) values('".$id_cetak."','".$no_ppb."','".$kode."','".$kodebb."','".$sat."','".$unit."','".$tgl_ppb."','".$jthtmpo_ppb."','".$kategori."','".$ket."')";
	
	$qry = mysql_query($sql);
	
	if($qry){
		echo "<script type='text/javascript'>window.open('cetak_ppb.php', 'popupwindow', 'width=700,height=700');history.go(-1);</script>";
	}else{
		echo "Data Gagal Diinput";
	}
	
	
}else if(isset($_POST['datappb'])){
	header ('location: data_permintaan.php');
	
	
}else if(isset($_POST['refresh'])){
	header ('location: buka_permintaan.php');

}else{
	header ('location: permintaan_pembelian.php');
}

?>