<?php
	include "../koneksi.php";
	$term = $_POST['term'];
	
	$sql = "SELECT * FROM ppb_batal WHERE no_ppb LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%' OR tgl_ppb_batal LIKE '%$term%'";
	$qry = mysql_query($sql);
	$jml = mysql_num_rows($qry);
	$hasil = array();
	$i = 0;
	if($jml>0){
		while($row = mysql_fetch_assoc($qry)){
			$hasil[$i] = array(
			
			'no_ppb'		=> $row['no_ppb'],
			'kode'			=> $row['kode'],
			'kodebb'		=> $row['kodebb'],
			'sat'			=> $row['sat'],
			'unit'			=> $row['unit'],
			'tonage'		=> $row['tonage'],
			'tgl_ppb'		=> $row['tgl_ppb'],
			'jthtmpo_ppb'	=> $row['jthtmpo_ppb'],
			'kategori'		=> $row['kategori'],
			'tgl_ppb_batal'	=> $row['tgl_ppb_batal'],
			'ket'			=> $row['ket']
			);
			$i++;
		}
	}
	echo json_encode($hasil);
?>