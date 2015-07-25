<?php
	include "../koneksi.php";
	
	$term = $_POST['term'];
	
	$sql = "SELECT * FROM btb WHERE no_btb LIKE '%$term%' OR no_sj LIKE '%$term%' OR no_po LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%'";
	$qry = mysql_query($sql);
	$jml = mysql_num_rows($qry);
	$result = array();
	$i = 0;
	if($jml>0){
		while($row = mysql_fetch_assoc($qry)){
			$result[$i] = array(
			'no_btb'	=> $row['no_btb'],
			'no_sj'		=> $row['no_sj'],
			'no_po'		=> $row['no_po'],
			'kode'		=> $row['kode'],
			'kodebb'	=> $row['kodebb'],
			'packing'	=> $row['packing'],
			'sat'		=> $row['sat'],
			'unit'		=> $row['unit'],
			'tonage'	=> $row['tonage'],
			'tgl_btb'	=> $row['tgl_btb'],
			'kategori'	=> $row['kategori'],
			'ket'	=> $row['ket']
			);
			$i++;
		}
	}
	echo json_encode($result);
?>