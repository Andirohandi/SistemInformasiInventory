<?php
	include "../koneksi.php";
	
	$username 	= $_POST['username'];
	$nama 		= $_POST['nama'];
	$jk 		= $_POST['jk'];
	$agama 		= $_POST['agama'];
	$no_telp 	= $_POST['no_telp'];
	$email 		= $_POST['email'];
	$alamat 	= $_POST['alamat'];
	
	$upd = "UPDATE profile SET nama='$nama', no_telp='$no_telp', email='$email', jk='$jk', agama='$agama', alamat='$alamat', jabatan='$jabatan', ket='$ket' WHERE username='$username'";
	$qry = mysql_query($upd);
	if($qry){
		$a = 1;
	}else{
		$a = 4;
	}
	
	$hasil = array('confirm'=>$a);
	
	echo json_encode($hasil);
?>