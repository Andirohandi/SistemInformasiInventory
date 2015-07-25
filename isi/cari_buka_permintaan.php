<?php
include "../koneksi.php";

$search = $_POST['search'];

$sql = "SELECT * FROM ppb WHERE no_ppb='".$search."' and no_po=''";
$qry = mysql_query($sql);
$jml = mysql_num_rows($qry);
$no = 0;

if($jml>0){
	$row=mysql_fetch_assoc($qry);
	$no = array(
		'no_ppb'		=> $row['no_ppb'],
		'tgl_ppb'		=> $row['tgl_ppb'],
		'kategori'		=> $row['kategori'],
		'ket'			=> $row['ket'],
		'id_nm'			=> $row['id_nm'],
		'kode'			=> $row['kode'],
		'kodebb'		=> $row['kodebb'],
		'sat'			=> $row['sat'],
		'unit'			=> $row['unit'],
		'tonage'		=> $row['tonage'],
		'jthtmpo_ppb'	=> $row['jthtmpo_ppb'],
		'packing'		=> $row['packing'],
		'hrg_sat'		=> $row['hrg_sat']
	);

}

echo json_encode($no);;
?>