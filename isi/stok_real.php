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
<head><title>Stock Real | Sistem Inventory IWU</title></head>


<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script src="../js/jquery.easytabs.js"  type="text/javascript"></script>
<script src="../js/jquery.easytabs.min.js"  type="text/javascript"></script>
<script src="../js/jquery.hashchange.min.js"  type="text/javascript"></script>
<script src="../js/jquery.hashchange.js"  type="text/javascript"></script>
<script type="text/javascript">
function edit_stok(i){
	alert(i);
}
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
	$('#cancel').click(function(){
		$("#form_edit_stok").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#converttoexcel").click(function(e) {
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#excel').html()));
		e.preventDefault();
		});
	$("#mstr_bhn").click(function(){
		$("#master_ppb_kms").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_dus").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_bahan").fadeIn(3000)
	});
	$("#mstr_kms").click(function(){
		$("#master_ppb_bahan").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_dus").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_kms").fadeIn(3000)
	});
	$("#mstr_dus").click(function(){
		$("#master_ppb_kms").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_bahan").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_dus").fadeIn(3000)
	});
	$("#gmbr").click(function(){
		$("#gambar_full").fadeIn(700);
		$("#gambar_overlay").fadeTo("normal",0.4);
	});
	$("#gambar_overlay").click(function(){
		$("#gambar_full").fadeOut("slow");
		$("#gambar_overlay").hide();
	});
	$( "#tab-container" ).easytabs();
	$('#simpan_stok').click(function(){
		$("#form_edit_stok").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
});

function edit_stok(i){
	$.post("edit_stok.php",{i:i},function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		$('#kode').val(data.kode);
		$('#kodebb').val(data.kodebb);
		$('#sat').val(data.sat);
		$('#s_awal').val(data.s_awal);
		$('#masuk').val(data.masuk);
		$('#keluar').val(data.keluar);
		$('#smin').val(data.smin);
		$('#rop').val(data.rop);
		$('#smax').val(data.smax);
		$('#s_akhir').val(data.s_akhir);
		
		$(document).ready(function(){
			$('#form_edit_stok').fadeIn(700);
			$("#gambar_overlay_knf").fadeTo("normal",0.4);
		});
	});
}

function s_akhirr(){
	var masuk = $('#masuk').val();
	var s_awal= $('#s_awal').val();
	var keluar= $('#keluar').val();
	var hasil = s_awal+masuk-keluar;
	$('#s_akhir').val(hasil);
}

function kembali(){
	window.history.go(-1);
}

function simpan_edit(){
	var kode = $('#kode').val();
	var masuk = $('#masuk').val();
	var keluar = $('#keluar').val();
	var s_akhir = $('#s_akhir').val();
	$.post("simpan_edit_stok.php",{kode:kode, masuk:masuk, keluar:keluar, s_akhir:s_akhir},function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			setInterval(function(){window.location.reload()},1000);
		}else{
			alert(data.confirm);
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
				<li><a href="profile.php"><img src="../image/about.png" height="30px"><span style="display: block; opacity: 1; top: -40px;">Tentang Kami</span></a></li>
				<li><a href="help.php"><img src="../image/help.png" height="30px"><span>Bantuan</span></a></li>
			</ul>
		</div>
	</div><br/><br/>
	<div id="form_edit_stok">
		<div id='head_knf'>
			<h2>Edit Stok</h2>
		</div>
		<br/>
		<table style='margin-left:20px;'>
			<tr>
				<td>Kode</td><td> : </td><td><input type="text" name='kode' id='kode' class='edit_st_r'readonly style='background-color:#FAF0E6;'/></td>
			</tr>
			<tr>
				<td>Kodebb</td><td> : </td><td><input type="text" name='kodebb' id='kodebb' class='edit_st_r' readonly style='background-color:#FAF0E6;'/></td>
			</tr>
			<tr>
				<td>Sat</td><td> : </td><td><input type="text" name='sat' id='sat' class='edit_st_r' readonly style='background-color:#FAF0E6;'/></td>
			</tr>
			<tr>
				<td>Saldo Awal</td><td> : </td><td><input type="text" name='s_awal' id='s_awal' class='edit_st_r' readonly style='background-color:#FAF0E6;'/></td>
			</tr>
			<tr>
				<td>Masuk</td><td> : </td><td><input type="text" name='masuk' id='masuk' class='edit_st_r' onchange='s_akhirr()';/></td>
			</tr>
			<tr>
				<td>Keluar</td><td> : </td><td><input type="text" name='keluar' id='keluar' class='edit_st_r' onchange='s_akhirr()'/></td>
			</tr>
			<tr>
				<td>Saldo Akhir</td><td> : </td><td><input type="text" name='s_akhir' id='s_akhir' class='edit_st_r' readonly style='background-color:#FAF0E6;'/></td>
			</tr>
			<tr>
				<td>S Min</td><td> : </td><td><input type="text" name='smin' id='smin' class='edit_st_r' readonly style='background-color:#FAF0E6;'/></td>
			</tr>
			<tr>
				<td>ROP</td><td> : </td><td><input type="text" name='rop' id='rop' class='edit_st_r' readonly style='background-color:#FAF0E6;'/></td>
			</tr>
			<tr>
				<td>S Max</td><td> : </td><td><input type="text" name='smax' id='smax' class='edit_st_r' readonly style='background-color:#FAF0E6;'/></td>
			</tr>
		</table>
		<br/>
		<table align='center'>
			<tr>
				<td><input type='button' name='simpan_stok' id='simpan_stok' value='Simpan' class='sub_prof' onclick='simpan_edit()'/></td><td></td><td><input type='button' name='cancel' id='cancel' value='Kembali' class='sub_prof'/></td>
			</tr>
			<tr>
				
			</tr>
		</table>
	</div>
	<div id="gambar_full">
		<img src="../profile/rahma.jpg" width="300"/>
	</div>
	<div id="gambar_overlay_knf"></div>

	<div id="badan_program">
		<div id="bada_program_kiri"><br/>
			<?php profile();?>
		</div>
		<div id="bada_program_kanan">
			<br/>
			<div id="title_program">
				<h2>STOK REAL</h2>
			</div>
			<br/>
			<!-- Back !-->
			<div id="kmbl">
				<img src="../image/kmbli.png" height="30px" onclick="kembali()" />
			</div>

			<div id='search-box'>
				<form action="" id="cari" name="cari" method="POST">
					<input id="search-text" name="search-text" placeholder="Cari" type="text" onkeyup="cari2(this.	value)"; />
					<input id='search-button' type='button'></button>
				</form>
			</div><hr/>

			<div id="prog_ppb">
				<div id="tab-container" class="tab-container">
					<ul class="etabs">
						<li class="tab"><a href="#tabs-1"><?php echo custom_date();?></a></li>
					</ul>
					<br/><br/>
					<div id="tabs-1">
						<table border="1px" style="border-collapse:collapse">
							<thead>
								<tr> 
									<th width="30">No</th>
									<th width="150">Kode</th>
									<th width="150">Kode BB</th>
									<th width="50">Kmsn</th>
									<th width="30">Sat</th>
									<th width="60">S Awal</th>
									<th width="60">Masuk</th>
									<th width="60">Keluar</th>
									<th width="60">S Akhir</th>
									<th width="60">Smin</th>
									<th width="60">ROP</th>
									<th width="60">Smax</th>
									<th width="60">Aksi</th>
								</tr>
							</thead>
							<tbody id="tabel_master" >
								<?php load_table_stok_real();?>
							</tbody>
						</table>
						<br/><br/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br/>
	<hr/>
	<?php include "../footer.php";?>
</div>
</body>
</html>