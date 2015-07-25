<?php
	include "../koneksi.php";
	$sql = "SELECT * FROM ppb";
	$qry = mysql_query($sql);
	$num_rows = mysql_num_rows($qry);
	$hasil = array();
	
	$items = 5;
	$page_amount = ceil($num_rows/$items);
	$page_amount = $page_amount - 1;
	$page = ($_POST['p']) ? $_POST['p'] : 0;
	//$page = mysql_real_escape_string($_GET['p']);
	if($page < 1) $page = 0;
	$page_num = $items * $page;
	
	$result = mysql_query("SELECT * FROM ppb LIMIT $page_num, $items");
	$num_rows = mysql_num_rows($result);
	
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