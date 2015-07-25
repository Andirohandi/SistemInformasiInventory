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
<head><title>Input Master Barang | Sistem Inventory IWU</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
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
	$( "#kode" ).autocomplete({
		source: "autocomplete.php",
	});
	$("#search-text").autocomplete({
		source: "autocompletmstkmsdus.php",
		autoFocus: true,
	});
	$("#search-text2").autocomplete({
		source: "autocompletmstbahan.php",
		autoFocus: true,
	});
	$("#button_mst").click(function(){
		$("#mst_kms2").hide("slow");
		$("#mst_kms").show("slow");
	});
	$("#button_mst2").click(function(){
		$("#mst_kms").hide("slow");
		$("#mst_kms2").show("slow");
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
		var kode = $('#kode').val();
		$('#kode_p').val(kode+" ?");
		$("#knf_save").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_save").click(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
	$("#edit_p").click(function(){
		var no_ppb = $('#no_ppb').val();
		$('#no_ppb_e').val(no_ppb+" ?");
		$("#knf_edit").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_edit").click(function(){
		$("#knf_edit").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
});

function kat(){
	var kategori = $('#kategori').val();
	var kodekat = "";
	var kodebbkat = "";
	
	if(kategori=="Dus"){
		kodekat = "DS";
		kodebbkat = "DUS";
	}else if(kategori=="Kemasan"){
		kodekat = "KM"
		kodebbkat = "CONT";
	}else{
		kodekat = ""
		kodebbkat = "";
	}
	
	document.i_ms_k.kode_kat.value=kodekat;
	document.i_ms_k.kodebb_kat.value=kodebbkat;
}

function jp(){
	var jns_prod = $('#jns_prod').val();
	
	if(jns_prod==""){
		$('#kode_jprod').val('');
		$('#kodebb_jp').val('');
	}else{
		$.post("postjp.php", {jns_prod: jns_prod},function(dataJSON){
			data = jQuery.parseJSON(dataJSON);
			$('#kode_jprod').val(data.kode_jprod);
			$('#kodebb_jp').val(data.kodebb_jp);
		});
	}
	$('#jns_prod').attr({"style":"background:none"});
}

function qty(){
	var qty_prod = $('#qty_prod').val();
	var qty_jprod1 = "";
	var qty_jp1 = "";
	
	if(qty_prod==""){
		qty_jprod1 = "";
		qty_jp1 = "";
	}else if(qty_prod=="satu"){
		qty_jprod1 ="01";
		qty_jp1 = "KG";
	}else if(qty_prod=="nol"){
		qty_jprod1 ="0.2";
		qty_jp1 = "200 CC";
	}else if(qty_prod=="lima"){
		qty_jprod1 = "05";
		qty_jp1 = "GL";
	}else{
		qty_jprod1 = "25";
		qty_jp1 = "PL";
	}
	
	document.i_ms_k.qty_jprod.value=qty_jprod1;
	document.i_ms_k.qty_jp.value=qty_jp1;
	$('#qty_prod').attr({"style":"background:none"});
}

function kode1(){
	var supplier	= $('#supplier').val();
	var kode_kat	= $('#kode_kat').val();
	var kodebb_kat 	= $('#kodebb_kat').val();
	var qty_jprod	= $('#qty_jprod').val()
	var qty_jp		= $('#qty_jp').val()
	var kode_jprod 	= $('#kode_jprod').val();
	var kodebb_jp 	= $('#kodebb_jp').val();
	var kode2 = "";
	var kode2 = "";
	
	if(supplier==""){
		kode2	 	= "";
		kodebb2 	= "";
	}else{
		kode2	 	= kode_kat + kode_jprod + qty_jprod;
		kodebb2 	= kodebb_kat +" "+ kodebb_jp +" "+ qty_jp;
	}
	document.i_ms_k.kode.value=kode2;
	document.i_ms_k.kodebb.value=kodebb2;
}

function lihat(){
	var kode	= $('#search-text').val();
	
	if(kode==""){
		$('#id').val('');
		$('#kategori').val('');
		$('#jns_prod').val('');
		$('#qty_prod').val('');
		$('#sat').val('');
		$('#smin').val('');
		$('#packing').val('');
		$('#rop').val('');
		$('#isi').val('');
		$('#smax').val('');
		$('#supplier').val('');
		$('#hrg_sat').val('');
		$('#kode').val('');
		$('#kodebb').val('');
		$('#LT').val('');
		$('#ket').val('');
	}else{
		$.post("panggil_mkd.php", {kode:kode}, function(dataJSON){
			var data = jQuery.parseJSON(dataJSON);
			$('#id').val(data.id);
			$('#kategori').val(data.kategori);
			$('#sat').val(data.sat);
			$('#smin').val(data.smin);
			$('#packing').val(data.packing);
			$('#rop').val(data.rop);
			$('#isi').val(data.isi);
			$('#smax').val(data.smax);
			$('#supplier').val(data.supplier);
			$('#hrg_sat').val(data.hrg_sat);
			$('#kode').val(data.kode);
			$('#kodebb').val(data.kodebb);
			$('#LT').val(data.LT);
			$('#ket').val(data.ket);
			
			if(data.kategori=="Kemasan"){
				$('#kode_kat').val("KM");
				$('#kodebb_kat').val("CONT");
			}else{
				$('#kode_kat').val("DS");
				$('#kodebb_kat').val("DUS");
			}
			
			$('#jns_prod').attr({"style":"background:yellow"});
			$('#qty_prod').attr({"style":"background:yellow"});
		});
	}
}

function lihat2(){
	var kode	= $('#search-text2').val();
	
	if(kode==""){
		$('#id2').val('');
		$('#kategori2').val('');
		$('#sat2').val('');
		$('#smin2').val('');
		$('#packing2').val('');
		$('#rop2').val('');
		$('#isi2').val('');
		$('#smax2').val('');
		$('#supplier2').val('');
		$('#hrg_sat2').val('');
		$('#kode2').val('');
		$('#kodebb2').val('');
		$('#LT2').val('');
		$('#ket2').val('');
	}else{
		$.post("panggil_mb.php", {kode:kode}, function(dataJSON){
			var data = jQuery.parseJSON(dataJSON);
			$('#id2').val(data.id);
			$('#kategori2').val(data.kategori);
			$('#sat2').val(data.sat);
			$('#smin2').val(data.smin);
			$('#packing2').val(data.packing);
			$('#rop2').val(data.rop);
			$('#isi2').val(data.isi);
			$('#smax2').val(data.smax);
			$('#supplier2').val(data.supplier);
			$('#hrg_sat2').val(data.hrg_sat);
			$('#kode2').val(data.kode);
			$('#kodebb2').val(data.kodebb);
			$('#LT2').val(data.LT);
			$('#ket2').val(data.ket);
			
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
	</div><br/><br/>
	
	
	<div id="gambar_full">
		<img src="../profile/rini.jpg" width="400"/>
	</div>
	<div id="gambar_overlay"></div>
	<div id="gambar_overlay_knf"></div>
	
	<form name="i_ms_k" id="i_ms_k" action="i_ms_k.php" method="POST" >
	<div id="knf_save">
		<div id="head_knf">
			<h2>Konfirmasi Penyimpanan</h2>
			<p>Apakah anda yakin ingin menyimpan master <input type="text" name="kode_p" id="kode_p" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="submit" name="simpan" id="simpan" value="Simpan" class="submitt"/>
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
			<p>Apakah anda yakin akan memperbarui master<input type="text" name="kode_p" id="kode_p" readonly class="knf_form"/></p>
			<div id="ktk_eks">
				<div id="tomb_eks_knf">
					<input type="submit" name="perbarui" id="perbarui" value="Perbarui" class="submitt"/>
				</div>
				<div id="tomb_eks_knf">
					<input type="button" name="can_edit" id="can_edit" value="Kembali" class="submitt"/>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="id" id="id" value="<?php id_mstr(); ?>" />
	<div id="badan_program">
		<div id="bada_program_kiri"><br/>
			<?php profile();?>
		</div>
		<div id="bada_program_kanan">
			<br/>
			<div id="title_program">
				<h2>Input Master Barang</h2>
			</div><br/>
			<!--BACK!-->
			<div id="kmbl">
				<a href="pembelian_barang.php"><img src="../image/kmbli.png" height="30px"></a>
			</div><hr/>
			
			<!--SEARCH--- !-->
			<div id="prog_ppb"><br/>
				<div id="button_mst">
					<h4>Input Master Dus dan Kemasan</h4>
				</div>
				<div id="button_mst2">
					<h4>Input Master Bahan Bakun</h4>
				</div>
				<div id="mst_kms">
					<br/><br/>
					<div id="kotak_cari">
						<div id='search-box'>
							<input id='search-text' name='search-text' placeholder="Cari" type="text"/>
							<input type="button" id='search-button' onclick="lihat()" class="button_search">
						</div>
					</div>
					<div id="mst_isi">
						<br/><br/><br/>
						
							<table>
								<tr>
									<td>Kategori</td><td> : </td><td><select name="kategori" id="kategori" class="input1" onchange="kat()">
									<option value=""></option>
									<option value="Dus">Dus</option>
									<option value="Kemasan">Kemasan</option>
									</td><td width="50"></td><td></td><td><input type="text" id="kode_kat" name="kode_kat" readonly class="input1" placeholder="kode" /></td><td width="50" ></td><td><input type="text" id="kodebb_kat" name="kodebb_kat" readonly class="input1" placeholder="kodebb" /></td>
								</tr>
								<tr>
									<td>Jenis Produk</td><td> : </td><td><select id="jns_prod" name="jns_prod" readonly class="input1" onchange="jp()" >
										<option value="" style="margin-top:10px"></option>
										<?php select_jenis_produk();?>
									</select>
									</td><td></td><td></td><td><input type="text" id="kode_jprod" name="kode_jprod" class="input1" placeholder="kode" /></td><td width="50" ></td><td><input type="text" id="kodebb_jp" name="kodebb_jp" readonly class="input1" placeholder="kodebb" /></td>
								</tr>
								<tr>
								<td>Qty Prod</td><td> : </td><td>
								<select name="qty_prod" id="qty_prod" class="input1" onchange="qty()" >
									<option value=""></option>
									<option value="nol">0.2 Kg</option>
									<option value="satu">1 Kg</option>
									<option value="lima">5 Kg</option>
									<option value="dualima">25 Kg</option>
								
								</select>
								</td><td></td><td></td><td><input type="text" id="qty_jprod" name="qty_jprod" class="input1" placeholder="kode" /></td><td width="50" ></td><td><input type="text" id="qty_jp" name="qty_jp" readonly class="input1" placeholder="kodebb" /></td>
								</tr>
								<tr>
								<td>Satuan</td><td> : </td><td><input type="text" id="sat" name="sat" class="inputid" value="1"/>
								</td><td></td><td></td><td></td><td >Smin</td><td><input type="text" id="smin" name="smin" class="input1"/></td>
								</tr>
								<tr>
								<td>Packing</td><td> : </td><td><input type="text" id="packing" name="packing" class="inputid" value="Pcs"/>
								</td><td></td><td></td><td></td><td width="50" >ROP</td><td><input type="text" id="rop" name="rop" class="input1"/></td>
								</tr>
								<tr>
								<td>Isi</td><td> : </td><td><input type="text" id="isi" name="isi" class="inputid"/> kmsn dlm satu dus
								</td><td></td><td></td><td></td><td width="50" >Smax</td><td><input type="text" id="smax" name="smax" class="input1"/></td>
								</tr>
								<td>Supplier</td><td> : </td><td>
								<select id="supplier" name="supplier" class="select1" onchange="kode1()">
								<option value="">--Pilih Supplier--</option>
								
								<?php
									$sup = "SELECT * FROM master_supplier";
									$qrsup = mysql_query($sup);
									$jmlsup = mysql_num_rows($qrsup);
									
									if($jmlsup>0){
										while($row = mysql_fetch_assoc($qrsup)){
											$a = $row['supplier'];
											
											echo "<option value='$a'>$a</option>";
										}
									}
								?>
								
								</select>
								</td><td></td><td></td><td></td><td width="50" >Harga</td><td><input type="text" id="hrg_sat" name="hrg_sat" class="input1"/></td>
								</tr>
							</table>
							<br/>
							Preview Kode :
							<table>
								<tr>
									<th>Kode</th><th>KodeBB</th><th>LT Pemesanan</th>
								</tr><tr>
									<td><input type="text" class="input2" name="kode" id="kode"></td><td><input type="text" class="input2" name="kodebb" id="kodebb"></td><td align='center'><input type="text" class="input2" name="LT" id="LT"></td>
								</tr>
							</table>
							<br/>
							<table>
								<tr>
									<td valign="top" style="padding-top:6px">Keterangan :</td><td><textarea id="ket" name="ket" class="textarea2" > </textarea></td>
								</tr>
							</table>
							<br/><br/>
							<div id="kotak_eksekusi">
								<div id="tomb_eks">
									<input type="button" name="simpan_p" id="simpan_p" value="Simpan" class="submitt"/>
								</div>
								<div id="tomb_eks">
									<input type="button" name="edit_p" id="edit_p" class="submitt" value="Perbarui"/>
								</div>
								<div id="tomb_eks">
									<input type="submit" name="batal" id="batal" class="submitt" value="Batal"/>
								</div>
								<div id="tomb_eks">
									<input type="submit" class="submitt" value="KELUAR" name="keluar" id="keluar"/>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				<div id="mst_kms2">
					<br/><br/>
					<div id="kotak_cari2">
						<div id="kotak_cari">
							<div id='search-box'>
								<input id='search-text2' name='search-text' placeholder="Cari" type="text"/>
								<input type="button" id='search-button' onclick="lihat2()" class="button_search">
							</div>
						</div>
					</div>
					<br/>
					<div id="mst_isi2">
					<br/>
						<form name="i_ms_b" id="i_ms_b" action="i_ms_b.php" method="POST" >
							<input type="hidden" name="id2" id="id2" value="<?php id_mstr(); ?>" />
							<table>
								<tr>
									<td>Kategori</td><td> : </td><td><input type="text" name="kategori2" id="kategori2" readonly value="Bahan Baku" class="input2" /></td>
								</tr>
								<tr/>
								<td>Kode</td><td> : </td><td><input type="text" class="input1" name="kode2" id="kode2">
								</td><td></td><td></td><td></td><td >Smin</td><td>: <input type="text" id="smin2" name="smin2" class="input1"/></td>
								<tr/>
								<tr>
								<td>KodeBB</td><td> : </td><td><input type="text" class="input1" name="kodebb2" id="kodebb2"></td><td align='center'>
								</td><td></td><td><td >ROP</td><td>: <input type="text" id="rop2" name="rop2" class="input1"/></td><td></td><td ></td><td></td>
								</tr>
								<tr>
								<td>Packing</td><td> : </td><td><input type="text" id="packing2" name="packing2" class="inputid" />
								</td>
								<td></td><td></td><td></td><td >Smax</td><td>: <input type="text" id="smax2" name="smax2" class="input1"/></td>
								</tr>
								<tr>
								<td>Satuan (kg)</td><td> : </td><td><input type="text" id="sat2" name="sat2" class="inputid" />
								</td><td></td><td></td><td></td><td>Lead Time</td><td>: <input type="text" id="LT2" name="LT2" class="input1"/></td>
								</tr>
								<td>Supplier</td><td> : </td><td>
								<select id="supplier2" name="supplier2" class="select1">
								<option value="">--Pilih Supplier--</option>
								
								<?php
									$sup = "SELECT * FROM master_supplier";
									$qrsup = mysql_query($sup);
									$jmlsup = mysql_num_rows($qrsup);
									
									if($jmlsup>0){
										while($row = mysql_fetch_assoc($qrsup)){
											$a = $row['supplier'];
											
											echo "<option value='$a'>$a</option>";
										}
									}
								?>
								
								</select>
								</td><td></td><td></td><td></td><td width="50" >Harga</td><td>: <input type="text" id="hrg_sat2" name="hrg_sat2" class="input1"/></td>
								</tr>
							</table>
							<br/>
							<table>
								<tr>
									<td valign="top" style="padding-top:6px">Keterangan :</td><td><textarea id="ket2" name="ket2" class="textarea2" > </textarea></td>
								</tr>
							</table>
							<br/><br/>
							<div id="kotak_eksekusi">
								<div id="tomb_eks">
									<input type="submit" name="simpan" id="simpan" value="Simpan" class="submitt"/>
								</div>
								<div id="tomb_eks">
									<input type="submit" name="perbarui" id="perbarui" class="submitt" value="Perbarui"/>
								</div>
								<div id="tomb_eks">
									<input type="submit" name="batal" id="batal" class="submitt" value="Batal"/>
								</div>
								<div id="tomb_eks">
									<input type="submit" class="submitt" value="KELUAR" name="keluar" id="keluar"/>
								</div>
							</div>
						</form>
					
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<br/>
	<br/>
	<br/><br/><br/><br/><br/><br/><br/>
	<hr/>
	<?php include "../footer.php";?>
</div>
</body>
</html>