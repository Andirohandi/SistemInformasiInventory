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
                    $('#bdn_cetakpo').printArea();
                });
            });
        }) (jQuery);

		
</script>
<body>
<div id="bdn_cetakpo">
	<h4>PT RAJAWALI HIYOTO
	<br/>Bandung
	<br/>PURCHASE ORDER</h4>
	<?php
		$sql = "SELECT * FROM cetak_po order by id_cetak desc LIMIT 1";
		$qry = mysql_query($sql);
		$jml = mysql_num_rows($qry);
		
		if($jml > 0){
			while($row = mysql_fetch_assoc($qry)){
				$a = $row['no_po'];
				$b = $row['supplier'];
				$c = $row['no_ppb'];
				$d = $row['kode'];
				$e = $row['kodebb'];
				$f = $row['packing'];
				$g = $row['sat'];
				$h = $row['unit'];
				$i = $row['hrg_sat'];
				$j = $row['hrg_total'];
				$k = $row['tgl_po'];
				$l = $row['tgl_kirim'];
				$m = $row['attn'];
				$n = $row['po_untuk'];
				$o = $row['kirim_ke'];
				$p = $row['kategori'];
				$q = $row['ket'];
				
				echo
				"<table class='tablekiri_po'>
					<tr>
						<td class='td_po'>No Po</td><td> : </td><td>$a</td>
					</tr>
					<tr>
						<td class='td_po'>Tgl Po</td><td> : </td><td>$k</td>
					</tr>
					<tr>
						<td class='td_po'>Po Untuk</td><td> : </td><td>$n</td>
					</tr>
				</table>
				<table class='tablekiri_po'>
					<tr>
						<td class='td_po'>Supplier</td><td> : </td><td>$b</td>
					</tr>
					<tr>
						<td class='td_po'>ATTN</td><td> : </td><td>$m</td>
					</tr>
					<tr>
						<td class='td_po'>Kirim Ke</td><td> : </td><td>$n</td>
					</tr>
				</table>
				<table class='tablekiri_po'>
					<tr>
						<td class='td_po'>Tgl Kirim</td><td> : </td><td><b>$l</b></td>
					</tr>
					<tr>
						<td class='td_po'>No PPB</td><td> : </td><td>$c</td>
					</tr>
				</table>
				<br/><br/><br/><hr/>
				<table class='table2_cetak_po' border='1px'>
					<tr>
						<th width='100'>Kode</th><th width='150'>Kode BB</th><th width='40'>Kms</th><th width='30'>Sat</th><th width='50'>Qty</th><th width='70'>Hrg Sat</th><th width='80'>Total</th><th width='95'>Keterangan</th>
					</tr>
					<tr>
						<td height='25'>$d</td><td>$e</td><td>$f</td><td align='center'>$g</td><td align='center'>$h</td><td align='right'>Rp. $i</td><td align='right'>Rp. $j</td><td>$q</td>
					</tr>
				</table>
				<br/>
				<div id='table_po3'>
				<table >
					<tr>
						<td colspan='2'><b>Catatan :</b></td>
					</tr>
					<tr>
						<td valign='top'>- </td><td align='justify'>Harga dan unit barang tidak dapat diubah jika barang telah dikirim dan pembayaran telah dilunasi</td>
					</tr>
					<tr>
						<td valign='top'>- </td><td align='justify'><b>Jika barang yang dipesan tidak tersedia, mohon diinformasikan secepatnya</b></td>
					</tr>
				</table>
				</div>
				<div id='clear'>
				</div>
				
				<div id='ttdpo'>
					<center>Dibuat Oleh,
					<br/><br/><br/><br/>
					( ........................... )<br/>
					Staff Adm. Procuremen</center>
				</div>
				<div id='ttdpo'>
					<center>Diketahui Oleh,
					<br/><br/><br/><br/>
					( ........................... )<br/>
					Asm. Procuremen</center>
				</div>
				<div id='ttdpo'>
					<center>Disetujui Oleh,
					<br/><br/><br/><br/>
					( ........................... )<br/>
					Sm. Procuremen</center>
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
