<?php
session_start();

if(!isset($_SESSION['username'])){
	echo "<script>
		alert('Maaf , Anda harus login terlebih dahulu !');window.location='../index.php';
	</script>";
}

include "../koneksi.php";
include "gedget/tanggal.php";
?>
<html>
<head><title>Produksi | Sistem Inventory IWU</title></head>

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
		$('#badan').slideDown("3000");;
		var menu=$("#menu");
	menu.animate({height:'200px',opacity:'0.4'},"slow");
    menu.animate({width:'620px',opacity:'0.8'},"slow");
	});
});

$(document).ready(function(){
	$("#log_out").click(function(){
		$("#knf_logout").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_out").click(function(){
		$("#knf_logout").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
});


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
	</div><br/><br/><br/>
	
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
	
	<div id="flat">
		<?php echo custom_date(); ?>
	</div>
	<div id="flat2">
		<?php include "gedget/jam.php"; ?>
	</div>
	<div id="flat5"></div><br/><br/>
	
	<!--- ISIDISINI !--->
	<div id="menu">
		<div id="title_menu">
			<b><a href="#">Divisi Produksi</a></b>
		</div>
		<div id="menu_pp">
			<div id="pil_menu">
				<a href="input_retur_barang.php"><div id="sub_menu"><h3>&nbsp;Input Retur Barang</h3></div></a>
			</div>
			<div id="pil_menu">
				<a href="data_retur_prod.php"><div id="sub_menu"><h3>&nbsp;Data&nbsp; &nbsp;Retur Barang</h3></div></a>
			</div>
			<div id="pil_menu">
				<a href="input_permintaan_tambahan.php"><div id="sub_menu"><h3>Input Permintaan Tambahan </h3></div></a>
			</div>
			<div id="pil_menu">
				<a href="data_keluar_tamb.php"><div id="sub_menu"><h3>Data Permintaan Tambahan </h3></div></a>
			</div>
			<div id="log_out">
				<h3>KELUAR</h3>
			</div>
		</div>
	</div><br/><br/>
	
	<div id="flat3"></div>
	<div id="flat4"></div>
	<div id="flat6"></div><br/><hr/>
	<?php include "../footer.php";?>
</div>
</body>
</html>