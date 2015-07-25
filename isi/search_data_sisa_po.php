<?php
	include "../koneksi.php";
	$term = $_POST['term'];
	$e = 0;
	if($term!=''){
	$sql ="SELECT * FROM po WHERE no_po LIKE '%$term%' OR kode LIKE '%$term%' OR kodebb LIKE '%$term%'" ;
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$arr = array();
	$no = 0;
	
	if($num > 0){
		while($ROW = mysql_fetch_assoc($qry)){	
			$arr[$no] = array(
				'no_po' => $ROW['no_po'],
				'supplier' => $ROW['supplier'],
				'no_ppb' => $ROW['no_ppb'],
				'kode' => $ROW['kode'],
				'kodebb' => $ROW['kodebb'],
				'packing' => $ROW['packing'],
				'sat' => $ROW['sat'],
				'unit' => $ROW['unit'],
				'po_datang' => $ROW['po_datang'],
				'sisa_po' => $ROW['sisa_po'],
				'tgl_po' => $ROW['tgl_po'],
				'tgl_kirim' => $ROW['tgl_kirim'],
				'attn' => $ROW['attn'],
				'po_untuk' => $ROW['po_untuk'],
				'kirim_ke' => $ROW['kirim_ke'],
				'kategori' => $ROW['kategori'],
				'ket' => $ROW['ket']
			);
			$no++;
		}
	}
	echo json_encode($arr);
	}else{
	$sql = "SELECT * FROM po WHERE sisa_po > 0";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$arr = array();
	$no = 0;
	
	if($num > 0){
		while($ROW = mysql_fetch_assoc($qry)){	
			$arr[$no] = array(
				'no_po' => $ROW['no_po'],
				'supplier' => $ROW['supplier'],
				'no_ppb' => $ROW['no_ppb'],
				'kode' => $ROW['kode'],
				'kodebb' => $ROW['kodebb'],
				'packing' => $ROW['packing'],
				'sat' => $ROW['sat'],
				'unit' => $ROW['unit'],
				'po_datang' => $ROW['po_datang'],
				'sisa_po' => $ROW['sisa_po'],
				'tgl_po' => $ROW['tgl_po'],
				'tgl_kirim' => $ROW['tgl_kirim'],
				'attn' => $ROW['attn'],
				'po_untuk' => $ROW['po_untuk'],
				'kirim_ke' => $ROW['kirim_ke'],
				'kategori' => $ROW['kategori'],
				'ket' => $ROW['ket']
			);
			$no++;
		}
	}
	echo json_encode($arr);
	}
?>