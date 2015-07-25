<?php
function custom_date(){
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
	echo $day.', '.$date.'-'.$month.'-'.$year;
}

function tanggal(){
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
		case "01": $month = "Jan";	break;
		case "02": $month = "Feb";	break;
		case "03": $month = "Mar";	break;
		case "04": $month = "Apr";	break;
		case "05": $month = "Mei";		break;
		case "06": $month = "Jun";		break;
		case "07": $month = "Jul";		break;
		case "08": $month = "Agus";	break;
		case "09": $month = "Sep";break;
		case "10": $month = "Okt";	break;
		case "11": $month = "Nov";	break;
		case "12": $month = "Des";	break;
		default	: $month  = "error"; break;
	}
	echo $date.'-'.$month.'-'.$year;

}
?>


