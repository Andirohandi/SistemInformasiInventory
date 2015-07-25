<?php 
include "../koneksi.php";

$no_ppb = $_POST['no_ppb'];

$sql = "SELECT * FROM ppb WHERE no_ppb = '".$no_ppb."'";
$qry = mysql_query($sql);
$num = mysql_num_rows($qry);
$result = 0;

if($num > 0){
	$row = mysql_fetch_assoc($qry);
	$result = array(
	'kode' 		=> $row['kode'],
	'kodebb'	=> $row['kodebb'],
	'packing'	=> $row['packing'],
	'sat'		=> $row['sat'],
	'hrg_sat'	=> $row['hrg_sat'],
	'kategori' 	=> $row['kategori']
	
	);
}

echo json_encode($result);

?>