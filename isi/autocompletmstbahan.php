<?php
	include "../koneksi.php";
	$kode = trim(strip_tags($_GET['term']));
	$sql = "SELECT * FROM master_barang WHERE kode LIKE '%".$kode."%' and kategori='Bahan Baku' LIMIT 10 ";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$hasil = array();
	$no = 0;
	while($row = mysql_fetch_assoc($qry)){
		$hasil[$no] = $row['kode'];
		$no++;
	}
	echo json_encode($hasil);
?>