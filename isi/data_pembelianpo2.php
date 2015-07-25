<?php
session_start();

if(!isset($_SESSION['username'])){
	echo "<script>alert('Maaf Anda Harus Login Terlebih dahulu');
	window.location='../index.php';
	</script>";
}
include "../koneksi.php";
?>

<html>
<head><title>Data Pembelian PO | Sistem Inventory IWU</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
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
	});
	
$(document).ready(function(){
	$("#jthtmpo_ppb").datepicker({
		changeMonth : true,
		changeYear : true
		});
	});

$(document).ready(function(){
	$( "#kode" ).autocomplete({
		source: [ "c++", "java", "phhl", "phpkl", "phpl", "coldfusion", "javascript", "asp", "ruby" ]
	});
	$( "#kode" ).autocomplete({autoFocus: true });
});

function noppb(){
	var id = (document.input_ppb.id_nm.value);
	var no_ppb = "PPIC.000"+id;
	document.input_ppb.no_ppb.value=no_ppb;
	
	
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
	</div>
	<br/><br/>
	<!-- iSI disini !-->
	<div id="badan_program">
		
		<div id="bada_program_kananpo">
			<br/>
			<div id="title_program">
				<h2>Data Pembelian Barang (PO)</h2>
			</div>
			<br/>
			<!-- Back !-->
			<div id="kmbl">
				<a href="buka_pembelianpo.php"><img src="../image/kmbli.png" height="30px"></a>
			</div>
			<!-- sarching !-->
			<div id='search-box'>
				<form action="" id="cari" name="cari" method="POST">
				<input id='search-text' name='q' placeholder="Cari" type="text" />
				<button id='search-button' type='submit'><span><b>Cari</b></span></button>
				</form>
			</div>
			
			<hr/>
			
			<!----- Iisisi Disini !-->
			
			<div id="prog_po">
				<div id="bgn_po">
					<div id="tanggal">
					<?php
						include "gedget/tanggal.php";
						echo custom_date();
					?>
					</div>
					<table border="1px" style="border-collapse:collapse">
						<tr>
							<th width="30px">No</th>
							<th width="100px">No PO</th>
							<th width="150px">Supplier</th>
							<th width="70px">No PPB</th>
							<th width="100px">Kode</th>
							<th width="150px">KodeBB</th>
							<th width="30px">Pack</th>
							<th width="40px">Sat</th>
							<th width="70px">Jml(Unit)</th>
							<th width="90px">Hrg Sat</th>
							<th width="90px">Hrg Ttl</th>
							<th width="90px">Tgl Po</th>
							<th width="90px">Tgl Kirim</th>
							<th width="70px">ATTN</th>
							<th width="100px">PO Untuk</th>
							<th width="70px">Kirim ke</th>
							<th width="90px">Kategori</th>
							<th width="95px">Keterangan</th>
						</tr>
						<?php load_table_data_pembelian(); ?>
					</table>
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