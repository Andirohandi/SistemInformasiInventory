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
<head><title>Validasi Tambahan | Sistem Inventory IWU</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="../css/sticky.full.css" type="text/css">
<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script src="../js/sticky.full.js"  type="text/javascript"></script>
<script src="../js/printArea.js" type="text/javascript"></script>

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
	$("#simpan_p").click(function(){
		var no_val = $('#no_val_t').val();
		$('#no_val_t_p').val(no_val+" ?");
		$("#knf_save").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_save").click(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$( "#no_bkbtm" ).autocomplete({
		source: "bkbtamb_autocomplete.php",
		autoFocus: true,
		maxHeight:350,
		zIndex: 9999
	});
});



function tonge(){
		var unit = $('#unit').val();
		var sat = $('#sat').val();
		var ton = unit * sat;
		
		document.val_ret.tonage.value = ton;	
}

function simpan_val(){
	var no_val	= $('#no_val_t').val();
	var id_nm	= $('#id_nm').val();
	var kode	= $('#kode').val();
	var tgl_val	= $('#tgl_val').val();
	var unit	= $('#unit').val();
	var no_bkbtm 	= $('#no_bkbtm').val();
	
	$(document).ready(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	
	$.post("simpan_val_tmb.php",{id_nm:id_nm, unit:unit, kode:kode, no_val:no_val, tgl_val:tgl_val, no_bkbtm:no_bkbtm}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			
			$(document).ready(function(){
				$.sticky('Data Berhasil Diverifikasi',function(){
				stickyClass: 'info'
				});
			})
			setInterval(function(){window.location.reload()},6000);
		}else if(data.confirm==2){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Silahkan masukkan No Retur yang akan anda verifikasi',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==3){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Data gagal diverifikasi',function(){
				stickyClass: 'info'
				});
			})
		}
	});

}

function panggil_retur(){
	var no_bkbtm	= $('#no_bkbtm').val();
	
	if(no_bkbtm==""){
		$('#kode').val('');
		$('#kodebb').val('');
		$('#sat').val('');
		$('#unit').val('');
		$('#tonage').val('');
	}else{
		$.post("panggil_bkbtm.php",{no_bkbtm:no_bkbtm}, function(dataJSON){
			var data = jQuery.parseJSON(dataJSON);
			$('#kode').val(data.kode);
			$('#kodebb').val(data.kodebb);
			$('#sat').val(data.sat);
			$('#unit').val(data.unit);
			$('#tonage').val(data.tonage);
			$('#status').val(true);
		});
	}
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
	</div>
	<br/><br/>
	
	<div id="gambar_full">
		<img src="../profile/rahma.jpg" width="300"/>
	</div>
	<div id="gambar_overlay"></div>
	<div id="gambar_overlay_knf"></div>
	
	<form name="val_ret" id="val_ret" action="val_ret_p.php" method="POST">
	
	<div id="knf_save">
		<div id="head_knf">
			<h2>Konfirmasi Penyimpanan</h2>
			<p>Apakah anda yakin akan memverifikasi permintaan tambahan dari produksi dengan nomor<input type="text" name="no_val_t_p" id="no_val_t_p" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="simpan" id="simpan" value="Simpan" class="submitt" onclick="simpan_val()" />
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_save" id="can_save" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	
	<div id="badan_program">
		<div id="bada_program_kiri">
			<br/>
			<?php profile(); ?>
		</div>
		<div id="bada_program_kanan">
			<br/>
			<div id="title_program">
				<h2>Program Validasi Tambahan (BKBTM)</h2>
			</div>
			<br/>
			<div id='search-box'>
				<input id='search-text' name='search-text' placeholder="Cari Berdasakan No Validasi" type="text"/>
				<input type="button" id='search-button' onclick="lihat()" class="button_search">
			</div>
			
			<hr/>
			<div id="prog_ppb">
					<table>
						<tr>
							<td height="40">No. Validasi</td>
							<td> : </td>
							<td><input type="text" id="no_val_t" name="no_val_t" class="input1" style="cursor:not-allowed;background-color:#00c000;	" value="<?php no_val_ret() ?>" readonly value=""/></td>
						</tr>
						<tr>
							<td height="40">Tanggal</td>
							<td> : </td>
							<td><input type="text" id="tgl_val" name="tgl_val" value="<?php echo tanggal();?>" readonly style="cursor:not-allowed;" class="input1" /></td>
						</tr>
						<tr>
							<td height="40">No. BKBTM</td>
							<td> : </td>
							<td><input type="text" id="no_bkbtm" name="no_bkbtm" class="input1" style="" value="" onchange="panggil_retur()"/></td>
						</tr>
						<tr>
							<td height="40">Keterangan</td><td> : </td><td><textarea id="ket" name="ket" class="textarea1" ></textarea></td>
						</tr>
					</table>
					<table class="table1">
						<tr>
							<th width="40">ID</th>
							<th width="100">Kode</th>
							<th width="150">Kode BB</th>
							<th width="100">Satuan</th>
							<th width="100">Jml (Unit)</th>
							<th width="100">Tonage</th>
							<th width="100">Validasi</th>
						</tr>
						<tr>
							<td>
							<input type="text" name="id_nm" id="id_nm" class="inputid" style="text-align:center;cursor:not-allowed" value="<?php id_val_tmb() ?>" readonly /></td>
							<td><input type="text" name="kode" id="kode" class="input2" style="cursor:not-allowed" readonly /></td>
							<td><input type="text" name="kodebb" id="kodebb" class="input2" readonly style="cursor:not-allowed;" /></td>
							<td><input type="text" name="sat" id="sat" class="input2" style="text-align:center;cursor:not-allowed" readonly /></td>
							<td><input type="text" name="unit" id="unit" class="input2" style="text-align:center;cursor:not-allowed" onchange="tonge();"/></td>
							<td><input type="text" name="tonage" id="tonage" class="input2"  style="text-align:center;cursor:not-allowed" readonly /></td>
							<td><center><input type="checkbox" name="status" id="status" style="margin:auto;" readonly /></center></td>
						</tr>
					</table>
					<br/><br/>
					<div id="kotak_eksekusi">
						<div id="tomb_eks">
							<input type="button" name="simpan_p" id="simpan_p" value="Validasi" class="submitt"/>
						</div>
						<div id="tomb_eks">
							<input type="submit" class="submitt" value="KELUAR" name="keluar" id="keluar"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<br/>
	<hr/>
	<?php include "../footer.php";?>
</div>

</body>
</html>