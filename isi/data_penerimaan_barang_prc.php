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
<head><title>Data Penerimaan Barang | Sistem Inventory IWU</title></head>

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
  $("#gmbr").click(function(){
		$("#gambar_full").fadeIn(700);
		$("#gambar_overlay").fadeTo("normal",0.4);
	});
	$("#gambar_overlay").click(function(){
		$("#gambar_full").fadeOut("slow");
		$("#gambar_overlay").hide();
	});
});
//ONLOAD
$(document.body).append('<div id="page-loader"></div>');

$(window).on("beforeunload", function() {
    // ... tampilkan tabir animasi dengan efek `.fadeIn()`
    $('#page-loader').fadeIn(700).delay(10000).fadeOut(3000);
});

function cari2(term){
	$.post("search_btb_prc.php", {term:term}, function(dataJSON){
		var data = jQuery.parseJSON(dataJSON);
		var counter = 1;
		var content = "";
	
		for(var i=0; i<data.length; i++){
			content +="<tr class='fonttd'>";
			content +="<td align='center'>"+counter+"</td>";
			content +="<td>"+data[i].no_btb+"</td>";
			content +="<td>"+data[i].no_sj+"</td>";
			content +="<td>"+data[i].no_po+"</td>";
			content +="<td>"+data[i].kode+"</td>";
			content +="<td>"+data[i].kodebb+"</td>";
			content +="<td>"+data[i].packing+"</td>";
			content +="<td align='center'>"+data[i].sat+"</td>";
			content +="<td align='center'>"+data[i].unit+"</td>";
			content +="<td align='center'>"+data[i].tonage+"</td>";
			content +="<td align='center'>"+data[i].tgl_btb+"</td>";
			content +="<td>"+data[i].kategori+"</td>";
			content +="<td>"+data[i].ket+"</td>";
			content += "</tr>";
			counter++;
		}
		$('#table_data').empty().append(content);
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
				<li><a href="profile.php"><img src="../image/about.png" height="30px"><span style="display: block; opacity: 1; top: -40px;">Tentang Kami</span></a></li>
				<li><a href="help.php"><img src="../image/help.png" height="30px"><span>Bantuan</span></a></li>
			</ul>
		</div>
	</div><br/><br/>
	
	<div id="gambar_full">
		<img src="../profile/rini.jpg" width="400"/>
	</div>
	<div id="gambar_overlay"></div>
	
	<div id="badan_program">
		<div id="bada_program_kiri"><br/>
			<?php profile();?>
		</div>
		<div id="bada_program_kanan">
			<br/>
			<div id="title_program">
				<h2>Data Penerimaan/Kedatangan Barang</h2>
			</div>
			<br/>
			<!-- Back !-->
			<div id="kmbl">
				<a href="pembelian_barang.php"><img src="../image/kmbli.png" height="30px"></a>
			</div>
			<!-- sarching !-->
			<div id='search-box'>
				<form action="" id="cari" name="cari" method="POST">
				<input id='search-text' name='q' placeholder="Cari" type="text" onkeyup="cari2(this.value)" />
				<input type='button' id='search-button' />
				</form>
			</div><hr/>

			<div id="prog_ppb">
				<div id="bgn_ppb">
					<div id="tanggal">
					<?php echo custom_date();?>
					</div>
					<table border="1px" style="border-collapse:collapse">
						<tr>
							<th width="30px">No</th>
							<th width="70px">No BTB</th>
							<th width="90px">No Srt Jln</th>
							<th width="70px">No PO</th>
							<th width="100px">Kode</th>
							<th width="150px">KodeBB</th>
							<th width="30px">Pack</th>
							<th width="40px">Sat</th>
							<th width="70px">Jml(Unit)</th>
							<th width="70px">Tonage</th>
							<th width="90px">Tgl dtng</th>
							<th width="90px">Kategori</th>
							<th width="95px">Keterangan</th>
						</tr>
						<tbody id="table_data">
						<?php load_table_data_penerimaan_barang_prc(); ?>
						</tbody>
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