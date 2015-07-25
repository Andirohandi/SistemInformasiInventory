<?php
	include "../koneksi.php";
	$term = $_POST['term'];
	$sql = "SELECT * FROM btb WHERE no_btb LIKE '%$term%' OR no_sj LIKE '%$term%' OR no_po LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%' ";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$hasil = array();
	$no = 0;
	
	if($num > 0){
		while($row = mysql_fetch_assoc($qry)){
			$hasil[$no] = array(
			'no_btb' 	=> $row['no_btb'],
			'no_sj' 	=> $row['no_sj'],
			'no_po' 	=> $row['no_po'],
			'kode' 		=> $row['kode'],
			'kodebb' 	=> $row['kodebb'],
			'packing' 	=> $row['packing'],
			'sat' 		=> $row['sat'],
			'unit' 		=> $row['unit'],
			'tonage' 	=> $row['tonage'],
			'tgl_btb' 	=> $row['tgl_btb'],
			'kategori' 	=> $row['kategori'],
			'ket' 		=> $row['ket']
			);
			$no++;
		}
	}
	echo json_encode($hasil);
?>