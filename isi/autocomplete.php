<?php
include "../koneksi.php";

$kode = trim(strip_tags($_GET['term']));
$sql = "SELECT * FROM master_barang WHERE kode LIKE '%".$kode."%' LIMIT 10";
$qry = mysql_query($sql);
$arr_json_row = array();
$i = 0;
while($row = mysql_fetch_assoc($qry)){
	$arr_json_row[$i] = $row['kode'];
	$i++;
}
echo json_encode($arr_json_row);
?>
