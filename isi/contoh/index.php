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
		user="Effa Katrina";
	}else if(jp=="pembelian_barang"){
		user="Harry Gumilang";
	}else if(jp=="penerimaan_barang"){
		user="Reny Rizky";
	}else if(jp=="pengeluaran_barang"){
		user="Asti";
	}else if(jp=="data_arus_barang"){
		user="Irma Iryani";
	}else if(jp=="kontrol_arus"){
		user="Andi Rohandi";
	}else{
		user = "";
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
		$('#badan').hide("3000");
		$('#badan').show("3000");
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
			<ul>
				
				<li><a href="index.php"><img src="image/hoome.png" height="30px"><span>Beranda</span></a></li>
				<li><a href="profile.php"><img src="image/about.png" height="30px"><span style="display: block; opacity: 1; top: -40px;">Tentang Kami</span></a></li>
				<li><a href="help.php"><img src="image/help.png" height="30px"><span>Bantuan</span></a></li>
			</ul>
		</div>
	</div>
	<br/><br/><br/>
	<div id="flat">
		<?php
		include "isi/gedget/tanggal.php";
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

	<div id="title_login">
		<a href="#"><img src="image/login2.png" width="200px"><span></span></a>
	</div>
	<div id="conten_login">
		<form name="login" id="login" action="isi/login.php" method="POST">
			<table style="margin:20px auto;">
				<tr>
					<td><select name="nama_program" id="nama_program" class="select_L" onchange="user()">
						<option value="">---Pilih Program---</option>
						<option value="permintaan_pembelian">Permintaan Pembelian</option>
						<option value="pembelian_barang">Pembelian Barang</option>
						<option value="penerimaan_barang">Penerimaan Barang</option>
						<option value="pengeluaran_barang">Pengeluaran Barang</option>
						<option value="data_arus_barang">Data Arus Barang</option>
						<option value="kontrol_arus">Kontrol Arus Barang</option>
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
	<div id="footer">
		Persembahan dari kelompok 
		<br/>
		<br/>
		<br/>
	</div>
</div>
</body>
</html>