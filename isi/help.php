<?php
session_start();

if(!isset($_SESSION['username'])){
	echo "<script>alert('Maaf Anda Harus Login Terlebih dahulu');
	window.location='../index.php';
	</script>";
}
include "../koneksi.php";
include "fungsifungsi.php";
include "gedget/tanggal.php";
?>

<html>
<head><title>Bantuan | Sistem Inventory IWU</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="../css/sticky.full.css" type="text/css">
<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script src="../js/jquery.easytabs.js"  type="text/javascript"></script>
<script src="../js/jquery.easytabs.min.js"  type="text/javascript"></script>
<script src="../js/jquery.hashchange.min.js"  type="text/javascript"></script>
<script src="../js/sticky.full.js"  type="text/javascript"></script>
<script src="../js/jquery.hashchange.js"  type="text/javascript"></script>

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
	$("#gmbr").click(function(){
		$("#gambar_full").fadeIn(700);
		$("#gambar_overlay").fadeTo("normal",0.4);
	});
	$("#gambar_overlay").click(function(){
		$("#gambar_full").fadeOut("slow");
		$("#gambar_overlay").hide();
	});
	$("#converttoexcel").click(function(e) {
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#excel').html()));
		e.preventDefault();
	});
	$("#bantuan").click(function(){
		$("#knf_save").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_save").click(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#simpan").click(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$( "#tab-container" ).easytabs();
});

function kembali(){
	window.history.go(-1);
}

function simpan_b(){
	var id_nm	= $("#id_nm").val();
	var nama		= $("#nama").val();
	var jam		= $("#jam").val();
	var tanggal_m	= $("#tanggal_m").val();
	var masalah	= $("#masalah").val();
	
	$.post("simpan_masalah.php",{nama:nama, id_nm:id_nm, jam:jam, tanggal:tanggal_m, masalah:masalah },function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			setInterval(function(){window.location.reload()},1000);
		}else if(data.confirm==2){
			
			$(document).ready(function(){
				$.sticky('Gagal kirim',function(){
				stickyClass: 'info'
				});
			});
		}
		
	});
}
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
	</div><br/><br/>
	<div id="gambar_full">
		
		<img src="../profile/rahma.jpg" width="300"/>
	</div>
	<div id="gambar_overlay"></div>

	<div id="badan_program">
		<div id="bada_program_kiri">	<br/>
			<?php profile();?>
		</div>
		<div id="bada_program_kanan">
			<br/>
			<div id="title_program">
				<h2>Bantuan</h2>
			</div>
			<br/>
			<!-- Back !-->
			<div id="kmbl">
				<img src="../image/kmbli.png" height="30px" onclick="kembali()" />
			</div>
			<!-- sarching !-->
			<div id='search-box'>
				<form action="" id="cari" name="cari" method="POST">
					<input onkeyup="cari2(this.value)" id='search-text' name='q' placeholder="Cari" type="text" />
					<input id='search-button' name="search-button" type='button'><span><b></b></span>
				</form>
			</div><hr/>
			<div id="gambar_overlay_knf"></div>
			<div id="knf_save">
				<div id="head_knf">
					<h2>Apa Masalah anda ?</h2>
					<input type="hidden" name="tanggal_m" id="tanggal_m" value="<?php tanggal(); ?>" />
					<input type="hidden" name="jam" id="jam" value="<?php jam(); ?>" />
					<table style="margin-left:10px">
					<input type="hidden" name="id_nm" id="id_nm" value="<?php id_masalah(); ?>" />
					<table style="margin-left:10px">
						<tr>
							<td>Nama</td><td> : </td><td><input type="text" id="nama" name="nama" value="<?php echo $_SESSION['username'];?>" style="width:200px;" class="help" readonly /></td>
						</tr>
						<tr>
							<td height="20"></td>
						</tr>
						<tr>
							<td>Masalah</td><td> : </td>
						</tr>
						<tr>
							<td colspan="3"><textarea name="masalah" id="masalah" style="width:570px; height:80px; border:1px solid #a1ddf3;padding:10px;border-radius:5px" placeholder="Apa masalah anda ?" ></textarea></td>
						</tr>
					</table>
					<br/></br>
					<div id="ktk_eks">
						<div id="tomb_eks_knf">
							<input type="button" name="simpan" id="simpan" value="Kirim" class="submitt" onclick="simpan_b()" />
						</div>
						<div id="tomb_eks_knf">
							<input type="button" name="can_save" id="can_save" value="Kembali" class="submitt"/>
						</div>
					</div>
				</div>
			</div>
			<div id="prog_ppb">
				<div id="tab-container" class="tab-container">
					<ul class="etabs">
						<li class="tab"><a href="#tabs-1">Panel Komplain</a></li>
					</ul>
					<br/><br/>
					<div id="tabs-1">
						<input type="button" name="bantuan" id="bantuan" value="Dapatkan Bantuan" class="sub_prof" style="margin-left:20px" />
						<table border="1px" style="border-collapse:collapse;margin-top:30px;">
							<thead>
							<tr height="20px">
								<th width='30' rowspan='2'>No</th>
								<th colspan='3'>Masalah</th>
								<th colspan='3'>Solusi</th>
							</tr>
							<tr height="50px">
								<th width='85'>Tanggal</th>
								<th width='60'>Jam</th>
								<th width='300'>Komplain</th>
								<th width='85'>Tanggal</th>
								<th width='60'>Jam</th>
								<th width='300'>Solusi</th>
							</tr>
							</thead>
							<tbody id="tbody_tbl_data_penerimaan" >
								<?php  load_table_masalah(); ?>
							</tbody>
						</table>
						<br/><br/>
					</div>
				</div>
				<br/><br/>
			</div>
		</div>
	</div><br/><hr/>
	<?php include "../footer.php";?>
</div>
</body>
</html>