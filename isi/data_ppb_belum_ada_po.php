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
<head><title>Data PPB Belum Ada PO | Sistem Inventory IWU</title></head>

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
//ONLOAD
$(document.body).append('<div id="page-loader"></div>');

$(window).on("beforeunload", function() {
    // ... tampilkan tabir animasi dengan efek `.fadeIn()`
    $('#page-loader').fadeIn(700).delay(10000).fadeOut(3000);
});

function cari2(term){
	$.post("search_data_ppb_tnp_po.php",{term: term},function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		var content = '';
		var counter = 1;
		
		for(var i=0; i<data.length; i++){
			if(counter%2==1){
			content +="<tr class='tr_1'>";
			content +="<td align='center'>"+counter+"</td>";
			content +="<td>"+data[i].no_ppb+"</td>";
			content +="<td>"+data[i].kode+"</td>";
			content +="<td>"+data[i].kodebb+"</td>";
			content +="<td align='center'>"+data[i].sat+"</td>";
			content +="<td align='center'>"+data[i].unit+"</td>";
			content +="<td align='center'>"+data[i].tonage+"</td>";
			content +="<td align='center'>"+data[i].tgl_ppb+"</td>";
			content +="<td align='center'>"+data[i].jthtmpo_ppb+"</td>";
			content +="<td>"+data[i].kategori+"</td>";
			content +="<td>"+data[i].ket+"</td>";
			content +="</tr>";
			}else{
			content +="<tr class='tr_2'>";
			content +="<td align='center'>"+counter+"</td>";
			content +="<td>"+data[i].no_ppb+"</td>";
			content +="<td>"+data[i].kode+"</td>";
			content +="<td>"+data[i].kodebb+"</td>";
			content +="<td align='center'>"+data[i].sat+"</td>";
			content +="<td align='center'>"+data[i].unit+"</td>";
			content +="<td align='center'>"+data[i].tonage+"</td>";
			content +="<td align='center'>"+data[i].tgl_ppb+"</td>";
			content +="<td align='center'>"+data[i].jthtmpo_ppb+"</td>";
			content +="<td>"+data[i].kategori+"</td>";
			content +="<td>"+data[i].ket+"</td>";
			content +="</tr>";
			}
			counter++;
		}
		$("#table_body").empty().append(content);
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
	</div><br/><br/>
	<div id="gambar_full">
		<img src="../profile/rini.jpg" width="400"/>
	</div>
	<div id="gambar_overlay"></div>
	<!-- iSI disini !-->
	<div id="badan_program">
		<div id="bada_program_kiri"><br/>
			<?php profile();?>
		</div>
		<div id="bada_program_kanan">
			<br/>
			<div id="title_program">
				<h2>Data PPB Belum Ada PO</h2>
			</div><br/>
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
			</div><hr/>
			<div id="prog_ppb">
				<div id="tab-container" class="tab-container">
					<ul class="etabs">
						<li class="tab"><a href="#tabs-1"><?php custom_date(); ?></a></li>
					</ul>
					<br/><br/>
					<div id="tabs-1">
						<table border="1px" style="border-collapse:collapse">
						<thead>
							<tr height="50px">
								<th width="30px">No</th>
								<th width="100px">No PPB</th>
								<th width="100px">Kode</th>
								<th width="150px">KodeBB</th>
								<th width="40px">Sat</th>
								<th width="90px">Jml(Unit)</th>
								<th width="90px">Tonage</th>
								<th width="80px">Tgl PPB</th>
								<th width="80px">Jth Tmpo</th>
								<th width="70px">Kategori</th>
								<th width="95px">Keterangan</th>
							</tr>
						</thead>
						<tbody id="table_body">
							<?php load_table_data_ppb_belum_ada_po(); ?>
						</tbody>
					</table>
					<br/><br/>
					</div>
				</div>
				<br/><br/>
			</div>
		</div>
	</div><br/><hr/>
	<?php include "../footer.php";?>
</div>
</body>
</html>