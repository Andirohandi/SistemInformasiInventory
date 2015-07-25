<?php
session_start();

if(!isset($_SESSION['username'])){
	echo "<script>alert('Maaf Anda Harus Login Terlebih dahulu');
	window.location='../index.php';
	</script>";
}

include "gedget/tanggal.php";
include "../koneksi.php";
include "fungsifungsi.php";
?>

<html>
<head><title>Pembuatan PO | Sistem Inventory IWU</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="../css/sticky.full.css" type="text/css">


<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script src="../js/sticky.full.js"  type="text/javascript"></script>
<script src="../js/printArea.js"></script>

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
	$("#tgl_po").datepicker({
		changeMonth : true,
		changeYear : true
		});
	$("#tgl_kirim").datepicker({
		changeMonth : true,
		changeYear : true,
		dateFormat : 'dd-mm-yy',
		});
	$( "#no_ppb" ).autocomplete({
		source: "autocomplete_po.php",
		autoFocus: true
		});
	$('#search-text').autocomplete({
		source: "po_autocomplate.php",
		autoFocus: true,
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
		var no_po = $('#no_po').val();
		$('#no_po_p').val(no_po+" ?");
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
		var no_po = $('#no_po').val();
		$('#no_po_e').val(no_po+" ?");
		$("#knf_edit").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_edit").click(function(){
		$("#knf_edit").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#batal_p").click(function(){
		var no_po = $('#no_po').val();
		$('#no_po_b').val(no_po+" ?");
		$("#knf_batal").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_batal").click(function(){
		$("#knf_batal").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#cetak").click(function(){
		var no_po		= $('#no_po').val();
		var supplier	= $('#supplier').val();
		var no_ppb 		= $('#no_ppb').val();
		var tgl_po 		= $('#tgl_po').val();
		var tgl_kirim 	= $('#tgl_kirim').val();
		var attn 		= $('#attn').val();
		var po_untuk 	= $('#po_untuk').val();
		var kirim_ke 	= $('#kirim_ke').val();
		var kode 		= $('#kode').val();
		var kodebb 		= $('#kodebb').val();
		var packing 	= $('#packing').val();
		var sat 		= $('#sat').val();
		var unit 		= $('#unit').val();
		var hrg_sat 	= $('#hrg_sat').val();
		var hrg_total 	= $('#hrg_total').val();
		var kategori 	= $('#kategori').val();
		var ket 	= $('#ket').val();
		
		$('#no_po_c').val(no_po);
		$('#supplier_c').val(supplier);
		$('#no_ppb_c').val(no_ppb);
		$('#tgl_po_c').val(tgl_po);
		$('#tgl_kirim_c').val(tgl_kirim);
		$('#attn_c').val(attn);
		$('#po_untuk_c').val(po_untuk);
		$('#kirim_ke_c').val(kirim_ke);
		$('#kode_c').val(kode);
		$('#kodebb_c').val(kodebb);
		$('#packing_c').val(packing);
		$('#sat_c').val(sat);
		$('#unit_c').val(unit);
		$('#hrg_sat_c').val(hrg_sat);
		$('#hrg_total_c').val(hrg_total);
		$('#kategori_c').val(kategori);
		$('#ket_c').val(ket);
		
		$('#Knf_cetak_po').attr({"style":"border:10px solid #00FF00"});
		$("#page_cetak_po").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_print").click(function(){
	$("#page_cetak_po").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#cetak_p").bind("click",function(event){
		$('#Knf_cetak_po').attr({"style":"border:none"});
		$('#Knf_cetak_po').printArea();
		$("#page_cetak_po").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
});

function noppb(){
	var no_ppb = $('#no_ppb').val();
	
	if(no_ppb==""){
		$('#kode').val('');
		$('#kodebb').val('');
		$('#packing').val('');
		$('#sat').val('');
		$('#hrg_sat').val('');
		$('#kategori').val('');
	}else{
		$.post("fungsi_po.php", {no_ppb: no_ppb},function(dataJSON){
			data = jQuery.parseJSON(dataJSON);
			$('#kode').val(data.kode);
			$('#kodebb').val(data.kodebb);
			$('#packing').val(data.packing);
			$('#sat').val(data.sat);
			$('#hrg_sat').val(data.hrg_sat);
			$('#kategori').val(data.kategori);
		});
	}
}

function editpo(){
	var term = $('#search-text').val();
	if(term==""){
		$('#id_nm').val('');
		$('#no_po').val('');
		$('#supplier').val('');
		$('#no_ppb').val('');
		$('#tgl_po').val('');
		$('#tgl_kirim').val('');
		$('#attn').val('');
		$('#po_untuk').val('');
		$('#kirim_ke').val('');
		$('#kode').val('');
		$('#kodebb').val('');
		$('#packing').val('');
		$('#sat').val('');
		$('#unit').val('');
		$('#hrg_sat').val('');
		$('#hrg_total').val('');
		$('#kategori').val('');
	}else{
		$.post("edit_po.php", {term: term}, function(dataJSON){
			data = jQuery.parseJSON(dataJSON);
			$('#id_nm').val(data.id_nm);
			$('#no_po').val(data.no_po);
			$('#supplier').val(data.supplier);
			$('#no_ppb').val(data.no_ppb);
			$('#tgl_po').val(data.tgl_po);
			$('#tgl_kirim').val(data.tgl_kirim);
			$('#attn').val(data.attn);
			$('#po_untuk').val(data.po_untuk);
			$('#kirim_ke').val(data.kirim_ke);
			$('#kode').val(data.kode);
			$('#kodebb').val(data.kodebb);
			$('#packing').val(data.packing);
			$('#sat').val(data.sat);
			$('#unit').val(data.unit);
			$('#hrg_sat').val(data.hrg_sat);
			$('#hrg_total').val(data.hrg_total);
			$('#kategori').val(data.kategori);
		});
	}
}
function hrg_tot(){
	var unit = $('#unit').val();
	var hrg = $('#hrg_sat').val();
	var total = unit * hrg;
	
	document.input_po.hrg_total.value=total;
}

function simpan_po(){
	var id_nm		= $('#id_nm').val();
	var no_po		= $('#no_po').val();
	var supplier	= $('#supplier').val();
	var no_ppb		= $('#no_ppb').val();
	var tgl_po		= $('#tgl_po').val();
	var tgl_kirim	= $('#tgl_kirim').val();
	var attn		= $('#attn').val();
	var po_untuk	= $('#po_untuk').val();
	var kirim_ke	= $('#kirim_ke').val();
	var kode		= $('#kode').val();
	var kodebb		= $('#kodebb').val();
	var packing		= $('#packing').val();
	var sat			= $('#sat').val();
	var unit		= $('#unit').val();
	var hrg_sat		= $('#hrg_sat').val();
	var hrg_total	= $('#hrg_total').val();
	var kategori	= $('#kategori').val();
	var ket			= $('#ket').val();
	
	$("#knf_save").fadeOut("slow").attr({"top":"100px"});
	$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	
	$.post("simpan_po.php",{id_nm:id_nm, no_po:no_po, supplier:supplier, no_ppb:no_ppb, tgl_po:tgl_po, tgl_kirim:tgl_kirim, attn:attn, po_untuk:po_untuk, kirim_ke:kirim_ke, kode:kode, kodebb:kodebb, packing:packing, sat:sat, unit:unit, hrg_sat:hrg_sat, hrg_total:hrg_total, kategori:kategori, ket:ket},function(dataJSON){
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
				$.sticky('Data telah tersedia. Klik Perbarui untuk meyimpan hasil pengeditan',function(){
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

function edit_po(){
	var id_nm		= $('#id_nm').val();
	var no_po		= $('#no_po').val();
	var supplier	= $('#supplier').val();
	var no_ppb		= $('#no_ppb').val();
	var tgl_po		= $('#tgl_po').val();
	var tgl_kirim	= $('#tgl_kirim').val();
	var attn		= $('#attn').val();
	var po_untuk	= $('#po_untuk').val();
	var kirim_ke	= $('#kirim_ke').val();
	var kode		= $('#kode').val();
	var kodebb		= $('#kodebb').val();
	var packing		= $('#packing').val();
	var sat			= $('#sat').val();
	var unit		= $('#unit').val();
	var hrg_sat		= $('#hrg_sat').val();
	var hrg_total	= $('#hrg_total').val();
	var kategori	= $('#kategori').val();
	var ket			= $('#ket').val();
	
	$("#knf_edit").fadeOut("slow").attr({"top":"100px"});
	$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	
	$.post("edit_po2.php",{id_nm:id_nm, no_po:no_po, supplier:supplier, no_ppb:no_ppb, tgl_po:tgl_po, tgl_kirim:tgl_kirim, attn:attn, po_untuk:po_untuk, kirim_ke:kirim_ke, kode:kode, kodebb:kodebb, packing:packing, sat:sat, unit:unit, hrg_sat:hrg_sat, hrg_total:hrg_total, kategori:kategori, ket:ket},function(dataJSON){
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
				$.sticky('Data telah tersedia. Klik Perbarui untuk meyimpan hasil pengeditan',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==3){
			$(document).ready(function(){
				$.sticky('Maaf!! Anda harus melengkapi data yang ingin anda perbarui',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==4){
			$(document).ready(function(){
				$.sticky('Maaf! Data yang ingin anda perbarui belum tersedia dalam databae kami. Silahkan \'SIMPAN\' data anda terlebih dahulu',function(){
				stickyClass: 'info'
				});
			})
		}
	});
}

function batal_po(){
	var id_nm		= $('#id_nm').val();
	var no_po		= $('#no_po').val();
	var supplier	= $('#supplier').val();
	var no_ppb		= $('#no_ppb').val();
	var tgl_po		= $('#tgl_po').val();
	var tgl_kirim	= $('#tgl_kirim').val();
	var attn		= $('#attn').val();
	var po_untuk	= $('#po_untuk').val();
	var kirim_ke	= $('#kirim_ke').val();
	var kode		= $('#kode').val();
	var kodebb		= $('#kodebb').val();
	var packing		= $('#packing').val();
	var sat			= $('#sat').val();
	var unit		= $('#unit').val();
	var hrg_sat		= $('#hrg_sat').val();
	var hrg_total	= $('#hrg_total').val();
	var kategori	= $('#kategori').val();
	var ket			= $('#ket').val();
	
	$("#knf_batal").fadeOut("slow").attr({"top":"100px"});
	$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	
	$.post("batal_po.php",{no_po:no_po},function(dataJSON){
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
				$.sticky('Maaf! Data gagal dihapus. No PO belum tersedia di database',function(){
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
	</div><br/><br/>
	
	<div id="gambar_full">
		<img src="../profile/rini.jpg" width="400"/>
	</div>
	<div id="gambar_overlay"></div>
	<div id="gambar_overlay_knf"></div>
	
	<form name="input_po" id="input_po" action="input_po.php" method="POST">
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
			<p>Apakah anda yakin akan menyimpan PO dengan nomor<input type="text" name="no_po_p" id="no_po_p" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="simpan" id="simpan" value="Simpan" class="submitt" onclick="simpan_po()" />
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
			<p>Apakah anda yakin akan memperbarui PO dengan nomor<input type="text" name="no_po_e" id="no_po_e" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="perbarui" id="perbarui" value="Perbarui" class="submitt" onclick="edit_po()"/>
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
			<p>Apakah anda yakin akan MEMBATALKAN PO dengan nomor<input type="text" name="no_po_b" id="no_po_b" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="batal" id="batal" value="Batal" class="submitt" onclick="batal_po()" />
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_batal" id="can_batal" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	<div id="page_cetak_po">
		<div id="bdn_cetakpo">
			<div id="Knf_cetak_po">
				<h4>PURCHASE ORDER<br/>Bandung<br/>PT. Rajawali Hiyoto</h4>
				<table class='tablekiri_po'>
					<tr>
						<td class='td_po'>No Po</td><td> : </td><td><input type="text"  name="no_po_c" id="no_po_c" readonly style="width:130px;" class="form_cet" /></td>
					</tr>
					<tr>
						<td class='td_po'>Tgl Po</td><td> : </td><td><input type="text"  name="tgl_po_c" id="tgl_po_c" readonly style="width:120px;" class="form_cet" /></td>
					</tr>
					<tr>
						<td class='td_po'>Po Untuk</td><td> : </td><td><input type="text"  name="po_untuk_c" id="po_untuk_c" readonly style="width:120px;" class="form_cet" /></td></td>
					</tr>
				</table>
				<table class='tablekiri_po'>
					<tr>
						<td class='td_po'>Supplier</td><td> : </td><td><input type="text"  name="supplier_c" id="supplier_c" readonly style="width:130px;" class="form_cet" /></td>
					</tr>
					<tr>
						<td class='td_po'>ATTN</td><td> : </td><td><input type="text"  name="attn_c" id="attn_c" readonly style="width:120px;" class="form_cet" /></td>
					</tr>
					<tr>
						<td class='td_po'>Kirim Ke</td><td> : </td><td><input type="text"  name="kirim_ke_c" id="kirim_ke_c" readonly style="width:120px;" class="form_cet" /></td>
					</tr>
				</table>
				<table class='tablekiri_po'>
					<tr>
						<td class='td_po'>Tgl Kirim</td><td> : </td><td><b><input type="text"  name="tgl_kirim_c" id="tgl_kirim_c" readonly style="width:130px;" class="form_cet" /></b></td>
					</tr>
					<tr>
						<td class='td_po'>No PPB</td><td> : </td><td><input type="text"  name="no_ppb_c" id="no_ppb_c" readonly style="width:120px;" class="form_cet" /></td>
					</tr>
				</table>
				<br/><br/><br/><br/><hr/>
				<table class='table2_cetak_po' border='1px'>
					<tr>
						<th width='100'>Kode</th><th width='150'>Kode BB</th><th width='40'>Kms</th><th width='30'>Sat</th><th width='50'>Qty</th><th width='70'>Hrg Sat</th><th width='80'>Total</th><th width='95'>Keterangan</th>
					</tr>
					<tr>
						<td height='25'><input type="text"  name="kode_c" id="kode_c" readonly style="width:100px;" class="form_cet" /></td><td><input type="text"  name="kodebb_c" id="kodebb_c" readonly style="width:150px;" class="form_cet" /></td><td><input type="text"  name="packing_c" id="packing_c" readonly style="width:40px;" class="form_cet" /></td><td align='center'><input type="text"  name="sat_c" id="sat_c" readonly style="width:30px;text-align:center;" class="form_cet" /></td><td align='center'><input type="text"  name="unit_c" id="unit_c" readonly style="width:50px;text-align:center;" class="form_cet" /></td><td align='right'>Rp.<input type="text"  name="hrg_sat_c" id="hrg_sat_c" readonly style="width:50px;text-align:right;" class="form_cet" /></td><td align='right'>Rp. <input type="text"  name="hrg_total_c" id="hrg_total_c" readonly style="width:60px;text-align:right;" class="form_cet" /></td><td><input type="text"  name="ket_c" id="ket_c" readonly style="width:95px;" class="form_cet" /></td>
					</tr>
				</table>
				<br/>
				<div id='table_po3'>
				<table >
					<tr>
						<td colspan='2'><b>Catatan :</b></td>
					</tr>
					<tr>
						<td valign='top'>- </td><td align='justify'>Harga dan unit barang tidak dapat diubah jika barang telah dikirim dan pembayaran telah dilunasi</td>
					</tr>
					<tr>
						<td valign='top'>- </td><td align='justify'><b>Jika barang yang dipesan tidak tersedia, mohon diinformasikan secepatnya</b></td>
					</tr>
				</table>
				</div>
				<div id='clear'>
				</div>
				
				<div id='ttdpo'>
					<center>Dibuat Oleh,
					<br/><br/><br/><br/>
					( ........................... )<br/>
					Staff Adm. Procuremen</center>
				</div>
				<div id='ttdpo'>
					<center>Diketahui Oleh,
					<br/><br/><br/><br/>
					( ........................... )<br/>
					Asm. Procuremen</center>
				</div>
				<div id='ttdpo'>
					<center>Disetujui Oleh,
					<br/><br/><br/><br/>
					( ........................... )<br/>
					Sm. Procuremen</center>
				</div>
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
		<div id="bada_program_kiri"><br/>
			<?php profile(); ?>
		</div>
		<div id="bada_program_kanan">
			<br/>
			<div id="title_program">
				<h2>Buka Pembelian (Pembuatan PO)</h2>
			</div><br/>
			<!-- sarching !-->
			<div id='search-box'>
				<form  id="cari" name="cari">
					<input id='search-text' name='q' placeholder="Cari Berdasakan No PO" type="text" />
					<input id='search-button' type='button' onclick="editpo()">
				</form>
			</div><hr/>
			<div id="prog_ppb">
					<div id="progpo_kiri">
						<table>
							<tr>
								<td height="40">No. PO</td><td> : </td><td><input type="text" id="no_po" name="no_po" class="input1" onchange="nopo()" readonly value="<?php echo no_po();?>" style="background-color:blue;color:white;"/></td>
							</tr>
							<tr>
								<td height="40">PO Untuk</td><td> : </td><td><input type="text" id="po_untuk" name="po_untuk" class="input1"  /></td>
							</tr>
							<tr>
								<td height="40">Tanggal</td><td> : </td><td><input type="text" id="tgl_po" name="tgl_po" readonly value="<?php echo tanggal();?>"class="input1" /></td>
							</tr>
							<tr>
								<td height="40">Kategori</td><td> : </td><td><input type="text" id="kategori" name="kategori" readonly class="input1" /></td>
							</tr>
						</table>
					</div>
					<div id="progpo_kanan">
						<table>
							<tr>
								<td height="40">Supplier</td><td> : </td><td><select id="supplier" name="supplier" class="select1" >
								<option value="">--Pilih Supplier--</option>
								<?php select_supplier();?>
								</select></td>
							</tr>
							<tr>
								<td height="40">ATTN</td><td> : </td><td><input type="text" id="attn" name="attn" class="input1"  /></td>
							</tr>
							<tr>
								<td height="40">Tgl Kirim</td><td> : </td><td><input type="text" id="tgl_kirim" name="tgl_kirim" readonly class="input1" /></td>
							</tr>
							<tr>
								<td height="40">Kirim Ke</td><td> : </td><td><input type="text" id="kirim_ke" name="kirim_ke"  class="input1" /></td>
							</tr>
						</table>
					</div>
					<div id="progpo_kanan">
						<table>
							<tr>
								<td height="40">No PPB</td><td> : </td><td><input type="text" id="no_ppb" name="no_ppb"  class="input1" onchange="noppb()" onchange="po_mtr()" /></td>
							</tr>
						</table>
					</div>
					<table class="table1">
						<tr>
							<th width="40">ID</th>
							<th width="100">Kode</th>
							<th width="150">Kode BB</th>
							<th width="100">Packing</th>
							<th width="100">Satuan</th>
							<th width="100">Jml (Unit)</th>
							<th width="100">Hrg Sat</th>
							<th width="100">Hrg Total</th>
						</tr>
						<tr>
							<td>
							<input type="hidden" name="id_cetak" id="id_cetak" value="<?php echo id_cetpo() ?>">
							<input type="text" name="id_nm" id="id_nm" class="inputid" style="text-align:center" value="<?php echo id_po();?>" readonly /></td>
							<td><input type="text" name="kode" id="kode" class="input2" readonly /></td>
							<td><input type="text" name="kodebb" id="kodebb" class="input2" readonly /></td><td><input type="text" name="packing" id="packing" class="input3"  style="text-align:center" /></td>
							<td><input type="text" name="sat" id="sat" class="input3" style="text-align:center" /></td>
							<td><input type="text" name="unit" id="unit" class="input3" style="text-align:center" onchange="hrg_tot()" /></td>
							<td><input type="text" name="hrg_sat" id="hrg_sat" class="input3" style="text-align:center"/></td>
							<td><input type="text" name="hrg_total" id="hrg_total" class="input3" style="text-align:center"/></td>
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
							<input type="submit" class="submitt" value="Data PO" name="datapo" id="datapo"/>
						</div>
						<div id="tomb_eks">
							<input type="submit" class="submitt" value="KELUAR" name="keluar" id="keluar"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div><br/><hr/>

	<?php include "../footer.php";?>
</div>
</body>
</html>