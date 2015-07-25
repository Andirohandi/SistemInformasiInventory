<?php
	session_start();
	include "../koneksi.php";
	
	$username = $_SESSION['username'];
	
	$folder = "../profile/";
	
	if(!empty($_FILES['image']['tmp_name'])){
		
		$jns_gmb = $_FILES['image']['type'];
		
		if($jns_gmb=="image/jpeg" || $jns_gmb=="image/jpg" || $jns_gmb=="image/gif" || $jns_gmb=="image/x-png"){
		
			$gambar = $folder . basename($_FILES['image']['name']);
			if(move_uploaded_file($_FILES['image']['tmp_name'], $gambar)){
				$sql = "UPDATE profile SET image='$gambar' WHERE username='$username'";
				$qry = mysql_query($sql);
				
				echo"<script>window.history.go(-1);</script>";
			}else{
				"Gambar Gagal Dikirim";
			}
		}else{
			echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
		}
	}else{
		echo "Anda belum memilih gambar";
	}
?>