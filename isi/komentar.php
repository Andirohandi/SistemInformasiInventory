<?php 
	session_start();
	include "../koneksi.php";
	include "fungsifungsi.php";
	
	date_default_timezone_set("Asia/Jakarta");

	$day	= date("l");
	$date	= date("d");
	$month	= date("m");
	$year	= date("Y");
	
	switch($day){
		case "Sunday": $day = "Minggu";break;
		case "Monday": $day = "Senin";	break;
		case "Tuesday": $day = "Selasa";break;
		case "Wednesday": $day = "Rabu";	break;
		case "Thursday": $day = "Kamis";	break;
		case "Friday": $day = "Jumat";	break;
		case "Saturday": $day = "Sabtu";	break;
		default	: $day  = "error";	break;
	}
	switch($month){
		case "01": $month = "Januari";	break;
		case "02": $month = "Februari";	break;
		case "03": $month = "Maret";	break;
		case "04": $month = "April";	break;
		case "05": $month = "Mei";		break;
		case "06": $month = "Juni";		break;
		case "07": $month = "Juli";		break;
		case "08": $month = "Agustus";	break;
		case "09": $month = "September";break;
		case "10": $month = "Oktober";	break;
		case "11": $month = "November";	break;
		case "12": $month = "Desember";	break;
		default	: $month  = "error"; break;
	}
	$waktu =  $day.', '.$date.'-'.$month.'-'.$year;
	
	$conpo = "SELECT id_k FROM komentar order by id_k desc LIMIT 1";
	$qrpo = mysql_query($conpo);
	$jmlpo = mysql_num_rows($qrpo);
	
	
	$id_k = 0;
	if($jmlpo>0){
		$b = mysql_fetch_assoc($qrpo);
		$c = $b['id_k'];
		$id_k = $c + 1;
	}else $id_k = 1;
	
	
	
	$pengirim 	= $_SESSION['username'];
	$id_nm		= $_POST['id_nm'];
	$komentar	= $_POST['komentar'];	
	
	$sql 	 = "INSERT INTO komentar values('$id_k', '$id_nm', '$waktu', '$komentar','$pengirim')";
	$qry	 = mysql_query($sql);
	
	if($qry){
		echo "<script>window.history.go(-1);</script>";
	}else{
		echo "Gagal";
	}

?>