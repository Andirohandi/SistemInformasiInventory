<?php
session_start();

if(!isset($_SESSION['username'])){
	echo "<script>alert('Maaf Anda Harus Login Terlebih dahulu');
	window.location='../index.php';
	</script>";
}
include "gedget/tanggal.php";
include "../koneksi.php";
?>

<html>
<head><title>Input Master Supplier</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">


<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script src="../js/printArea.js"></script>

<script>
$(document).ready(function(){
	$("#simpan_p").click(function(){
		$("#knf_save_m").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
	$("#can_save").click(function(){
		$("#knf_save").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
});	
</script>
<body>

<div id="ims">
	<div id="gambar_overlay_knf"></div>
	<form name="i_mst_s" id="i_mst_s" action="input_mst_s.php" method="POST">
	<div id="knf_save_m">
		<div id="head_knf">
			<h2>Konfirmasi Penyimpanan</h2>
			<p>Simpan Master Supplier ??</p>
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
	<div id="bdn_ims">
		<div id="title_ims">
			<h3>Input Master Supplier</h3>
		</div>
		<br/>
		
		<table class="table_ims">
			<tr>
				<td>Nama Supplier :</td>
			</tr>
			<tr>
				<td><input type="text" id="supplier" name="supplier" class="input_ims" /></td>
			</tr>
			<tr>
				<td>No Telp :</td>
			</tr>
			<tr>
				<td><input type="text" id="no_telp" name="no_telp" class="input_ims" /></td>
			</tr>
			<tr>
				<td>Email :</td>
			</tr>
			<tr>
				<td><input type="text" id="email" name="email" class="input_ims" /></td>
			</tr>
			<tr>
				<td>Alamat :</td>
			</tr>
			<tr>
				<td><input type="text" id="alamat" name="alamat" class="input_ims" /></td>
			</tr>
			<tr>
				<td>ATTN :</td>
			</tr>
			<tr>
				<td><input type="text" id="attn" name="attn" class="input_ims" /></td>
			</tr>
			<tr>
				<td>Kategori :</td>
			</tr>
			<tr>
				<td><select type="text" id="kategori" name="kategori" class="input_ims" >
				<option value=""></option>
				<option value="Bahan Baku">Bahan Baku</option>
				<option value="Dus">Dus</option>
				<option value="Kemasan">Kemasan</option>
				</select></td>
			</tr>
			<tr>
				<td>Keterangan :</td>
			</tr>
			<tr>
				<td><textarea id="ket" name="ket" class="text_ims"></textarea></td>
			</tr>
		</table>
		<br/>
		<div id="tomb_eks_ims">
			<input type="button" name="simpan_p" id="simpan_p" value="Simpan "class="submitt"/>
		</div>
		<div id="tomb_eks_ims">
			<input type="submit" name="batal" id="simpan" value="Batal" class="submitt"/>
		</div>
		</form>
	</div>


</div>
</body>
</html>
