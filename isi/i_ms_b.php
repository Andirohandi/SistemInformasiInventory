<?php 
include "../koneksi.php";
	$id 		= $_POST['id2'];
	$kode 		= $_POST['kode2'];
	$kodebb 	= $_POST['kodebb2'];
	$packing 	= $_POST['packing2'];
	$sat 		= $_POST['sat2'];
	$hrg_sat 	= $_POST['hrg_sat2'];
	$smin		= $_POST['smin2'];
	$rop 		= $_POST['rop2'];
	$smax 		= $_POST['smax2'];
	$supplier 	= $_POST['supplier2'];
	$LT			= $_POST['LT2'];
	$kategori 	= $_POST['kategori2'];
	$ket 		= $_POST['ket2'];
	
	if(isset($_POST['simpan'])){
		$sim	= "SELECT * FROM master_barang WHERE kode='$kode'";
		$qsim	= mysql_query($sim);
		$qnum	= mysql_num_rows($qsim);
		
		if($qnum > 0){
			echo "<script>alert('Master Sudah Ada');window.history.go(-1);</script>";
		}else{
			if($kode=="" OR $kodebb=="" OR $sat=="" OR $packing=="" OR $supplier=="" OR $smin=="" OR $rop=="" OR $smax=="" OR $LT==""){
				echo "<script>alert('Maaf! Data belum lengkap');history.go(-1);</script>";
			}else{
				
				$sql = "INSERT into master_barang(id, kode, kodebb, packing, sat, hrg_sat, smin, rop, smax, supplier, LT, kategori, ket) values('".$id."', '".$kode."','".$kodebb."','".$packing."','".$sat."','".$hrg_sat."','".$smin."','".$rop."','".$smax."','".$supplier."','".$LT."','".$kategori."','".$ket."')";
				$qry = mysql_query($sql);
				
				if($qry){
					$sql_s = "INSERT INTO stock_barang(kode, kodebb, packing, sat, smin, rop, smax, kategori) values('".$kode."', '".$kodebb."', '".$packing."', '".$sat."', '".$smin."', '".$rop."', '".$smax."', '".$kategori."')";
					mysql_query($sql_s);
					
					echo "<script>alert('Data Berhasil Disimpan');window.location='input_master_barang.php'</script>";
				}else{
					
				}
			}
		}
	}else if(isset($_POST['perbarui'])){
		$sql = "SELECT * FROM master_barang WHERE id=$id";
		$qry = mysql_query($sql);
		$num = mysql_num_rows($qry);
		
		if($num>0){
			$upd	= "UPDATE master_barang SET kode='$kode', kodebb='$kodebb', packing='$packing', sat=$sat, isi=$isi, hrg_sat=$hrg_sat, smin=$smin, rop=$rop, smax=$smax, supplier='$supplier', LT='$LT', kategori='$kategori', ket='$ket' WHERE id='$id'";
			mysql_query($upd);
			
			echo "<script>alert('Data berhasil diperbarui');window.location='input_master_barang.php';</script>";
			
		}else{
			echo "<script>alert('Maaf! Data yang anda ingin Perbarui belum tersedia di data base kami.');window.history.go(-1);</script>";
		}
	}else if(isset($_POST['batal'])){
		header('location: input_master_barang.php');
	}else{
		header('location: pembelian_barang.php');
}

?>