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
<head><title>Pembuatan BKB | Sistem Inventory IWU</title></head>

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
  $('#search-text').autocomplete({
		source: "bkb_autocomplate.php",
		autoFocus: true,	
	});
});
//ONLOAD
$(document.body).append('<div id="page-loader"></div>');

$(window).on("beforeunload", function() {
    // ... tampilkan tabir animasi dengan efek `.fadeIn()`
    $('#page-loader').fadeIn(700).delay(10000).fadeOut(3000);
});

$(document).ready(function(){
	$( "#kode" ).autocomplete({
		source: "autocomplete.php",
		autoFocus: true,
		maxHeight:350,
		zIndex: 9999
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
		var no_bkb = $('#no_bkb').val();
		$('#no_bkb_p').val(no_bkb+" ?");
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
		var no_bkb = $('#no_bkb').val();
		$('#no_bkb_e').val(no_bkb+" ?");
		$("#knf_edit").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_edit").click(function(){
		$("#knf_edit").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#batal_p").click(function(){
		var no_bkb = $('#no_bkb').val();
		$('#no_bkb_b').val(no_bkb+" ?");
		$("#knf_batal").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_batal").click(function(){
		$("#knf_batal").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#cetak").click(function(){
		var no_bkb	= $('#no_bkb').val();
		var tgl_bkb	= $('#tgl_bkb').val();
		var klr_ke	= $('#klr_ke').val();
		var kategori= $('#kategori').val();
		var ket		= $('#ket').val();
		var id_nm	= $('#id_nm').val();
		var kode	= $('#kode').val();
		var kodebb	= $('#kodebb').val();
		var sat		= $('#sat').val();
		var unit	= $('#unit').val();
		var tonage	= $('#tonage').val();
		
		$('#no_bkb_cet').val(no_bkb);
		$('#tgl_bkb_cet').val(tgl_bkb);
		$('#klr_ke_cet').val(klr_ke);
		$('#kategori_cet').val(kategori);
		$('#ket_cet').val(ket);
		$('#id_nm_cet').val(id_nm);
		$('#kode_cet').val(kode);
		$('#kodebb_cet').val(kodebb);
		$('#sat_cet').val(sat);
		$('#unit_cet').val(unit);
		$('#tonage_cet').val(tonage);

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
});

function tonge(){
		var unit = $('#unit').val();
		var sat = $('#sat').val();
		var ton = unit * sat;
		
		document.input_bkb.tonage.value = ton;	
}

function lihat(){
	var search = $('#search-text').val();
	
	if(search==""){
		$('#no_bkb').val('');
		$('#tgl_bkb').val('');
		$('#klr_ke').val('');
		$('#kategori').val('');
		$('#ket').val('');
		$('#id_nm').val('');
		$('#kode').val('');
		$('#kodebb').val('');
		$('#sat').val('');
		$('#unit').val('');
		$('#tonage').val('');
	}else{
		$.post("cari_buka_bkb.php",{search: search}, function(dataJSON){
		data = jQuery.parseJSON(dataJSON);
		$('#no_bkb').val(data.no_bkb);
		$('#tgl_bkb').val(data.tgl_bkb);
		$('#klr_ke').val(data.klr_ke);
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

function bkb(){
	var kode = $('#kode').val();
	
	if(kode==""){
		$('#kodebb').val('');
		$('#packing').val('');
		$('#sat').val('');
		$('#hrg_sat').val('');
		$('#kategori').val('');
	}else{
		$.post("fungsi.php", {kode: kode},function(dataJSON){
			data = jQuery.parseJSON(dataJSON);
			$('#kodebb').val(data.kodebb);
			$('#packing').val(data.packing);
			$('#sat').val(data.sat);
			$('#hrg_sat').val(data.hrg_sat);
			$('#kategori').val(data.kategori);
		});
	}
}

function simpan_bkb(){
	var no_bkb	= $('#no_bkb').val();
	var tgl_bkb	= $('#tgl_bkb').val();
	var klr_ke	= $('#klr_ke').val();
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
	
	$.post("simpan_bkb.php",{no_bkb:no_bkb, tgl_bkb:tgl_bkb, klr_ke:klr_ke, kategori:kategori, ket:ket, id_nm:id_nm, kode:kode, kodebb:kodebb, sat:sat, unit:unit, tonage:tonage}, function(dataJSON){
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
		}
	});

}

function edit_bkb(){
	var no_bkb	= $('#no_bkb').val();
	var tgl_bkb	= $('#tgl_bkb').val();
	var klr_ke	= $('#klr_ke').val();
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
	
	$.post("edit_bkb.php",{no_bkb:no_bkb, tgl_bkb:tgl_bkb, klr_ke:klr_ke, kategori:kategori, ket:ket, id_nm:id_nm, kode:kode, kodebb:kodebb, sat:sat, unit:unit, tonage:tonage}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			
			$(document).ready(function(){
				$.sticky('Data Berhasil Diperbarui',function(){
				stickyClass: 'info'
				});
			});
			setInterval(function(){window.location.reload()},6000);
		}else if(data.confirm==2){
			
			$(document).ready(function(){
				$.sticky('Maaf! Data yang ingin anda perbarui belum tersedia dalam databae kami. Silahkan \'SIMPAN\' data anda terlebih dahulu',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==3){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Anda harus melengkapi data yang akan diperbarui',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==4){
			$(document).ready(function(){
				$.sticky('Gagal memperbarui',function(){
				stickyClass: 'info'
				});
			})
		}
	});
}

function batal_bkb(){
	var no_bkb	= $('#no_bkb').val();
	
	$(document).ready(function(){
		$("#knf_batal").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	
	$.post("batal_bkb.php",{no_bkb:no_bkb}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			
			$(document).ready(function(){
				$.sticky('Data Berhasil Dihapus dan dibatalkan',function(){
				stickyClass: 'info'
				});
			});
			setInterval(function(){window.location.reload()},6000);
			
		}else if(data.confirm==2){
			
			$(document).ready(function(){
				$.sticky('Maaf! Data yang ingin anda hapus belum tersedia di database kami',function(){
				stickyClass: 'info'
				});
			});
		}else if(data.confirm==3){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Data gagal untuk dihapus',function(){
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
	</div>
	<br/><br/>
	
	<div id="gambar_full">
		<img src="../profile/rahma.jpg" width="300"/>
	</div>
	<div id="gambar_overlay"></div>
	<div id="gambar_overlay_knf"></div>
	
	<form name="input_bkb" id="input_bkb" action="input_bkb.php" method="POST">
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
			<p>Apakah anda yakin akan menyimpan BKB dengan nomor<input type="text" name="no_bkb_p" id="no_bkb_p" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="simpan" id="simpan" value="Simpan" class="submitt" onclick="simpan_bkb()" />
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
			<p>Apakah anda yakin akan memperbarui BKB dengan nomor<input type="text" name="no_bkb_e" id="no_bkb_e" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="perbarui" id="perbarui" value="Perbarui" class="submitt" onclick="edit_bkb()" />
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
			<p>Apakah anda yakin akan MEMBATALKAN BKB dengan nomor<input type="text" name="no_bkb_b" id="no_bkb_b" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="batal" id="batal" value="Batal" class="submitt" onclick="batal_bkb()" />
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_batal" id="can_batal" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	<div id="page_cetak">
		<!--Cetak Retur !-->
		<div id='knf_cetak'>
			<h3>Bukti Keluar Barang<br/>BKB</h3>
			<table>
				<tr>
					<td>No BKB</td><td> : </td><td><input type='text' name='no_bkb_cet' id='no_bkb_cet'style='border:none;' readonly /></td><td>Keluar Ke</td><td> : </td><td><input type='text' name='Klr_ke_cet' id='Klr_ke_cet' style='border:none;' readonly /></td>
				</tr>
				<tr>
					<td>Tanggal</td><td> : </td><td><input type='text' name='tgl_bkb_cet' id='tgl_bkb_cet' style='border:none;' readonly /></td>
				</tr>
			</table>
			<table class='table2_cetak_po' border='1px'>
				<tr>
					<th width='30'>No</th>
					<th width='110'>Kode</th>
					<th width='150'>KodeBB</th>
					<th width='30'>Sat</th>
					<th width='70'>Jumlah</th>
					<th width='70'>Tonage</th>
				</tr>
				<tr>
					<td align='center'>1</td>
					<td><input type='text' name='kode_cet' id='kode_cet' style='border:none;width:110;' readonly /></td>
					<td><input type='text' name='kodebb_cet' id='kodebb_cet' style='border:none;width:150;' readonly /></td>
					<td><input type='text' name='sat_cet' id='sat_cet' style='border:none;width:30;' readonly /></td>
					<td><input type='text' name='unit_cet' id='unit_cet' style='border:none;width:70;' readonly /></td>
					<td><input type='text' name='tonage_cet' id='tonage_cet' style='border:none;width:70;' readonly /></td>
				</tr>
			</table>
			<div id='ttdpo'>
				<center>Pengirim,
				<br/><br/><br/><br/>
				( ........................... )<br/>
				</center>
			</div>
			<div id='ttdpo'>
				
			</div>
			<div id='ttdpo'>
				<center>Penerima,
				<br/><br/><br/><br/>
				( ........................... )<br/>
				</center>
			</div>
		</div>
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
				<h2>Program Pengeluaran Barang (BKB)</h2>
			</div>
			<br/>
			<div id='search-box'>
				<input id='search-text' name='search-text' placeholder="Cari Berdasakan No BKB" type="text"/>
				<input type="button" id='search-button' onclick="lihat()" class="button_search">
			</div>
			
			<hr/>
			<div id="prog_ppb">
					<table>
						<tr>
							<td height="40">No. BKB</td>
							<td> : </td>
							<td><input type="text" id="no_bkb" name="no_bkb" class="input1" style="cursor:not-allowed;background-color:grey;color:white;" readonly value="<?php nobkb(); ?>"/></td>
						</tr>
						<tr>
							<td height="40">Tanggal</td>
							<td> : </td>
							<td><input type="text" id="tgl_bkb" name="tgl_bkb" value="<?php echo tanggal();?>" readonly style="cursor:not-allowed;" class="input1" /></td>
						</tr>
						<tr>
							<td height="40">Keluar Ke</td>
							<td> : </td>
							<td><input type="text" id="klr_ke" name="klr_ke"  style=";" class="input1" /></td>
						</tr>
						<tr>
							<td height="40">Kategori</td>
							<td> : </td>
							<td><input type="text" id="kategori" name="kategori" class="input1" readonly style="cursor:not-allowed;"/></td>
						</tr>
					</table>
					<br/>
					<table class="table1">
						<tr>
							<th width="40">ID</th>
							<th width="100">Kode</th>
							<th width="150">Kode BB</th>
							<th width="100">Satuan</th>
							<th width="100">Jml (Unit)</th>
							<th width="100">Tonage</th>
						</tr>
						<tr>
							<td>
							<input type="text" name="id_nm" id="id_nm" class="inputid" style="text-align:center" value="<?php id_bkb()?>" style="cursor:not-allowed;" readonly /></td>
							<td><input type="text" name="kode" id="kode" onchange="bkb()" class="input2" /></td>
							<td><input type="text" name="kodebb" id="kodebb" class="input2" readonly style="cursor:not-allowed;" /></td>
							<td><input type="text" name="sat" id="sat" class="input2" style="text-align:center;cursor:not-allowed" readonly style="cursor:not-allowed;" /></td>
							<td><input type="text" name="unit" id="unit" class="input2" style="text-align:center;" onchange="tonge();"/></td>
							<td><input type="text" name="tonage" id="tonage" class="input2"  style="text-align:center;cursor:not-allowed;" readonly /></td>
						</tr>
					</table>
					<br/>
					<table>
						<tr >
							<td height="40">Keterangan</td><td> : </td><td rowspan="2"><textarea id="ket" name="ket" class="textarea2" ></textarea></td>
						</tr>
							<td></td><td></td><td></td>
						<tr>
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
							<input type="submit" class="submitt" value="Data BKB" name="databkb" id="databkb"/>
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