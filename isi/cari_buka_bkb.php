<?php
include "../koneksi.php";

$search = $_POST['search'];

$sql = "SELECT * FROM bkb WHERE no_bkb='".$search."'";
$qry = mysql_query($sql);
$jml = mysql_num_rows($qry);
$no = 0;

if($jml>0){
	$row=mysql_fetch_assoc($qry);
	$no = array(
		'no_bkb'		=> $row['no_bkb'],
		'tgl_bkb'		=> $row['tgl_bkb'],
		'klr_ke'		=> $row['klr_ke'],
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