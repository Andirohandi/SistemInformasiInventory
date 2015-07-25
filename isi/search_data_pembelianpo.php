<?php
	include "../koneksi.php";
	$term = $_POST['term'];
	
	$sql = "SELECT * FROM po WHERE no_po LIKE '%$term%' OR no_ppb LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%' OR tgl_po LIKE '%$term%'";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$result = array();
	$i = 0;
	if($num>0){
		while($row=mysql_fetch_assoc($qry)){
			$result[$i] = array(
			'no_po' => $row['no_po'],
			'supplier' => $row['supplier'],
			'no_ppb' => $row['no_ppb'],
			'kode' => $row['kode'],
			'kodebb' => $row['kodebb'],
			'packing' => $row['packing'],
			'sat' => $row['sat'],
			'unit' => $row['unit'],
			'hrg_sat' => $row['hrg_sat'],
			'hrg_total' => $row['hrg_total'],
			'tgl_po' => $row['tgl_po'],
			'tgl_kirim' => $row['tgl_kirim'],
			'attn' => $row['attn'],
			'po_untuk' => $row['po_untuk'],
			'kirim_ke' => $row['kirim_ke'],
			'kategori' => $row['kategori'],
			'ket' => $row['ket']
			);
			$i++;
		}
	}
	echo json_encode($result);
?>