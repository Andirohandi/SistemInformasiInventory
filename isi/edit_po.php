<?php
	include "../koneksi.php";
	$term  = $_POST['term'];
	
	$sql = "SELECT * FROM po WHERE no_po='".$term."'";
	$qry = mysql_query($sql);
	$jmlh = mysql_num_rows($qry);
	$a = 0;
	
	if($jmlh>0){
		$row = mysql_fetch_assoc($qry);
		$a = array(
		'id_nm' 	=> $row['id_nm'],
		'no_po' 	=> $row['no_po'],
		'supplier' 	=> $row['supplier'],
		'no_ppb' 	=> $row['no_ppb'],
		'kode' 		=> $row['kode'],
		'kodebb' 	=> $row['kodebb'],
		'packing' 	=> $row['packing'],
		'sat' 		=> $row['sat'],
		'unit' 		=> $row['unit'],
		'hrg_sat' 	=> $row['hrg_sat'],
		'hrg_total' => $row['hrg_total'],
		'tgl_po' 	=> $row['tgl_po'],
		'tgl_kirim' => $row['tgl_kirim'],
		'attn' 		=> $row['attn'],
		'po_untuk' 	=> $row['po_untuk'],
		'kirim_ke' 	=> $row['kirim_ke'],
		'kategori' 	=> $row['kategori'],
		'ket' 		=> $row['ket']
		);
	
	}
	echo json_encode($a);
?>