
<?php
	include "../koneksi.php";
	$term = $_POST['term'];
	if($term!=''){
	$sql = "SELECT * FROM stock_barang WHERE ket ='urgent' and kode LIKE '%$term%' OR kodebb LIKE '%$term%' ";
	$qry = mysql_query($sql);
	$num_rows = mysql_num_rows($qry);
	$result = array();
	$i = 0;
	if($num_rows>0){
		while($row = mysql_fetch_assoc($qry)){
			$result[$i] = array(
			'kode' 		=> $row['kode'],
			'kodebb' 	=> $row['kodebb'],
			'sat' 		=> $row['sat'],
			's_akhir' 	=> $row['s_akhir'],
			'smin' 		=> $row['smin'],
			'st_smin' 		=> $row['st_smin'],
			'kategori' 	=> $row['kategori'],
			'ket' 		=> $row['ket']
			);
			$i++;
		}
	}
	echo json_encode($result);
	}else{
	$sql = "SELECT * FROM stock_barang WHERE ket ='urgent'";
	$qry = mysql_query($sql);
	$num_rows = mysql_num_rows($qry);
	$result = array();
	$i = 0;
	if($num_rows>0){
		while($row = mysql_fetch_assoc($qry)){
			$result[$i] = array(
			'kode' 		=> $row['kode'],
			'kodebb' 	=> $row['kodebb'],
			'sat' 		=> $row['sat'],
			's_akhir' 	=> $row['s_akhir'],
			'smin' 		=> $row['smin'],
			'st_smin' 		=> $row['st_smin'],
			'kategori' 	=> $row['kategori'],
			'ket' 		=> $row['ket']
			);
			$i++;
		}
	}
	echo json_encode($result);
	}
?>