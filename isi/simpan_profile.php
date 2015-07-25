<?php
	include "../koneksi.php";
	$username 		= $_POST['username'];
	$nama 		= $_POST['nama'];
	$jk 		= $_POST['jk'];
	$agama 		= $_POST['agama'];
	$no_telp 	= $_POST['no_telp'];
	$email 		= $_POST['email'];
	$ket 		= $_POST['ket'];
	$alamat 	= $_POST['alamat'];
	$pass 		= $_POST['pass'];
	$password 	= $_POST['password'];
	$password_n = $_POST['password_n'];
	$hasil = array();
	
	$sql = "SELECT * FROM profile WHERE username='$username' and password='$password_n'";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	
	if($num>0){
		if($pass==$password){
			if($password==""){
				$pa = $password_n;
			}else{
				$pa = $password;
			}
			
			$upd = "UPDATE profile SET password='$pa', nama='$nama', no_telp='$no_telp', email='$email', jk='$jk', agama='$agama', alamat='$alamat', jabatan='$jabatan', ket='$ket' WHERE username='$username'";
			$qry = mysql_query($upd);
			if($qry){
				$a = 1;
			}else{
				$a = 4;
			}
		}else{
			$a = 3;
		}
	}else{
		$a = 2;
	}
	
	$hasil = array('confirm'=>$a);
	echo json_encode($hasil);
?>