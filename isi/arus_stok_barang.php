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
<head><title>Data Arus Barang | Sistem Inventory IWU</title></head>

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

$(document).ready(function(){
	$("#logout").click(function(){
		$("#knf_logout").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_out").click(function(){
		$("#knf_logout").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
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
				<li><a href="profile.php"><img src="../image/about.png" height="30px"><span style="display: block; opacity: 1; top: -40px;">Tentang Kami</span></a></li>
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
	<div id="gambar_overlay_knf"></div>
	<div id="knf_logout">
		<div id="head_knf">
			<h2>Log Out</h2>
			<p style="color:red;">Apakah anda yakin ingin keluar ?</p>
			<form name="out" id="out" action="logout.php" method="POST">
				<div id="ktk_eks">
					<div id="tomb_eks_knf">
						<input type="submit" name="logo" id="simpan" value="Ya" class="submitt"/>
					</div>
					<div id="tomb_eks_knf">
						<input type="button" name="can_out" id="can_out" value="Tidak" class="submitt"/>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--- ISIDISINI !--->
	
		<div id="title_menu">
			<b><a href="#">Data Arus Barang</a></b>
		</div>
		<div id="menu_stok">
			<div id="sub_menu_stok">
				<a href="stok_real.php"><button class="but_stok">Stok Real</button></a>
			</div>
			<div id="sub_menu_stok">
				<a href=""><button class="but_stok">Stok Detail</button></a>
			</div>
			<div id="sub_menu_stok">
				<a href="master_barang_ppb.php"><button class="but_stok">Master Barang</button></a>
			</div>
			<div id="sub_menu_stok">
				<button class="but_stok" id='logout'>KELUAR</button>
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
