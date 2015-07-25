<?php 
	include "../koneksi.php";
	$term = $_POST['term'];
	$sql = "SELECT * FROM ppb WHERE (no_ppb LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%') and no_po = ''";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	
	$hasil = array();
	$i = 0;
	if($num>0){
		while($row=mysql_fetch_assoc($qry)){
			$hasil[$i] = array(
				'no_ppb' 		=> $row['no_ppb'],
				'kode' 			=> $row['kode'],
				'kodebb' 		=> $row['kodebb'],
				'sat' 			=> $row['sat'],
				'unit' 			=> $row['unit'],
				'tonage' 		=> $row['tonage'],
				'tgl_ppb' 		=> $row['tgl_ppb'],
				'jthtmpo_ppb' 	=> $row['jthtmpo_ppb'],
				'no_po' 		=> $row['no_po'],
				'kategori' 		=> $row['kategori'],
				'ket' 			=> $row['ket']
			);
			$i++;
		}
	}
	echo json_encode($hasil);
?>