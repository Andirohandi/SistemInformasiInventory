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
<head><title>Data Pembelian PO | Sistem Inventory IWU</title></head>

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
	$("#tgl_ppb").datepicker({
		changeMonth : true,
		changeYear : true
	});
	$("#simpan_p").click(function(){
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
	$("#kirim").click(function(){
		var id_nm 	= $("#id_nm").val();
		var waktu	= $("#waktu").val();
		var status = $("#status").val();
		
		$.post("kirim_status.php",{id_nm:id_nm, waktu:waktu, status:status },function(DataJSON){
			var data = jQuery.parseJSON(DataJSON);
			
			if(data.confirm==1){
				setInterval(function(){window.location.reload()},1000);
			}else if(data.confirm==2){
				
				$(document).ready(function(){
					$.sticky('Password yang anda masukkan salah',function(){
					stickyClass: 'info'
					});
				})
			}	
			
		});
	});
	$( "#tab-container3" ).easytabs();
});
	

$(document).ready(function(){
	$( "#kode" ).autocomplete({
		source: [ "c++", "java", "phhl", "phpkl", "phpl", "coldfusion", "javascript", "asp", "ruby" ]
	});
	$( "#kode" ).autocomplete({autoFocus: true });
});

$(function() { // menentukan objek yang dijadikan menu melayang yaitu #topNav 
	var float_nav_offset_top = $('.ehem').offset().top;
	var float_nav = function(){ 
		var scroll_top = $(window).scrollTop();
		
		if (scroll_top > float_nav_offset_top) { 
			$('.ehem').css({ 'position': 'fixed', 'top':33, 'left':50, 'width':'1210' }); 
		} else {
			$('.ehem').css({'position':'relative', 'left':0, 'top':0, 'border-color':'white' }); 
		}
	};
	$(window).scroll(function() { 
	float_nav(); 
	});
});

function kembali(){
	window.history.go(-1);
}

function check(){
	var pass = $('#pass').val();
	var password = $('#password').val();
	
	if(pass==password){
		$('#pass_not_ok').hide("slow");
		$('#pass_ok').show("slow");
	}else{
		$('#pass_ok').hide("slow");
		$('#pass_not_ok').show("slow");
	}
}

function simpan_b(){
	var username= $('#username').val();
	var nama 	= $('#nama').val();
	var jk 		= $('#jk').val();
	var agama 	= $('#agama').val();
	var alamat = $('#alamat').val();
	var no_telp = $('#no_telp').val();
	var email 	= $('#email').val();
	var ket 	= $('#ket').val();
	var pass 	= $('#pass').val();
	var password= $('#password').val();
	var password_n = $('#password_n').val();
	
	$.post("simpan_profile.php",{alamat:alamat, username:username, nama:nama, jk:jk, agama:agama, no_telp:no_telp, email:email, ket:ket, pass:pass, password:password, password_n:password_n},function(dataJSON){
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
				$.sticky('Password yang anda masukkan salah',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==3){
			
			$(document).ready(function(){
				$.sticky('Konfirmasi password tidak diterima',function(){
				stickyClass: 'info'
				});
			})
		}else if(data.confirm==4){
			
			$(document).ready(function(){
				$.sticky('Maaf!! Syntax ERRor',function(){
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
	<!-- iSI disini !-->
	<div id="badan_program">
		
			<div id="bada_program_kananpo">
				<br/>
				<div id="title_program">
					<h2>Sosial Media</h2>
				</div>
				<br/>
				<!-- Back !-->
				<div id="kmbl">
					<img src="../image/kmbli.png" height="30px" onclick="kembali()" />
				</div>
				
				<hr/>
				
				<div id="gambar_overlay_knf"></div>
				<div id="knf_save">
					<div id="head_knf">
						<h2>Konfirmasi Password</h2>
						<p>Masukkan Password Anda : <input type="password" name="password_n" id="password_n" class="form_p" /></p>
						
						<div id="ktk_eks">
							<div id="tomb_eks_knf">
								<input type="button" name="simpan" id="simpan" value="Proses" class="submitt" onclick="simpan_b()" />
							</div>
							<div id="tomb_eks_knf">
								<input type="button" name="can_save" id="can_save" value="Kembali" class="submitt"/>
							</div>
						</div>
					</div>
				</div>
				<!----- Iisisi Disini !-->
			
				<div id="prog_po">
				
					<div id="tab-container3" class="tab-container3">
						<ul style="wdith:700" class='ehem'>
							<li class="tab"><a href="#tabs-1"><b>Profile</b></a></li>
							<li class="tab"><a href="#tabs-2"><b>Beranda</b></a></li>
						</ul>
						<br/>
						<?php
							$sesUser = $_SESSION['username'];
		
							$profil = "SELECT * from profile where username='$sesUser'";
							$getprof = mysql_query($profil);

							$outprof = mysql_fetch_assoc($getprof);
							$a 		= $outprof['nama'];
							$b 		= $outprof['image'];
							$jabatan= $outprof['jabatan'];
							$alamat = $outprof['alamat'];
							$no_telp= $outprof['no_telp'];
							$email 	= $outprof['email'];
							$jk 	= $outprof['jk'];
							$agama 	= $outprof['agama'];
							$ket 	= $outprof['ket'];
							date_default_timezone_set("Asia/Jakarta");
							
							echo "<input type='hidden' name='username' id='username' value='$sesUser'/>";
						?>
						<form name="profile" id="profile" action="profile_proses.php" method="POST" enctype="multipart/form-data" >
						<div id="tabs-1">
							<div id="table_profile">
								<table style="margin-left:20px;">
									<tr>
										<td></td>
									</tr>
									<tr>
										<td colspan='2'><?php echo "<img width='200px' id='foto' name='foto' src='$b' class='foto_p' style='cursor:pointer;'/>";?></td>
									</tr>
									<tr>
										<td colspan="2"><input type="file" name="image" id="image" style="" /></td>
									</tr>
									<tr>
										<td><input type="submit" name="ganti" id="ganti" value="Ganti Foto" class="sub_prof"/></td>
									</tr>
									<tr>
										<td></td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>: <input class='form_p' id='nama' name='nama' type="text" value="<?php echo $a ?>" /></td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>: <input class='form_p' id='jk' name='jk' type="text" value="<?php echo $jk ?>" /></td>
									</tr>
									<tr>
										<td>Agama</td>
										<td>: <input class='form_p' id='agama' name='agama' type="text" value="<?php echo $agama ?>" /></td>
									</tr>
									<tr>
										<td>No Hp</td>
										<td>: <input class='form_p' id='no_telp' name='no_telp' type="text" value="<?php echo $no_telp ?>" /></td>
									</tr>
									<tr>
										<td>Email</td>
										<td>: <input class='form_p' id='email' name='email' type="text" value="<?php echo $email ?>" /></td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>: <input class='form_p' id='alamat' name='alamat' type="text" value="<?php echo $alamat ?>" /></td>
									</tr>
									<tr>
										<td>Keterangan</td>
										<td rowspan='2' colspan='3'>&nbsp; <textarea class='form_p' id='ket' name='ket' type="text" value="<?php echo $ket ?>" style="height:50px;width:600"></textarea></td>
									</tr>
									<tr>
										<td></td>
									</tr>
									<tr>
										<td></td>
									</tr>
									<tr>
										<td>Ubah Password</td>
										<td>: <input class='form_p' id='pass' name='pass' type="password" placeholder='Masukkan Password Baru' /></td>
									</tr>
									<tr>
										<td>Konfirmasi Password</td>
										<td>: <input class='form_p' id='password' name='password' type="password" placeholder='Masukkan Ulang Password' onchange="check()"/></td>
										<td style='display:none;' id='pass_ok'>Password diterima</td><td style='display:none;' id='pass_not_ok'>Password tidak diterima</td>
									</tr>
									<tr>
										<td></td>
									</tr>
									<tr>
										<td><input type="button" name="simpan_p" id="simpan_p" value="Simpan Perubahan" class="sub_prof" /></td>
									</tr>
								</table>
								<br/>
							</div>
							<br/><br/>
						</div>
						</form>
						<div id="tabs-2">
							<form name="beranda_form" id="beranda_form" action="kirim_status.php">
								<div id="table_beranda">
									<i><h3>Cairkan Masalah, Temukan Solusi</h3></i>
									<input type="hidden" name="waktu" id="waktu" value="<?php custom_date(); echo " "; jam(); echo ' WIB';?>" />
									<input type="hidden" name="id_nm" id="id_nm" value="<?php id_status();?>" />
									<table style="margin-left:200px;">
										<tr>
											<td><span style="font-weight:bold;font-size:25px;color:blue;font-family:calibri;"><a href="profile.php" style="text-decoration:none;color:purple;"><?php echo $a; ?></a></span></td>
										</tr>
										<tr>
											<td><textarea id="status" name="status" style="width:780;height:80px;padding:10px;border-radius:10px 0;" placeholder="Apa masalah anda ?"></textarea></td>
										</tr>
										<tr>
											<td style="color:grey"><?php custom_date(); echo " &nbsp;"; jam(); echo " WIB";?></td>
										</tr>
										<tr>
											<td><input type="button" name="kirim" id="kirim" value="Cairkan Masalah"class="sub_prof"/></td>
										</tr>
									</table>
							</form>
									<br/>
									<hr style="height:10px;background-color:white"/>
									<table style="margin-left:200px;border:1px solid white;">
										<?php status();?>
									</table>
								</div>
							
							<br/><br/>
						</div>
					</div>
				</div>
			</div>
		
	</div>
	<br/>
	<hr/>
	<div id="footer">
		Persembahan dari kelompok 
		<br/>
		<br/>
		<br/>
	</div>
</div>
</body>
</html>