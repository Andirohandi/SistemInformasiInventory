<?php
include "../koneksi.php";
	
	$term = $_POST['term'];
	
	$sql = "SELECT * FROM ppb WHERE no_ppb LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%'";
	$qry = mysql_query($sql);
	$num_rows = mysql_num_rows($qry); // jika kode D0, num_rows = 5

	$items = 5;
	$page_amount = ceil($num_rows/$items); // 5 dibagi 2 = 3 (dibulatkeun)
	$page_amount = $page_amount - 1; // 3 - 1 = 2
	$page = ($_POST['p']) ? $_POST['p'] : 0;

	if($page < 1) $page = 0;
	$page_num = $items * $page;
	
	$sql = "SELECT * FROM ppb WHERE no_ppb LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%' LIMIT $page_num, $items";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	$hasil = array();
	
	/*
	$result = mysql_query("SELECT * FROM ppb WHERE no_ppb LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%' LIMIT $page_num, $items");
	$num_rows = mysql_num_rows($result);
	*/
	
	$no = 0;
	if($num_rows > 0){
		while($row = mysql_fetch_assoc($result)){
			$hasil[$no] = array(
				'no_ppb' 	=> $row['no_ppb'],
				'kode' 		=> $row['kode'],
				'kodebb' 	=> $row['kodebb'],
				'sat' 		=> $row['sat'],
				'unit' 		=> $row['unit'],
				'tonage' 	=> $row['tonage'],
				'tgl_ppb' 	=> $row['tgl_ppb'],
				'jthtmpo_ppb' => $row['jthtmpo_ppb'],
				'no_po' 	=> $row['no_po'],
				'kategori' 	=> $row['kategori'],
				'ket' 		=> $row['ket']									
			);
			$no++;
		}
	}
	$data = array(
		'hasil'			=> json_encode($hasil),
		'page_amount'	=> $page_amount,
		'page'			=> $page
	);
	//echo array(json_encode($hasil), $page_amount, $page);
	echo json_encode($data);
?>