<?php
include "gedget/tanggal.php";
include "../koneksi.php";
?>

<html>
<head><title>Cetak PO</title></head>

<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">


<script src="../js/jquery-1.11.1.min.js"  type="text/javascript"></script>
<script src="../js/jquery-ui.min.js"  type="text/javascript"></script>
<script src="../js/printArea.js"></script>

<script>
//ONLOAD
$(document.body).append('<div id="page-loader"></div>');

$(window).on("beforeunload", function() {
    // ... tampilkan tabir animasi dengan efek `.fadeIn()`
    $('#page-loader').fadeIn(700).delay(10000).fadeOut(3000);
});

//Untuk Mencetak
(function($) {
            // fungsi dijalankan setelah seluruh dokumen ditampilkan
            $(document).ready(function(e) {
                 
                // aksi ketika tombol cetak ditekan
                $("#cetak").bind("click", function(event) {
                    // cetak data pada area <div id="#data-mahasiswa"></div>
                    $('#bdn_cetakppb').printArea();
                });
            });
        }) (jQuery);

		
</script>
<body>
<div id="bdn_cetakppb">
	<h3>Permintaan Pembelian</h3>
	<?php
		$sql = "SELECT * FROM cetak_ppb order by id_cetak desc LIMIT 1";
		$qry = mysql_query($sql);
		$jml = mysql_num_rows($qry);
		$no = 1;
		if($jml > 0){
			while($row = mysql_fetch_assoc($qry)){
				
				$a = $row['no_ppb'];
				$b = $row['kode'];
				$c = $row['kodebb'];
				$d = $row['sat'];
				$e = $row['unit'];
				$f = $row['tgl_ppb'];
				$g = $row['jthtmpo_ppb'];
				$i = $row['kategori'];
				$j = $row['ket'];
				
				echo
				"<table>
					<td width='65'>No PPB :</td><td width='165'>$a</td><td>Tanggal :</td><td width='165'>$f</td><td>Tgl Jth Tmpo :</td><td>$g</td>
				</table>
				<table  border='1' style='border-collapse:collapse'>
					<tr>
						<th width='30' height='25'>No</th><th width='120'>Kode</th><th width='150'>KodeBB</th><th width='50'>Qty</th><th width='50'>Sat</th><th width='100'>Kategori</th><th width='130'>Keterangan</th>
					</tr>
					<tr>
						<td height='35' align='center'>$no</td><td>$b</td><td>$c</td><td align='center' >$e</td><td align='center' >$d</td><td>$i</td><td>$j</td>
					</tr>
				</table>
				<br/><br/>
				<div id='kol_ttdppb'>
					<div id='ttdppb'>
						<center>Dibuat Oleh,
						<br/><br/><br/><br/>
						( ........................... )<br/>
						Staff Adm. Planer</center>
					</div>
					<div id='ttdppb'>
						<center>Diketahui Oleh,
						<br/><br/><br/><br/>
						( ........................... )<br/>
						Asm. Planer</center>
					</div>
					<div id='ttdppb'>
						<center>Disetujui Oleh,
						<br/><br/><br/><br/>
						( ........................... )<br/>
						Sm. Planer</center>
					</div>
				</div>
				";
			}
		}
	?>
</div>
<br/>
<br/>
<br/>
<br/>
<br/><br/><br/><br/><br/>
<hr/>
<br/>
<div id="tomb_eks">
	<input type="button" class="submitt" value="CETAK" name="cetak" id="cetak"/>
</div>
</body>
</html>
