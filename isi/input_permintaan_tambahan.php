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
<head><title>Permintaan Tambahan | Sistem Inventory IWU</title></head>

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
  $( "#kode" ).autocomplete({
		source: "autocomplete.php",
		autoFocus: true,
		maxHeight:350,
		zIndex: 9999
	});
});
//ONLOAD
$(document.body).append('<div id="page-loader"></div>');

$(window).on("beforeunload", function() {
    // ... tampilkan tabir animasi dengan efek `.fadeIn()`
    $('#page-loader').fadeIn(700).delay(10000).fadeOut(3000);
});

$(document).ready(function(){
	$("#jthtmpo_ppb").datepicker({
		changeMonth : true,
		changeYear : true,
		dateFormat : "dd-mm-yy",
	});
	$("#gmbr").click(function(){
		$("#gambar_full").fadeIn(700);
		$("#gambar_overlay").fadeTo("normal",0.4);
	});
	$("#gambar_overlay").click(function(){
		$("#gambar_full").fadeOut("slow");
		$("#gambar_overlay").hide();
	});
	$("#simpan_p").click(function(){
		var no_bkbtm = $('#no_bkbtm').val();
		$('#no_tm_p').val(no_bkbtm+" ?");
		$("#knf_save").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_save").click(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#refresh_p").click(function(){
		$("#knf_refresh").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_refresh").click(function(){
		$("#knf_refresh").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#edit_p").click(function(){
		var no_bkbtm = $('#no_bkbtm').val();
		$('#no_tm_e').val(no_bkbtm+" ?");
		$("#knf_edit").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_edit").click(function(){
		$("#knf_edit").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#batal_p").click(function(){
		var no_bkbtm = $('#no_bkbtm').val();
		$('#no_tm_b').val(no_bkbtm+" ?");
		$("#knf_batal").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_batal").click(function(){
		$("#knf_batal").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#cetak").click(function(){
		var no_ppb	= $('#no_ppb').val();
		var tgl_ppb = $('#tgl_ppb').val();
		var kategori = $('#kategori').val();
		var ket = $('#ket').val();
		var kode = $('#kode').val();
		var kodebb = $('#kodebb').val();
		var sat = $('#sat').val();
		var unit = $('#unit').val();
		var jthtmpo_ppb = $('#jthtmpo_ppb').val();
		
		$('#no_ppb_c').val(no_ppb);
		$('#tgl_ppb_c').val(tgl_ppb);
		$('#kategori_c').val(kategori);
		$('#ket_c').val(ket);
		$('#sat_c').val(sat);
		$('#unit_c').val(unit);
		$('#jthtmpo_ppb_c').val(jthtmpo_ppb);
		$('#kode_c').val(kode);
		$('#kodebb_c').val(kodebb);
		
		$('#Knf_cetak').attr({"style":"border:10px solid #00FF00"});
		$("#page_cetak").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_print").click(function(){
	$("#page_cetak").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#cetak_p").bind("click",function(event){
		$('#Knf_cetak').attr({"style":"border:none"});
		$('#Knf_cetak').printArea();
		$("#page_cetak").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$('#no_bkb').autocomplete({
		source: "bkb_autocomplate.php",
		autoFocus: true,	
	});
	$( "#search-text" ).autocomplete({
		source: "bkbtm_autocomplete.php",
		autoFocus: true,
		maxHeight:350,
		zIndex: 9999
	});
});

function tonge(){
		var unit = $('#unit').val();
		var sat = $('#sat').val();
		var ton = unit * sat;
		
		document.input_ret.tonage.value = ton;	
}

function lihat(){
	var search = $('#search-text').val();
	
	if(search==""){
		$('#no_bkbtm').val('');
		$('#no_bkb').val('');
		$('#tgl_bkbtm').val('');
		$('#kategori').val('');
		$('#ket').val('');
		$('#id_nm').val('');
		$('#kode').val('');
		$('#kodebb').val('');
		$('#sat').val('');
		$('#unit').val('');
		$('#tonage').val('');
	}else{
		$.post("cari_bkbtm.php",{search: search}, function(dataJSON){
		data = jQuery.parseJSON(dataJSON);
		$('#no_bkbtm').val(data.no_bkbtm);
		$('#no_bkb').val(data.no_bkb);
		$('#tgl_bkbtm').val(data.tgl_bkbtm);
		$('#kategori').val(data.kategori);
		$('#ket').val(data.ket);
		$('#id_nm').val(data.id_nm);
		$('#kode').val(data.kode);
		$('#kodebb').val(data.kodebb);
		$('#sat').val(data.sat);
		$('#unit').val(data.unit);
		$('#tonage').val(data.tonage);
		});
	}
}

function panggil_bkb(){
	var search = $('#no_bkb').val();
	
	if(search==""){
		$('#kode').val('');
		$('#kodebb').val('');
		$('#sat').val('');
		$('#kategori').val('');
	}else{
		$.post("cari_buka_bkb.php",{search: search}, function(dataJSON){
		data = jQuery.parseJSON(dataJSON);
		$('#kode').val(data.kode);
		$('#kodebb').val(data.kodebb);
		$('#sat').val(data.sat);
		$('#kategori').val(data.kategori);
		});
	}
}

function simpan_bkbtm(){
	var no_bkbtm	= $('#no_bkbtm').val();
	var no_bkb	= $('#no_bkb').val();
	var tgl_bkbtm	= $('#tgl_bkbtm').val();
	var kategori= $('#kategori').val();
	var ket		= $('#ket').val();
	var id_nm	= $('#id_nm').val();
	var kode	= $('#kode').val();
	var kodebb	= $('#kodebb').val();
	var sat		= $('#sat').val();
	var unit	= $('#unit').val();
	var tonage	= $('#tonage').val();
	
	$(document).ready(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	
	$.post("simpan_bkbtm.php",{no_bkbtm:no_bkbtm, no_bkb:no_bkb, tgl_bkbtm:tgl_bkbtm, kategori:kategori, ket:ket, id_nm:id_nm, kode:kode, kodebb:kodebb, sat:sat, unit:unit, tonage:tonage}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			
			$(document).ready(function(){
				$.sticky('Data Berhasil Disimpan',function(){
				stickyClass: 'info'
				});
			})
			setInterval(function(){window.location.reload()},6000);
		}else if(data.confirm==2){
			
			$(document).ready(function(){
				$.sticky('Data telah tersedia. Klik Perbarui untuk Menyimpan Hasil Edit',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==3){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Anda harus melengkapi data yang akan disimpan',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==4){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Jumlah yang anda retur melebihi jumlah BKB',function(){
				stickyClass: 'info'
				});
			})
		}
	});

}

function edit_bkbtm(){
	var no_bkbtm	= $('#no_bkbtm').val();
	var no_bkb		= $('#no_bkb').val();
	var tgl_bkbtm	= $('#tgl_bkbtm').val();
	var kategori= $('#kategori').val();
	var ket		= $('#ket').val();
	var id_nm	= $('#id_nm').val();
	var kode	= $('#kode').val();
	var kodebb	= $('#kodebb').val();
	var sat		= $('#sat').val();
	var unit	= $('#unit').val();
	var tonage	= $('#tonage').val();
	
	$(document).ready(function(){
		$("#knf_edit").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	
	$.post("edit_bkbtm.php",{no_bkbtm:no_bkbtm, no_bkb:no_bkb, tgl_bkbtm:tgl_bkbtm, kategori:kategori, ket:ket, id_nm:id_nm, kode:kode, kodebb:kodebb, sat:sat, unit:unit, tonage:tonage}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			
			$(document).ready(function(){
				$.sticky('Data Berhasil Diperbarui',function(){
				stickyClass: 'info'
				});
			})
			setInterval(function(){window.location.reload()},6000);
		}else if(data.confirm==2){
			
			$(document).ready(function(){
				$.sticky('Maaf data yang ingin anda edit belum tersedia',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==3){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Anda harus melengkapi data yang akan diedit',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==4){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Data gagal diperbarui',function(){
				stickyClass: 'info'
				});
			})
		}
	});

}

function batal_bkbtm(){
	var no_bkbtm	= $('#no_bkbtm').val();
	
	$(document).ready(function(){
		$("#knf_batal").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	
	$.post("batal_bkbtm.php",{no_bkbtm:no_bkbtm}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			
			$(document).ready(function(){
				$.sticky('Data Berhasil Dibatalkan dan dihapus',function(){
				stickyClass: 'info'
				});
			})
			setInterval(function(){window.location.reload()},6000);
		}else if(data.confirm==2){
			
			$(document).ready(function(){
				$.sticky('Maaf data yang ingin anda batalkan belum tersedia',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==3){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Data gagal dibatalkan',function(){
				stickyClass: 'info'
				});
			})
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
	</div>
	<br/><br/>
	
	<div id="gambar_full">
		<img src="../profile/rahma.jpg" width="300"/>
	</div>
	<div id="gambar_overlay"></div>
	<div id="gambar_overlay_knf"></div>
	
	<form name="input_ret" id="input_ret" action="input_retur.php" method="POST">
	<div id="knf_refresh">
		<div id="head_knf">
			<h2>Konfirmasi Penyegaran</h2>
			<p>Apakah anda yakin ingin menyegarkan halaman ini ?</p>
			<div id="ktk_eks">
				<br/>
				<div id="tomb_eks_knf">
					<input type="submit" name="refresh" id="refresh" value="Refresh" class="submitt"/>
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_refresh" id="can_refresh" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	<div id="knf_save">
		<div id="head_knf">
			<h2>Konfirmasi Penyimpanan</h2>
			<p>Apakah anda yakin akan melakukan Permintaan Tambahan dengan nomor<input type="text" name="no_tm_p" id="no_tm_p" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="simpan" id="simpan" value="Simpan" class="submitt" onclick="simpan_bkbtm()" />
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_save" id="can_save" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	<div id="knf_edit">
		<div id="head_knf">
			<h2>Konfirmasi Pembaruan</h2>
			<p>Apakah anda yakin akan memperbarui Permintaan Tambahan dengan nomor<input type="text" name="no_tm_e" id="no_tm_e" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="perbarui" id="perbarui" value="Perbarui" class="submitt" onclick="edit_bkbtm()" />
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_edit" id="can_edit" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	<div id="knf_batal">
		<div id="head_knf">
			<h2>Konfirmasi Pembatalan</h2>
			<p>Apakah anda yakin akan MEMBATALKAN PERMINTAAN TAMBAHAN dengan nomor<input type="text" name="no_tm_b" id="no_tm_b" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="batal" id="batal" value="Batal" class="submitt" onclick="batal_bkbtm()" />
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_batal" id="can_batal" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	<div id="page_cetak">
		<!--Cetak Retur !-->
		<div id="knf_cet">
			<br/><br/>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="cetak_p" id="cetak_p" value="Cetak" class="submitt"/>
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_print" id="can_print" value="Kembali" class="submitt"/>
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
				<h2>Program Permintaan Tambahan</h2>
			</div>
			<br/>
			<div id='search-box'>
				<input id='search-text' name='search-text' placeholder="Cari Berdasakan No BKBTM" type="text"/>
				<input type="button" id='search-button' onclick="lihat()" class="button_search">
			</div>
			
			<hr/>
			<div id="prog_ppb">
					<table>
						<tr>
							<td height="40">No. BKBTM</td>
							<td> : </td>
							<td><input type="text" id="no_bkbtm" name="no_bkbtm" class="input1" style="cursor:not-allowed;background-color:green;color:white;" readonly value="<?php nobkbtm(); ?>"/></td>
						</tr>
						<tr>
							<td height="40">Tanggal</td>
							<td> : </td>
							<td><input type="text" id="tgl_bkbtm" name="tgl_bkbtm" value="<?php echo tanggal();?>" readonly style="cursor:not-allowed;" class="input1" /></td>
						</tr>
						<tr>
							<td height="40">No. BKB</td>
							<td> : </td>
							<td><input type="text" id="no_bkb" name="no_bkb" class="input1" style="" onchange="panggil_bkb()"/></td>
						</tr>
						<tr>
							<td height="40">Kategori</td>
							<td> : </td>
							<td><input type="text" id="kategori" name="kategori" class="input1" readonly style="cursor:not-allowed;"/></td>
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
							<th width="100">&nbsp;Satuan&nbsp;</th>
							<th width="100">Jml (Unit)</th>
							<th width="100">Tonage</th>
						</tr>
						<tr>
							<td>
							<input type="text" name="id_nm" id="id_nm" class="inputid" style="text-align:center;cursor:not-allowed;" value="<?php id_bkbtm() ?>" readonly /></td>
							<td><input type="text" name="kode" id="kode" class="input2" readonly style="cursor:not-allowed;"/></td>
							<td><input type="text" name="kodebb" id="kodebb" class="input2" readonly style="cursor:not-allowed;" /></td>
							<td><input type="text" name="sat" id="sat" class="input2" style="text-align:center;cursor:not-allowed;" readonly /></td>
							<td><input type="text" name="unit" id="unit" class="input2" style="text-align:center" onchange="tonge();"/></td>
							<td><input type="text" name="tonage" id="tonage" class="input2"  style="text-align:center;cursor:not-allowed;" readonly /></td>
						</tr>
					</table>
					<br/><br/>
					<input type="hidden" name="packing" id="packing" readonly />
					<input type="hidden" name="hrg_sat" id="hrg_sat" readonly />
					<div id="kotak_eksekusi">
						<div id="tomb_eks">
							<input type="button" name="refresh_p" id="refresh_p" value="Refresh" class="submitt"/>
						</div>
						<div id="tomb_eks">
							<input type="button" name="simpan_p" id="simpan_p" value="Simpan" class="submitt"/>
						</div>
						<div id="tomb_eks">
							<input type="button" name="edit_p" id="edit_p" class="submitt" value="Perbarui"/>
						</div>
						<div id="tomb_eks">
							<input type="button" name="batal_p" id="batal_p" class="submitt" value="Batal"/>
						</div>
						<div id="tomb_eks">
							<input type="button" class="submitt" value="Cetak" name="cetak" id="cetak"/>
						</div>
						<div id="tomb_eks">
							<input type="submit" class="submitt" value="Dt BKBTM" name="databkbtm" id="databkbtm"/>
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