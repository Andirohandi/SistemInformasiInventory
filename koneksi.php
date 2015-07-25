<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "stok_barang";

$connect = mysql_connect($server, $user, $pass);
mysql_select_db($db, $connect);

?>