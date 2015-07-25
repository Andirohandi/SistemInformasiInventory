<?php
	include "../koneksi.php";
	
	$username = $_POST['i'];
	
	$sql = "SELECT * FROM profile WHERE username='$username'";
	$qry = mysql_query($sql);
	$hasil = array();
	
	$row = mysql_fetch_assoc($qry);
	
	$hasil = array(
		'username'	=> $row['username'],
		'password'	=> $row['password'],
		'nama'	=> $row['nama'],
		'no_telp'	=> $row['no_telp'],
		'email'	=> $row['email'],
		'jk'	=> $row['jk'],
		'agama'	=> $row['agama'],
		'alamat'	=> $row['alamat']
	);
	echo json_encode($hasil);
	
?>