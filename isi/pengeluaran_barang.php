<?php
session_start();

if(!isset($_SESSION['username'])){
	echo "<script>alert('Maaf Anda Harus Login Terlebih dahulu');
	window.location='../index.php';
	</script>";
}
include "gedget/tanggal.php";
include "fungsifungsi.php";
include "../koneksi.php";
?>
<html>
<head><title>Pengeluaran Barang | Sistem Inventory IWU</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script>
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
		var menu=$("#menu");
	menu.animate({height:'200px',opacity:'0.4'},"slow");
    menu.animate({width:'860px',opacity:'0.8'},"slow");
	});
	});

</script>
</script>
<body>
<div id="badan">
	<div id="page-loader"></div>

	<div class="head">
		<div id="header1">
			<a href="index.php"><img src="../image/logo.png"></a>
		</div>
		<div id="header2">
			<ul>
				
				<li><a href="../index.php"><img src="../image/hoome.png" height="30px"><span>Beranda</span></a></li>
				<li><a href="profile.php"><img src="../image/about.png" height="30px"><span style="display: block; opacity: 1; top: -40px;">Profile</span></a></li>
				<li><a href="help.php"><img src="../image/help.png" height="30px"><span>Bantuan</span></a></li>
			</ul>
		</div>
	</div>
	<br/><br/><br/>
	<div id="flat">
		<?php
		
		echo custom_date();
		?>
	</div>
	<div id="flat2">
		<?php
		include "gedget/jam.php";
		?>
	</div>
	<div id="flat5">

	</div>
	<br/><br/>
	
	<!--- ISIDISINI !--->
	<div id="menu">
		<div id="title_menu">
			<b><a href="#">Pengeluaran Barang</a></b>
		</div>
		<div id="menu_pp">
			<div id="pil_menu">
				<a href="input_retur_supplier.php"><div id="sub_menu"><h3>Input &nbsp;Retur Ke Supplier</h3></div></a>
			</div>
			<div id="pil_menu">
				<a href="input_keluar_barang.php"><div id="sub_menu"><h3>Input &nbsp;Keluar Barang</h3></div></a>
			</div>
			<div id="pil_menu">
				<a href="validasi_tamb.php"><div id="sub_menu"><h3>Validasi Keluar Tambahan</h3></div></a>
			</div>
			
			<div id="pil_menu">
				<a href="data_retur_supplier.php"><div id="sub_menu"><h3>&nbsp;Data &nbsp;&nbsp;Retur Supplier</h3></div></a>
			</div>
			<div id="pil_menu">
				<a href="data_keluar_barang.php"><div id="sub_menu"><h3>Data &nbsp;Keluar Barang</h3></div></a>
			</div>
			<div id="pil_menu">
				<a href="data_keluar_tamb.php"><div id="sub_menu"><h3>Data &nbsp;Keluar Tambahan</h3></div></a>
			</div>
			<div id="pil_menu">
				<a href="../index.php"><img src="../image/keluar.png"></a>
			</div>
		</div>
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
	<?php include "../footer.php";?>
</div>
</body>
</html>