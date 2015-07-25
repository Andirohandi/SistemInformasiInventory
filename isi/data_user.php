<?php
session_start();

if(!isset($_SESSION['username'])){
	echo "<script>alert('Maaf Anda Harus Login Terlebih dahulu');
	window.location='../index.php';
	</script>";
}
include "../koneksi.php";
include "gedget/tanggal.php";
include "fungsifungsi.php";
?>

<html>
<head><title>Data Pembelian PO | Sistem Inventory IWU</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script src="../js/jquery.easytabs.js"  type="text/javascript"></script>
<script src="../js/jquery.easytabs.min.js"  type="text/javascript"></script>
<script src="../js/jquery.hashchange.min.js"  type="text/javascript"></script>
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
  $( "#tab-container2" ).easytabs();
  $("#can_save").click(function(){
		$("#form_edit_user").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
});
//ONLOAD
$(document.body).append('<div id="page-loader"></div>');

$(window).on("beforeunload", function() {
    // ... tampilkan tabir animasi dengan efek `.fadeIn()`
    $('#page-loader').fadeIn(700).delay(10000).fadeOut(3000);
});

function edit_user(i){
	
	$.post("edit_user.php",{i:i},function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		$('#username').val(data.username);
		$('#password').val(data.password);
		$('#nama').val(data.nama);
		$('#no_telp').val(data.no_telp);
		$('#email').val(data.email);
		$('#jk').val(data.jk);
		$('#agama').val(data.agama);
		$('#alamat').val(data.alamat);
		
		
		$("#form_edit_user").slideDown("slow");
		$("#gambar_overlay_knf").fadeTo("normal", 0.4);
	});
}

function simpan_data_user(){
	
	var username = $('#username').val();
	var password = $('#password').val();
	var nama = $('#nama').val();
	var no_telp = $('#no_telp').val();
	var email = $('#email').val();
	var jk = $('#jk').val();
	var agama = $('#agama').val();
	var alamat = $('#alamat').val();
	
	$.post("simpan_data_user.php",{username:username, password:password, nama:nama, no_telp:no_telp, email:email, email:email, jk:jk, agama:agama, alamat:alamat}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		
		if(data.confirm==1){
			setInterval(function(){window.location.reload()},1000);
		}else{
		
		}
	});
	
	$(document).ready(function(){
		$("#form_edit_user").fadeOut("slow").attr({"top":"100px"});
		$("#gambar_overlay_knf").fadeOut("slow").attr({"top":"100px"});
	});
}

function kembali(){
	window.history.go(-1);
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
	<!-- iSI disini !-->
	<div id="badan_program">
		
		<div id="bada_program_kananpo">
			<br/>
			<div id="title_program">
				<h2>Data USER</h2>
			</div>
			<br/>
			<!-- Back !-->
			<div id="kmbl">
				<img src="../image/kmbli.png" height="30px" onclick="kembali()" />
			</div>
			
			<!-- sarching !-->
			<div id='search-box'>
				<form action="" id="cari" name="cari" method="POST">
				<input id='search-text' name='q' placeholder="Cari" type="text" onkeyup="cari2(this.value)" />
				<input id='search-button' type='button'>
				</form>
			</div>
			
			<hr/>
			<div id='form_edit_user'>
				<div id='head_knf'>
					<h2>Edit User</h2>
				</div>
					<table align='center' border="1px" style="border-collapse:collapse;margin-top:10;">
						<tr>
							<th width="120px" height='30' class='th_e_u' >Username</th>
							<th width="120px" class='th_e_u'>Password</th>
							<th width="130px" class='th_e_u'>Nama</th>
							<th width="100px" class='th_e_u'>No Telp</th>
							<th width="120px" class='th_e_u'>Email</th>
							<th width="70px" class='th_e_u'>JK</th>
							<th width="100px" class='th_e_u'>Agama</th>
							<th width="200px" class='th_e_u'>Alamat</th>
						</tr>
						<tr>
							<td><input type='text' name='username' id='username' width='120' class='inp_e_u' readonly /></td>
							<td><input type='text' name='password' id='password' width='120' class='inp_e_u' /></td>
							<td><input type='text' name='nama' id='nama' width='130' class='inp_e_u' /></td>
							<td><input type='text' name='no_telp' id='no_telp' width='100' class='inp_e_u' /></td>
							<td><input type='text' name='email' id='email' width='120' class='inp_e_u' /></td>
							<td><input type='text' name='jk' id='jk' width='70' class='inp_e_u' /></td>
							<td><input type='text' name='agama' id='agama' width='100' class='inp_e_u' /></td>
							<td><input type='text' name='alamat' id='alamat' width='200' class='inp_e_u' /></td>
						</tr>
					</table>
					<br/><br/>
					<div id="ktk_eks">
						<div id="tomb_eks_knf">
							<input type="button" onclick="simpan_data_user()" name="simpan" id="simpan" value="Simpan" class="submitt"/>
						</div>
						<div id="tomb_eks_knf">
							<input type="button" name="can_save" id="can_save" value="Kembali" class="submitt"/>
						</div>
					</div>
				
			
			</div>
			<div id="gambar_overlay_knf"></div>
			<!----- Iisisi Disini !-->
			
			<div id="prog_po">
				<div id="tab-container2" class="tab-container2">
					<ul class="etabs">
						<li class="tab"><a href="#tabs-1"><?php custom_date(); ?></a></li>
					</ul>
					<br/><br/>
					<div id="tabs-1">
						<table border="1px" style="border-collapse:collapse">
						<thead>
							<tr height="50px">
								<th width="30px">No</th>
								<th width="120px">Username</th>
								<th width="120px">Password</th>
								<th width="130px">Nama</th>
								<th width="100px">No Telp</th>
								<th width="120px">Email</th>
								<th width="70px">JK</th>
								<th width="100px">Agama</th>
								<th width="200px">Alamat</th>
								<th width="50px">Edit</th>
							</tr>
						</thead>
						<tbody id="table_body">
							<?php user()?>
						</tbody>
					</table>
					<br/><br/>
					</div>
				</div>
				<br/><br/>
			</div>
		</div>
	
	
	
	</div>
	<br/>
	<hr/>
	<?php include "../footer.php";?>
</div>
</body>
</html>