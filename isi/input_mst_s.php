<?php 
include "../koneksi.php";

if(isset($_POST['simpan'])){
	
	$supplier 	= $_POST['supplier'];
	$no_telp 	= $_POST['no_telp'];
	$email 		= $_POST['email'];
	$alamat 	= $_POST['alamat'];
	$attn 		= $_POST['attn'];
	$kategori 	= $_POST['kategori'];
	$ket 		= $_POST['ket'];
	
	if($supplier=="" OR $no_telp =="" OR $email =="" OR $alamat =="" OR $attn =="" OR $kategori ==""){
		echo "<script>alert('Maaf!! Data belum lengkap');window.history.go(-1);</script>";
	}else{
	
		$sql = "INSERT into master_supplier(supplier, no_telp, email, alamat, attn, kategori, ket) values('".$supplier."','".$no_telp."','".$email."','".$alamat."','".$attn."','".$kategori."','".$ket."')";
		$qry = mysql_query($sql);
		
		if($qry){
			echo "<script>alert('Data Berhasil Disimpan');window.location='input_master_supplier.php';</script>";
		}else{
			echo "bla bla bla";
		}
	
	}
}else{
	echo "<script>window.location='input_master_supplier.php';</script>";
}

?>