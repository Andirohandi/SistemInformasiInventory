<?php
include "../koneksi.php";

$kode = trim(strip_tags($_GET['term']));
$sql = "SELECT * FROM ppb WHERE no_ppb LIKE '%".$kode."%' and no_po=''";
$qry = mysql_query($sql);
$arr_jason_row = array();
$i = 0;
while($row = mysql_fetch_assoc($qry)){
	$arr_jason_row[$i] = $row['no_ppb'];
	$i++;
}
echo json_encode($arr_jason_row);
?>