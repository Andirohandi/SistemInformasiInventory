<?php
include "../koneksi.php";

$jns_prod = $_POST['jns_prod'];

$sql = "SELECT * FROM master_produk WHERE nm_prod='".$jns_prod."'";
$qry = mysql_query($sql);
$jml = mysql_num_rows($qry);

$hasil = 0;
if($jml > 0){
	$row=mysql_fetch_assoc($qry);
		$hasil = array(
			'kode_jprod'	=> $row['kode_jprod'],
			'kodebb_jp'	=> $row['kodebb_jp']
		
		);
}
 echo json_encode($hasil);

?>