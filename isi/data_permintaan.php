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

<link rel="stylesheet" href="../css/style.css" type="text/css">
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
	$("#gmbr").click(function(){
		$("#gambar_full").fadeIn(700);
		$("#gambar_overlay").fadeTo("normal",0.4);
	});
	$("#gambar_overlay").click(function(){
		$("#gambar_full").fadeOut("slow");
		$("#gambar_overlay").hide();
	});
	$( "#tab-container" ).easytabs();
	
	$.post("data_table_permintaan.php", function(dataJSON){
		var content = '';
		var count = 1;
		var data = jQuery.parseJSON(dataJSON);
		// isi dataJSON = data.hasil, data.page_amount, data.page
		var dataResult = jQuery.parseJSON(data.hasil);
		for(var i=0; i<dataResult.length; i++){
			if(count%2==1){
			content += "<tr class='tr_1'>";
			content += "<td align='center' width='30'>"+count+"</td>";
			content += "<td width='100' >"+dataResult[i].no_ppb+"</td>";
			content += "<td width='100'>"+dataResult[i].kode+"</td>";
			content += "<td width='130'>"+dataResult[i].kodebb+"</td>";
			content += "<td align='center' width='40'>"+dataResult[i].sat+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].unit+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].tonage+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].tgl_ppb+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].jthtmpo_ppb+"</td>";
			content += "<td width='80'>"+dataResult[i].no_po+"</td>";
			content += "<td width='70'>"+dataResult[i].kategori+"</td>";
			content += "<td width='95'>"+dataResult[i].ket+"</td>";
			content += "</tr>";
			}else{
			content += "<tr class='tr_2'>";
			content += "<td align='center' width='30'>"+count+"</td>";
			content += "<td width='100' >"+dataResult[i].no_ppb+"</td>";
			content += "<td width='100'>"+dataResult[i].kode+"</td>";
			content += "<td width='130'>"+dataResult[i].kodebb+"</td>";
			content += "<td align='center' width='40'>"+dataResult[i].sat+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].unit+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].tonage+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].tgl_ppb+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].jthtmpo_ppb+"</td>";
			content += "<td width='80'>"+dataResult[i].no_po+"</td>";
			content += "<td width='70'>"+dataResult[i].kategori+"</td>";
			content += "<td width='95'>"+dataResult[i].ket+"</td>";
			content += "</tr>";
			}
			count++;
		}
		$("#tbody_tbl_data_ppb").empty().append(content);
		var prev = 0;
		var next = 0;
		var page = data.page;
		var page_amount = data.page_amount;
		var value = "";
		var counter = 0
		if(page_amount != 0){
			if(page != 0){
				prev = page - 1;
				value +="<div id='pil_pag'><a href='#' onclick='pagination("+ prev +")'>Prev</a></div>";
			}
			for (counter = 0; counter <= page_amount; counter += 1) {
				value += "<div id='pil_pag'><a href='#' onclick='pagination("+ counter +")'>";
				value += counter + 1;
				value += "</a></div>";
				
			}
			if(page < page_amount){
				next = page + 1;
				value +="<div id='pil_pag'><a href='#' onclick='pagination("+ next +")'>Next</a></div>";
			}
		}
		$("#paging").html(value);
	});
});
function pagination(page){
	$.post("data_table_permintaan.php", {p:page}, function(dataJSON){
		var content = '';
		var count = 1;
		var data = jQuery.parseJSON(dataJSON);
		// isi dataJSON = data.hasil, data.page_amount, data.page
		var dataResult = jQuery.parseJSON(data.hasil);
		for(var i=0; i<dataResult.length; i++){
			if(count%2==1){
			content += "<tr class='tr_1'>";
			content += "<td align='center' width='30'>"+count+"</td>";
			content += "<td width='100' >"+dataResult[i].no_ppb+"</td>";
			content += "<td width='100'>"+dataResult[i].kode+"</td>";
			content += "<td width='130'>"+dataResult[i].kodebb+"</td>";
			content += "<td align='center' width='40'>"+dataResult[i].sat+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].unit+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].tonage+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].tgl_ppb+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].jthtmpo_ppb+"</td>";
			content += "<td width='80'>"+dataResult[i].no_po+"</td>";
			content += "<td width='70'>"+dataResult[i].kategori+"</td>";
			content += "<td width='95'>"+dataResult[i].ket+"</td>";
			content += "</tr>";
			}else{
			content += "<tr class='tr_2'>";
			content += "<td align='center' width='30'>"+count+"</td>";
			content += "<td width='100' >"+dataResult[i].no_ppb+"</td>";
			content += "<td width='100'>"+dataResult[i].kode+"</td>";
			content += "<td width='130'>"+dataResult[i].kodebb+"</td>";
			content += "<td align='center' width='40'>"+dataResult[i].sat+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].unit+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].tonage+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].tgl_ppb+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].jthtmpo_ppb+"</td>";
			content += "<td width='80'>"+dataResult[i].no_po+"</td>";
			content += "<td width='70'>"+dataResult[i].kategori+"</td>";
			content += "<td width='95'>"+dataResult[i].ket+"</td>";
			content += "</tr>";
			}
			count++;
		}
		$("#tbody_tbl_data_ppb").empty().append(content);
		var prev = 0;
		var next = 0;
		var page = data.page;
		var page_amount = data.page_amount;
		var value = "";
		var counter = 0
		if(page_amount != 0){
			if(page != 0){
				prev = page - 1;
				value +="<div id='pil_pag'><a href='#' onclick='pagination("+ prev +")'>Prev</a></div>";
			}
			for (counter = 0; counter <= page_amount; counter += 1) {
				value += "<div id='pil_pag'><a href='#' onclick='pagination("+ counter +")'>";
				value += counter + 1;
				value += "</a></div>";
				
			}
			if(page < page_amount){
				next = page + 1;
				value +="<div id='pil_pag'><a href='#' onclick='pagination("+ next +")'>Next</a></div>";
			}
		}
		$("#paging").html(value);
	});
}
// ---fungsi Search-------------------------------------------------------
function cari2(term, page){
	$.post("search_ppb.php", {term:term, p:page}, function(dataJSON){
		var content = '';
		var count = 1;
		var data = jQuery.parseJSON(dataJSON);
		// isi dataJSON = data.hasil, data.page_amount, data.page
		var dataResult = jQuery.parseJSON(data.hasil);
		for(var i=0; i<dataResult.length; i++){
			if(count%2==1){
			content += "<tr class='tr_1'>";
			content += "<td align='center' width='30'>"+count+"</td>";
			content += "<td width='100' >"+dataResult[i].no_ppb+"</td>";
			content += "<td width='100'>"+dataResult[i].kode+"</td>";
			content += "<td width='130'>"+dataResult[i].kodebb+"</td>";
			content += "<td align='center' width='40'>"+dataResult[i].sat+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].unit+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].tonage+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].tgl_ppb+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].jthtmpo_ppb+"</td>";
			content += "<td width='80'>"+dataResult[i].no_po+"</td>";
			content += "<td width='70'>"+dataResult[i].kategori+"</td>";
			content += "<td width='95'>"+dataResult[i].ket+"</td>";
			content += "</tr>";
			}else{
			content += "<tr class='tr_2'>";
			content += "<td align='center' width='30'>"+count+"</td>";
			content += "<td width='100' >"+dataResult[i].no_ppb+"</td>";
			content += "<td width='100'>"+dataResult[i].kode+"</td>";
			content += "<td width='130'>"+dataResult[i].kodebb+"</td>";
			content += "<td align='center' width='40'>"+dataResult[i].sat+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].unit+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].tonage+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].tgl_ppb+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].jthtmpo_ppb+"</td>";
			content += "<td width='80'>"+dataResult[i].no_po+"</td>";
			content += "<td width='70'>"+dataResult[i].kategori+"</td>";
			content += "<td width='95'>"+dataResult[i].ket+"</td>";
			content += "</tr>";
			}
			count++;
		}
		$("#tbody_tbl_data_ppb").empty().append(content);
		var prev = 0;
		var next = 0;
		var page = data.page;
		var page_amount = data.page_amount;
		var value = "";
		var counter = 0;
		if(page_amount > 0){
			if(page != 0){
				prev = page - 1;
				value +="<a href='#' onclick='cari2(\""+ term +"\","+ prev +")'>Prev</a>";
			}
			for (counter = 0; counter <= page_amount; counter += 1) {
				value += "<a href='#' onclick='cari2(\""+ term +"\","+ counter +")'>";
				value += counter + 1;
				value += "</a>";
			
			}
			if(page < page_amount){
				next = page + 1;
				value +="<a href='#' onclick='cari2(\""+ term +"\","+ next +")'>Next</a>";
			}
		}
		$("#paging").html(value);
	});
}
function pagination(page){
	$.post("data_table_permintaan.php", {p:page}, function(dataJSON){
		var content = '';
		var count = 1;
		var data = jQuery.parseJSON(dataJSON);
		
		var dataResult = jQuery.parseJSON(data.hasil);
		for(var i=0; i<dataResult.length; i++){
			if(count%2==1){
			content += "<tr class='tr_1'>";
			content += "<td align='center' width='30'>"+count+"</td>";
			content += "<td width='100' >"+dataResult[i].no_ppb+"</td>";
			content += "<td width='100'>"+dataResult[i].kode+"</td>";
			content += "<td width='130'>"+dataResult[i].kodebb+"</td>";
			content += "<td align='center' width='40'>"+dataResult[i].sat+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].unit+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].tonage+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].tgl_ppb+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].jthtmpo_ppb+"</td>";
			content += "<td width='80'>"+dataResult[i].no_po+"</td>";
			content += "<td width='70'>"+dataResult[i].kategori+"</td>";
			content += "<td width='95'>"+dataResult[i].ket+"</td>";
			content += "</tr>";
			}else{
			content += "<tr class='tr_2'>";
			content += "<td align='center' width='30'>"+count+"</td>";
			content += "<td width='100' >"+dataResult[i].no_ppb+"</td>";
			content += "<td width='100'>"+dataResult[i].kode+"</td>";
			content += "<td width='130'>"+dataResult[i].kodebb+"</td>";
			content += "<td align='center' width='40'>"+dataResult[i].sat+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].unit+"</td>";
			content += "<td align='center' width='70'>"+dataResult[i].tonage+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].tgl_ppb+"</td>";
			content += "<td align='center' width='80'>"+dataResult[i].jthtmpo_ppb+"</td>";
			content += "<td width='80'>"+dataResult[i].no_po+"</td>";
			content += "<td width='70'>"+dataResult[i].kategori+"</td>";
			content += "<td width='95'>"+dataResult[i].ket+"</td>";
			content += "</tr>";
			}
			count++;
		}
		$("#tbody_tbl_data_ppb").empty().append(content);
		var prev = 0;
		var next = 0;
		var page = data.page;
		var page_amount = data.page_amount;
		var value = "<div id='pil_pag'>";
		var counter = 0
		if(page_amount != 0){
			if(page != 0){
				prev = page - 1;
				value +="<a href='#' onclick='pagination("+ prev +")'>Prev </a>";
			}
			for (counter = 0; counter <= page_amount; counter += 1) {
				value += "<a href='#' onclick='pagination("+ counter +")'>";
				value += counter + 1;
				value += "</a>";
				
			}
			if(page < page_amount){
				next = page + 1;
				value +="<a href='#' onclick='pagination("+ next +")'>Next</a>";
			}
		}
		value += "</div>";
		$("#paging").html(value);
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
		<img src="../profile/rahma.jpg" width="300"/>
	</div>
	<div id="gambar_overlay"></div>
	
	<div id="badan_program">
		<div id="bada_program_kiri"><br/>
			<?php profile(); ?>
		</div>
		<div id="bada_program_kanan"><br/>
			<div id="title_program">
				<h2>Data Permintaan Pembelian (PPB)</h2>
			</div><br/>
			
			<div id="kmbl">
				<img src="../image/kmbli.png" height="30px" onclick="kembali()" />
			</div>
			
			<!-- sarching !-->
			
			<div id='search-box'>
				<form action="" id="cari" name="cari" method="POST">
					<input id="search-text" name="search-text" placeholder="Cari" type="text" onkeyup="cari2(this.value)"; />
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
						<div id="excel">
							<table border="1px" style="border-collapse:collapse">
								<thead>
									<tr height="50px">
									<th width="30px">No	</th>
									<th width="100px">No PPB</th>
									<th width="100px">Kode</th>
									<th width="130px">KodeBB</th>
									<th width="40px">Sat</th>
									<th width="70px">Jml(Unit)</th>
									<th width="70px">Tonage</th>
									<th width="80px">Tgl PPB</th>
									<th width="80px">Jth Tmpo</th>
									<th width="80px">No PO</th>
									<th width="70px">Kategori</th>
									<th width="95px">Keterangan</th>
									</tr>
								</thead>
								<tbody id="tbody_tbl_data_ppb"></tbody>
							</table>
						</div>
						<br/>
						<div id='paging' class='paging'></div>
					</div>
				</div>
				<br/><br/>
				<div id="cettoex">
					<input type="button" class="importexcel" id="converttoexcel" name="converttoexcel" value="Import ke Excel" />
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