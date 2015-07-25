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
<head><title>Pembuatan PPB | Sistem Inventory IWU</title></head>

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
  $("#no_po").autocomplete({
	source: "po_autocomplate_btb.php",
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
	$('#search-text').autocomplete({
		source: "btb_autocomplate.php",
		autoFocus: true,
	});
	$("#refresh_p").click(function(){
		$("#knf_refresh").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_refresh").click(function(){
		$("#knf_refresh").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#simpan_p").click(function(){
		var no_btb = $('#no_btb').val();
		$('#no_btb_p').val(no_btb+" ?");
		$("#knf_save").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_save").click(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#edit_p").click(function(){
		var no_btb = $('#no_btb').val();
		$('#no_btb_e').val(no_btb+" ?");
		$("#knf_edit").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_edit").click(function(){
		$("#knf_edit").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#batal_p").click(function(){
		var no_btb = $('#no_btb').val();
		$('#no_btb_b').val(no_btb+" ?");
		$("#knf_batal").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_batal").click(function(){
		$("#knf_batal").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#cetak").click(function(){
		var no_btb		= $('#no_btb').val();
		var no_sj		= $('#no_sj').val();
		var no_po		= $('#no_po').val();
		var supplier	= $('#supplier').val();
		var no_ppb 		= $('#no_ppb').val();
		var tgl_btb 		= $('#tgl_btb').val();
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
		$('#no_btb_c').val(no_btb);
		$('#no_sj_c').val(no_sj);
		$('#supplier_c').val(supplier);
		$('#no_ppb_c').val(no_ppb);
		$('#tgl_btb_c').val(tgl_btb);
		$('#kode_c').val(kode);
		$('#kodebb_c').val(kodebb);
		$('#packing_c').val(packing);
		$('#sat_c').val(sat);
		$('#unit_c').val(unit);
		$('#hrg_sat_c').val(hrg_sat);
		$('#hrg_total_c').val(hrg_total);
		$('#kategori_c').val(kategori);
		$('#ket_c').val(ket);
		
		$('#Knf_cetak').attr({"style":"border:10px solid #00FF00"});
		$("#page_cetak").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_print").click(function(){
	$("#page_cetak").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#cetak_p").bind("click",function(event){
		$('#Knf_cetak_po').attr({"style":"border:none"});
		$('#Knf_cetak').printArea();
		$("#page_cetak").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
});
function hrg_tot(){
	var unit = $('#unit').val();
	var hrg = $('#hrg_sat').val();
	var total = unit * hrg;
	
	document.input_btb.hrg_total.value=total;
}

function tampil_btb(){
	var no_btb = $('#search-text').val();
	
	if(no_btb==""){
		$('#no_btb').val('');
		$('#tgl_btb').val('');
		$('#no_sj').val('');
		$('#no_po').val('');
		$('#supplier').val('');
		$('#kategori').val('');
		$('#kode').val('');
		$('#kodebb').val('');
		$('#packing').val('');
		$('#sat').val('');
		$('#unit').val('');
		$('#hrg_sat').val('');
		$('#hrg_total').val('');
		$('#ket').val('');
	}else{
		$.post("edit_btb.php", {no_btb: no_btb}, function(dataJSON){
			var data = jQuery.parseJSON(dataJSON);
			$('#no_btb').val(data.no_btb);
			$('#tgl_btb').val(data.tgl_btb);
			$('#no_sj').val(data.no_sj);
			$('#no_po').val(data.no_po);
			$('#supplier').val(data.supplier);
			$('#kategori').val(data.kategori);
			$('#kode').val(data.kode);
			$('#kodebb').val(data.kodebb);
			$('#packing').val(data.packing);
			$('#sat').val(data.sat);
			$('#unit').val(data.unit);
			$('#hrg_sat').val(data.hrg_sat);
			$('#hrg_total').val(data.hrg_total);
			$('#ket').val(data.ket);
		});
	
	}
}

function tampilpo(){
	var no_po	= $('#no_po').val();
	
	if(no_po==""){
		$('#supplier').val('')
		$('#kategori').val('')
		$('#kode').val('')
		$('#kodebb').val('')
		$('#packing').val('')
		$('#sat').val('')
		$('#hrg_sat').val('')
	}else{
		$.post("tampilkanpo.php",{no_po: no_po},function(dataJSON){
			var data = jQuery.parseJSON(dataJSON);
			$('#supplier').val(data.supplier)
			$('#kategori').val(data.kategori)
			$('#kode').val(data.kode)
			$('#kodebb').val(data.kodebb)
			$('#packing').val(data.packing)
			$('#sat').val(data.sat)
			$('#hrg_sat').val(data.hrg_sat)
		});
	}
}

function simpan_btb(){
		var id_nm	= $('#id_nm').val();
		var no_btb	= $('#no_btb').val();
		var tgl_btb	= $('#tgl_btb').val();
		var no_sj	= $('#no_sj').val();
		var no_po	= $('#no_po').val();
		var supplier= $('#supplier').val();
		var kategori= $('#kategori').val();
		var kode	= $('#kode').val();
		var kodebb	= $('#kodebb').val();
		var packing	= $('#packing').val();
		var sat		= $('#sat').val();
		var unit	= $('#unit').val();
		var hrg_sat	= $('#hrg_sat').val();
		var hrg_total	= $('#hrg_total').val();
		var ket		= $('#ket').val();
	
	$("#knf_save").fadeOut("slow").attr({"top":"100px"});
	$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	
	$.post("simpan_btb.php",{id_nm:id_nm, no_po:no_po, no_sj:no_sj, supplier:supplier, no_btb:no_btb, tgl_btb:tgl_btb, kode:kode, kodebb:kodebb, packing:packing, sat:sat, unit:unit, hrg_sat:hrg_sat, hrg_total:hrg_total, kategori:kategori, ket:ket},function(dataJSON){
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

function edit_btb(){
	var id_nm	= $('#id_nm').val();
		var no_btb	= $('#no_btb').val();
		var tgl_btb	= $('#tgl_btb').val();
		var no_sj	= $('#no_sj').val();
		var no_po	= $('#no_po').val();
		var supplier= $('#supplier').val();
		var kategori= $('#kategori').val();
		var kode	= $('#kode').val();
		var kodebb	= $('#kodebb').val();
		var packing	= $('#packing').val();
		var sat		= $('#sat').val();
		var unit	= $('#unit').val();
		var hrg_sat	= $('#hrg_sat').val();
		var hrg_total	= $('#hrg_total').val();
		var ket		= $('#ket').val();
	
	$("#knf_edit").fadeOut("slow").attr({"top":"100px"});
	$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	
	$.post("edit_btb_prs.php",{id_nm:id_nm, no_po:no_po, no_sj:no_sj, supplier:supplier, no_btb:no_btb, tgl_btb:tgl_btb, kode:kode, kodebb:kodebb, packing:packing, sat:sat, unit:unit, hrg_sat:hrg_sat, hrg_total:hrg_total, kategori:kategori, ket:ket},function(dataJSON){
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
				$.sticky('Data yang ingin anda perbarui belum tertsedia',function(){
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

function batal_btb(){
	var no_btb	= $('#no_btb').val();
		
	$("#knf_batal").fadeOut("slow").attr({"top":"100px"});
	$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	
	$.post("batal_btb.php",{no_btb:no_btb},function(dataJSON){
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
				$.sticky('Maaf! Data yang ingin anda batalkan belum tertsedia',function(){
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
		<img src="../profile/ejang.jpg" width="500"/>
	</div>
	<div id="gambar_overlay"></div>
	<div id="gambar_overlay_knf"></div>
	
	<form name="input_btb" id="input_btb" action="input_btb.php" method="POST">
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
			<p>Apakah anda yakin akan menyimpan BTB dengan nomor<input type="text" name="no_btb_p" id="no_btb_p" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" onclick="simpan_btb()" name="simpan" id="simpan" value="Simpan" class="submitt"/>
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
			<p>Apakah anda yakin akan memperbarui BTB dengan nomor<input type="text" name="no_btb_e" id="no_btb_e" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="perbarui" id="perbarui" value="Perbarui" class="submitt" onclick="edit_btb()"/>
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
			<p>Apakah anda yakin akan MEMBATALKAN PPB dengan nomor<input type="text" name="no_btb_b" id="no_btb_b" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="button" name="batal" id="batal" value="Batal" class="submitt" onclick="batal_btb()"/>
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_batal" id="can_batal" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	<div id="page_cetak">
		<div id="Knf_cetak">
			<h3>Bukti Terima Barang<br/>BTB</h3>
			<table class='tablekiri_po'>
				<tr>
					<td class='td_po'>No BTB</td><td> : </td><td><input type="text"  name="no_btb_c" id="no_btb_c" readonly style="width:130px;" class="form_cet" /></td>
				</tr>
				<tr>
					<td class='td_po'>Tgl BTB</td><td> : </td><td><input type="text"  name="tgl_btb_c" id="tgl_btb_c" readonly style="width:120px;" class="form_cet" /></td>
				</tr>
				<tr>
					<td class='td_po'>No Surat Jalan</td><td> : </td><td><input type="text"  name="no_sj_c" id="no_sj_c" readonly style="width:130px;" class="form_cet" /></td>
				</tr>
			</table>
			<table class='tablekiri_po'>
				<tr>
					<td class='td_po'>Supplier</td><td> : </td><td><input type="text"  name="supplier_c" id="supplier_c" readonly style="width:130px;" class="form_cet" /></td>
				</tr>
				<tr>
					<td class='td_po'>No Po</td><td> : </td><td><input type="text"  name="no_po_c" id="no_po_c" readonly style="width:130px;" class="form_cet"  /></td>
				</tr>
				<tr>
					<td class='td_po'>Kategori</td><td> : </td><td><input type="text"  name="kategori_c" id="kategori_c" readonly style="width:120px;" class="form_cet" /></td>
				</tr>
			</table>
			<table class='tablekiri_po'>
				
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
				<h2>Program Penerimaan Barang</h2>
			</div>
			<br/>
			<div id='search-box'>
				<input id='search-text' name='search-text' placeholder="Cari Berdasakan No BTB" type="text"/>
				<input type="button" id='search-button' onclick="tampil_btb()" class="button_search">
			</div><hr/>
			
			
			<div id="prog_ppb">
					<table>
						<tr>
							<td height="40">No. BTB</td>
							<td> : </td>
							<td><input type="text" id="no_btb" name="no_btb" class="input1" style="cursor:not-allowed;background-color:orange;" readonly value="<?php echo nobtb();?>"/></td>
						</tr>
						<tr>
							<td height="40">Tanggal</td>
							<td> : </td>
							<td><input type="text" id="tgl_btb" name="tgl_btb" value="<?php echo tanggal();?>" readonly style="cursor:not-allowed;" class="input1" /></td>
						</tr>
						<tr>
							<td height="40">No Surat Jalan</td>
							<td> : </td>
							<td><input type="text" id="no_sj" name="no_sj" class="input1" /></td>
						</tr>
						<tr>
							<td height="40">No PO</td>
							<td> : </td>
							<td><input type="text" id="no_po" name="no_po" class="input1" onchange="tampilpo()" /></td>
						</tr>
						<tr>
							<td height="40">Supplier</td>
							<td> : </td>
							<td><input type="text" id="supplier" name="supplier" class="input1" readonly style="cursor:not-allowed;"/></td>
						</tr>
						<tr>
							<td height="40">Kategori</td>
							<td> : </td>
							<td><input type="text" id="kategori" name="kategori" class="input1" readonly style="cursor:not-allowed;"/></td>
						</tr>
					</table>
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
							<input type="text" name="id_nm" id="id_nm" class="inputid" style="text-align:center" value="<?php echo id_btb();?>" readonly /></td>
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
							<input type="submit" class="submitt" value="Data BTB" name="databtb" id="databtb"/>
						</div>
						<div id="tomb_eks">
							<input type="submit" class="submitt" value="KELUAR" name="keluar" id="keluar"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div><br/><br/><br/>
	
	<hr/>
	<?php include "../footer.php";?>
</div>

</body>
</html>