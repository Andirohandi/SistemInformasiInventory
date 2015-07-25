<html>
<head><title>Selamat Datang di Sistem Inventory IWU</title></head>

<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css">
<script src="js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="js/jquery-ui.min.js"  type="text/javascript"></script>

<script>
function user(){
	var jp = (document.login.nama_program.value);
	var user = "";
	
	if(jp=="permintaan_pembelian"){
		user="Siti Rahmawati Ramadhani";
	}else if(jp=="pembelian_barang"){
		user="Haerini";
	}else if(jp=="penerimaan_barang"){
		user="Ejang Nurjaman";
	}else if(jp=="pengeluaran_barang"){
		user="Asti";
	}else if(jp=="data_arus_barang"){
		user="Irma Iryani";
	}else if(jp=="kontrol_arus"){
		user="Andi Rohandi";
	}else{
		user = "Aef";
	}
	document.login.username.value=user;
}

$(document).ready(function(){
  $("#title_login").click(function(){
    $("#conten_login").slideToggle("slow");
  });
});

//Balon
$(document).ready(function(){
  $("#header2 li").hover(
    function(){
       $(this).find("span").attr({
          "style": 'display:block'
       });
       $(this).find("span").animate({opacity: 1, bottom: "-35px"}, {queue:false, duration:700});
    }, 
    function(){
       $(this).find("span").animate({opacity: 0, top: "-80px"}, {queue:false, duration:400}, "linear",
       function(){
         $(this).find("span").attr({"style": 'display:none'}); 
       }
    );
  });
});

$(document).ready(function(){
  $("#title_login a").hover(
    function(){
       $(this).find("span").attr({
          "style": 'display:block'
       });
       $(this).find("span").animate({opacity: 1, bottom: "0px"}, {queue:false, duration:700});
    }, 
    function(){
       $(this).find("span").animate({opacity: 0, top: "-100px"}, {queue:false, duration:400}, "linear",
       function(){
         $(this).find("span").attr({"style": 'display:none'}); 
       }
    );
  });
});

//ONLOAD
$(document.body).append('<div id="page-loader"></div>');

$(window).on("beforeunload", function() {
    // ... tampilkan tabir animasi dengan efek `.fadeIn()`
    $('#page-loader').fadeIn(700).delay(10000).fadeOut(3000);
});

//Slide Badan
$(document).ready(function(){
	$(window).load(function(){
		$('#welcome').slideDown("slow");
		$("#gambar_overlay").fadeTo("normal",0.4);
	});
	$('.close').click(function(){
		$("#welcome").animate({opacity: 0, top: "-600px"}, {queue:false, duration:600});
		$("#gambar_overlay").fadeOut("slow").attr({"top":"100px"});
	});
});
</script>
<body>
<div id="badan">
	<div id="page-loader"></div>

	<div class="head">
		<div id="header1">
			<a href="index.php"><img src="image/logo.png"></a>
		</div>
		<div id="header2">
		</div>
	</div>
	<br/><br/><br/>
	<img src="image/kelalawar.gif" style="position:absolute;margin-left:1200px;" width="125" height="82" >
	<img src="image/lebah.gif" style="position:absolute;margin-top:150px;">
	<div id="flat">
		<?php
		include "isi/gedget/tanggal.php";
		echo custom_date();
		?>
	</div>
	<div id="flat2">
		<?php
		include "isi/gedget/jam.php";
		?>
	</div>
	<div id="flat5">

	</div>
	<br/><br/>
	<div id="welcome">
		<div id="head_w">
			<h3><span class="close">KELUAR</font></span></h3>
		</div>
		<br/>
		<span class='well'>TUGAS UAS OOAD & BASIS DATA</span>
		<br/>
		<span class='well'>MEMBUAT PROGRAM APLIKASI</span>
		<br/><br/>
		<span class='well'>Kelompok I</span>
		<br/>
		<span class='well'>Andi R, Ejang N, Haerini, Siti R</span>
		<br/><br/>
		<img src='image/logo.jpg' width='120'/>
		<br/><br/>
		<span class='well'>INTERNATIONAL WOMEN UNIVERSITY</span>
		<br/>
		<span><i>Jl. Ahmad Yani No 19 - 20 Bandung</i></span>
		<br/>
		<span class='well'>2014</span>
		<br/>
	</div>
	
	<div id="gambar_overlay"></div>
	<div id="title_login">
		<a href="#"><img src="image/login2.png" width="200px"><span></span></a>
	</div>
	<div id="conten_login">
		<form name="login" id="login" action="isi/login.php" method="POST">
			<table style="margin:20px auto;">
				<tr>
					<td><select name="nama_program" id="nama_program" class="select_L" onchange="user()">
						<option value="">---Pilih Program---</option>
						<option value="permintaan_pembelian">Divisi Inventory</option>
						<option value="pembelian_barang">Divisi Purchasing</option>
						<option value="penerimaan_barang">Divisi Warehouse 1</option>
						<option value="pengeluaran_barang">Divisi Warehouse 2</option>
						<option value="data_arus_barang">Divisi Physycal Inv</option>
						<option value="produksi">Divisi Produksi</option>
						<option value="kontrol_arus">Admin</option>
					</select></td>
					</tr>
					<tr>
					<td>
						<input type="text" name="username" id="username" class="input_L" placeholder="User" readonly />
					</td>
					</tr>
					<tr>
					<td>
						<input type="password" name="password" id="password" class="input_L" placeholder="Masukkan Password" />
					</td>
					</tr>
					<tr>
					<td height="50"></td>
					</tr>
					<tr>
					<td align="center"><input type="image" name="log_in" id="log_in" src="image/login.png" /></td>
				</tr>
			</table>
			<br/>
			<br/>
			<center><small><font color="grey">@Copyright 2014<br/><a href="">Kelompok</a> | Teknik Informatika</font></small></center>
		</form>
	</div>
	<br/><br/>
	<div id="flat3">

	</div>
	<div id="flat4">
	</div>
	<div id="flat6">

	</div>
	<br/>
	<hr/>
	<?php include "footer2.php";?>
</div>
</body>
</html>