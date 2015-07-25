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
<head><title>Prog Permintaan Pemb | Sistem Inventory IWU</title></head>


<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script src="../js/jquery.easytabs.js"  type="text/javascript"></script>
<script src="../js/jquery.easytabs.min.js"  type="text/javascript"></script>
<script src="../js/jquery.hashchange.min.js"  type="text/javascript"></script>
<script src="../js/jquery.hashchange.js"  type="text/javascript"></script>
<script type="text/javascript">
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
	$("#converttoexcel").click(function(e) {
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#excel').html()));
		e.preventDefault();
		});
	$("#mstr_bhn").click(function(){
		$("#master_ppb_kms").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_dus").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_bahan").fadeIn(3000)
	});
	$("#mstr_kms").click(function(){
		$("#master_ppb_bahan").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_dus").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_kms").fadeIn(3000)
	});
	$("#mstr_dus").click(function(){
		$("#master_ppb_kms").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_bahan").fadeOut("slow").attr({"top":"100px"});
		$("#master_ppb_dus").fadeIn(3000)
	});
	$("#gmbr").click(function(){
		$("#gambar_full").fadeIn(700);
		$("#gambar_overlay").fadeTo("normal",0.4);
	});
	$("#gambar_overlay").click(function(){
		$("#gambar_full").fadeOut("slow");
		$("#gambar_overlay").hide();
	});
	$( "#tab-container" ).easytabs();
});
	
function cari2(term){
	
	$.post("search_master_ppb.php",{term: term}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		var counter = 1;
		var content = '';
		$("#judul_master").empty().append("Master All");
		for(var i=1; i<data.length; i++){
			if(counter%2==1){
			content += "<tr class='tr_1' >"
			content += "<td align='center'>"+counter+"</td>";
			content += "<td>"+data[i].kode+"</td>";
			content += "<td>"+data[i].kodebb+"</td>";
			content += "<td align='center'>"+data[i].sat+"</td>";
			content += "<td align='right'>"+data[i].smin+"</td>";
			content += "<td align='right'>"+data[i].rop+"</td>";
			content += "<td align='right'>"+data[i].smax+"</td>";
			content += "<td>"+data[i].LT+"</td>";
			content += "<td>"+data[i].ket+"</td>";
			content += "</tr>";
			
			}else{
			content += "<tr class='tr_2' >"
			content += "<td align='center'>"+counter+"</td>";
			content += "<td>"+data[i].kode+"</td>";
			content += "<td>"+data[i].kodebb+"</td>";
			content += "<td align='center'>"+data[i].sat+"</td>";
			content += "<td align='right'>"+data[i].smin+"</td>";
			content += "<td align='right'>"+data[i].rop+"</td>";
			content += "<td align='right'>"+data[i].smax+"</td>";
			content += "<td>"+data[i].LT+"</td>";
			content += "<td>"+data[i].ket+"</td>";
			content += "</tr>";
			}
			counter++;
		}
		$("#tabel_master").empty().append(content);
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
				<li><a href="profile.php"><img src="../image/about.png" height="30px"><span style="display: block; opacity: 1; top: -40px;">Tentang Kami</span></a></li>
				<li><a href="help.php"><img src="../image/help.png" height="30px"><span>Bantuan</span></a></li>
			</ul>
		</div>
	</div><br/><br/>
	
	<div id="gambar_full">
		<img src="../profile/rahma.jpg" width="300"/>
	</div>
	<div id="gambar_overlay"></div>

	<div id="badan_program">
		<div id="bada_program_kiri"><br/>
			<?php profile();?>
		</div>
		<div id="bada_program_kanan">
			<br/>
			<div id="title_program">
				<h2>Master Bahan, Dus dan Kemasan</h2>
			</div>
			<br/>
			<!-- Back !-->
			<div id="kmbl">
				<img src="../image/kmbli.png" height="30px" onclick="kembali()" />
			</div>

			<div id='search-box'>
				<form action="" id="cari" name="cari" method="POST">
					<input id="search-text" name="search-text" placeholder="Cari" type="text" onkeyup="cari2(this.	value)"; />
					<input id='search-button' type='button'></button>
				</form>
			</div><hr/>

			<div id="prog_ppb">
				<div id="tab-container" class="tab-container">
					<ul class="etabs">
						<li class="tab"><a href="#tabs-1">Master Bahan Baku</a></li>
						<li class="tab"><a href="#tabs-2">Master Kemasan</a></li>
						<li class="tab"><a href="#tabs-3">Master Dus</a></li>
					</ul>
					<br/><br/>
					<div id="tabs-1">
						<table border="1px" style="border-collapse:collapse">
							<thead>
								<tr> 
									<th width="30">No</th>
									<th width="150">Kode</th>
									<th width="150">Kode BB</th>
									<th width="30">Sat</th>
									<th width="50">Smin</th>
									<th width="50">ROP</th>
									<th width="50">Smax</th>
									<th width="80">Lead Time</th>
									<th width="150">Keterangan</th>
								</tr>
							</thead>
							<tbody id="tabel_master" >
								<?php load_table_master_bahan_ppb();?>
							</tbody>
						</table>
						<br/><br/>
					</div>
					<div id="tabs-2">
						<table border="1px" style="border-collapse:collapse">
							<thead>
								<tr>
									<th width="30">No</th>
									<th width="150">Kode</th>
									<th width="150">Kode BB</th>
									<th width="30">Sat</th>
									<th width="50">Smin</th>
									<th width="50">ROP</th>
									<th width="50">Smax</th>
									<th width="80">Lead Time</th>
									<th width="150">Keterangan</th>
								</tr>
							</thead>
							<tbody id="tabel_master" >
								<?php load_table_master_kms_ppb();?>
							</tbody>
						</table>
						<br/><br/>
					</div>
					<div id="tabs-3">
						
						<table border="1px" style="border-collapse:collapse">
							<thead>
								<tr>
									<th width="30">No</th>
									<th width="150">Kode</th>
									<th width="150">Kode BB</th>
									<th width="30">Sat</th>
									<th width="50">Smin</th>
									<th width="50">ROP</th>
									<th width="50">Smax</th>
									<th width="80">Lead Time</th>
									<th width="150">Keterangan</th>
								</tr>
							</thead>
							<tbody id="tabel_master" >
								<?php load_table_master_dus_ppb();?>
							</tbody>
						</table>
						<br/><br/>
					</div>
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