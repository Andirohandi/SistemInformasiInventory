<?php

include "../koneksi.php";

function jam(){
	$jam	= date('H');
	$menit	= date('i');
	
	echo $jam." : ".$menit;
}
//---- buka_permintaan.php
function noppb(){
	date_default_timezone_set("Asia/Jakarta");
	$sql = "SELECT no_ppb FROM ppb ORDER BY no_ppb DESC LIMIT 1";
	
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	$bulan = date('m');
	
	$tahun = date('y');
	$kode = '';
	
	if($jml > 0){
		$b = mysql_fetch_assoc($sq);
		
		$kode = $b['no_ppb'];
		$kode_split = explode('.', $kode);
		$kode_index_0 = $kode_split[0];
		$kode_index_1 = (int) $kode_split[1];
		$kode_index_2 = (String) $kode_split[2];
		$kode_index_3 = (int) $kode_split[3];

		if($bulan != $kode_index_2){
			$counter = 1;
			if($counter <= 9) $kode_index_3 = "0000".$counter;
			else if($counter > 9 && $counter <= 99) $kode_index_3 = "000".$counter;
			else if($counter > 99 && $counter <= 999) $kode_index_3 = "00".$counter;
			else if($counter > 999 && $counter <= 9999) $kode_index_3 = "0".$counter;
			else if($counter > 9999 && $counter <= 99999) $kode_index_3 = $counter;
			else $kode_index_3 = "00001";
			
			$kode = $kode_index_0.'.'.$tahun.'.'.$bulan.'.'.$kode_index_3;
		}else{
			$counter = $kode_index_3 + 1;
			if($counter <= 9) $kode_index_3 = "0000".$counter;
				else if($counter > 9 && $counter <= 99) $kode_index_3 = "000".$counter;
				else if($counter > 99 && $counter <= 999) $kode_index_3 = "00".$counter;
				else if($counter > 999 && $counter <= 9999) $kode_index_3 = "0".$counter;
				else if($counter > 9999 && $counter <= 99999) $kode_index_3 = $counter;
				else $kode_index_3 = "0001";
				
			$kode = $kode_index_0.'.'.$tahun.'.'.$bulan.'.'.$kode_index_3;
			
		}
	}else $kode='PPB.'.$tahun.'.'.$bulan.'.00001';
	
	echo $kode;
}
function id_cetppb(){
	$conpo = "SELECT id_cetak FROM cetak_ppb order by id_cetak desc LIMIT 1";
	$qrpo = mysql_query($conpo);
	$jmlpo = mysql_num_rows($qrpo);
	
	$z = 1;
	if($jmlpo>0){
		$b = mysql_fetch_assoc($qrpo);
		$c = $b['id_cetak'];
		$z = $c + 1;
		echo $z;
		$z++;
	}
}
function id_ppb(){
	$sql = "SELECT id_nm from ppb order by id_nm desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}
function id_mstr(){
	$sql = "SELECT * FROM master_barang order by id DESC LIMIT 1";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	
	if($num>0){
		$row = mysql_fetch_assoc($qry);
		$id  = $row['id'];
		echo $id+1;
	}else{
		echo 1;
	}
	
}
function load_table_data_penerimaan_barang(){
	$btb = "SELECT * FROM btb";
	$qrbtb = mysql_query($btb);
	$jmlbtb = mysql_num_rows($qrbtb);
	
	if($jmlbtb>0){
		$no = 1;
		
		while($row = mysql_fetch_assoc($qrbtb)){
			$a = $row['no_btb'];
			$b = $row['no_sj'];
			$c = $row['no_po'];
			$d = $row['kode'];
			$e = $row['kodebb'];
			$f = $row['packing'];
			$g = $row['sat'];
			$h = $row['unit'];
			$i = $row['tonage'];
			$j = $row['tgl_btb'];
			$k = $row['kategori'];
			$l = $row['ket'];
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td>
					<td align=''>$a</td>
					<td align=''>$b</td>
					<td align=''>$c</td>
					<td align=''>$d</td>
					<td align=''>$e</td>
					<td align='center'>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td align='center'>$j</td>
					<td align=''>$l</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center'>$no</td>
					<td align=''>$a</td>
					<td align=''>$b</td>
					<td align=''>$c</td>
					<td align=''>$d</td>
					<td align=''>$e</td>
					<td align='center'>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td align='center'>$j</td>
					<td align=''>$l</td>
				</tr>";
			}
			$no++;
		}
	}
}
function load_table_data_pembatalan_ppb(){
	$btl_ppb = "SELECT * FROM ppb_batal WHERE status='Batal'";
	$qrbtl = mysql_query($btl_ppb);
	$jmlbtl = mysql_num_rows($qrbtl);
	
	if($jmlbtl>0){
		$no = 1;
		while($row = mysql_fetch_assoc($qrbtl)){
			$a = $row['tgl_ppb_batal'];
			$b = $row['no_ppb'];
			$c = $row['kode'];
			$d = $row['kodebb'];
			$e = $row['sat'];
			$f = $row['unit'];
			$g = $row['tonage'];
			$h = $row['tgl_ppb'];
			$i = $row['jthtmpo_ppb'];
			$j = $row['kategori'];
			$k = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td><td align='center'>$a</td><td align='center'>$b</td><td align=''>$c</td><td align=''>$d</td><td align='center'>$e</td><td align='center'>$f</td><td align='center'>$g</td><td align='center'>$h</td><td align='center'>$i</td><td align=''>$k</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center'>$no</td><td align='center'>$a</td><td align='center'>$b</td><td align=''>$c</td><td align=''>$d</td><td align='center'>$e</td><td align='center'>$f</td><td align='center'>$g</td><td align='center'>$h</td><td align='center'>$i</td><td align=''>$k</td>
				</tr>";
			
			}
			$no++;
		}
	}
}
function load_table_master_bahan_ppb(){
	$sql = "SELECT * FROM master_barang WHERE kategori='Bahan Baku' LIMIT 25";
	$qry = mysql_query($sql);
	$jml = mysql_num_rows($qry);

	if($jml>0){
		$no = 1;
		while($row = mysql_fetch_assoc($qry)){
			$a = $row['kode'];
			$b = $row['kodebb'];
			$c = $row['sat'];
			$d = $row['smin'];
			$e = $row['rop'];
			$f = $row['smax'];
			$g = $row['LT'];
			$h = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1' >
					<td align='center'>$no</td><td>$a</td><td>$b</td><td align='center'>$c</td><td align='right'>$d</td><td align='right'>$e</td><td align='right'>$f</td><td>$g</td><td></td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2' >
					<td align='center'>$no</td><td>$a</td><td>$b</td><td align='center'>$c</td><td align='right'>$d</td><td align='right'>$e</td><td align='right'>$f</td><td>$g</td><td></td>
				</tr>";
			}
			$no++;
		}
	}

}	
function load_table_master_kms_ppb(){
	$sql = "SELECT * FROM master_barang WHERE kategori='Kemasan' LIMIT 20";
	$qry = mysql_query($sql);
	$jml = mysql_num_rows($qry);
	
	if($jml>0){
		$no = 1;
		while($row = mysql_fetch_assoc($qry)){
			$a = $row['kode'];
			$b = $row['kodebb'];
			$c = $row['sat'];
			$d = $row['smin'];
			$e = $row['rop'];
			$f = $row['smax'];
			$g = $row['LT'];
			$h = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td><td>$a</td><td>$b</td><td align='center'>$c</td><td align='right'>$d</td><td align='right'>$e</td><td align='right'>$f</td><td>$g</td><td>$h</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center'>$no</td><td>$a</td><td>$b</td><td align='center'>$c</td><td align='right'>$d</td><td align='right'>$e</td><td align='right'>$f</td><td>$g</td><td>$h</td>
				</tr>";
			}
			$no++;
		}
	}
}
function load_table_master_dus_ppb(){
	$sql = "SELECT * FROM master_barang WHERE kategori='Dus' LIMIT 20";
	$qry = mysql_query($sql);
	$jml = mysql_num_rows($qry);
	
	if($jml>0){
		$no = 1;
		while($row = mysql_fetch_assoc($qry)){
			$a = $row['kode'];
			$b = $row['kodebb'];
			$c = $row['sat'];
			$d = $row['smin'];
			$e = $row['rop'];
			$f = $row['smax'];
			$g = $row['LT'];
			$h = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td><td>$a</td><td>$b</td><td align='center'>$c</td><td align='right'>$d</td><td align='right'>$e</td><td align='right'>$f</td><td>$g</td><td>$h</td>
				</tr>";
			}else{
				echo
					"<tr class='tr_2'>
					<td align='center'>$no</td><td>$a</td><td>$b</td><td align='center'>$c</td><td align='right'>$d</td><td align='right'>$e</td><td align='right'>$f</td><td>$g</td><td>$h</td>
				</tr>";
			}
			$no++;
		}
	}
}
//----- buka_pembelianpo.php	
function no_po(){
	$conpo = "SELECT id_nm FROM po order by id_nm desc LIMIT 1";
	$qrpo = mysql_query($conpo);
	$jmlpo = mysql_num_rows($qrpo);
	
	date_default_timezone_set("Asia/Jakarta");
	$thn = date('y');
	$bln = date('m');
	
	$a = 1;
	if($jmlpo>0){
		$b = mysql_fetch_assoc($qrpo);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo "PO.".$thn.".".$bln.".000".$a;
	}else{
		echo "PO.".$thn.".".$bln.".0001";
	}
}
function id_po(){
	$conpo = "SELECT id_nm FROM po order by id_nm desc LIMIT 1";
	$qrpo = mysql_query($conpo);
	$jmlpo = mysql_num_rows($qrpo);
	
	$a = 1;
	if($jmlpo>0){
		$b = mysql_fetch_assoc($qrpo);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
		$a++;
	}else{
		echo 1;
	}
}
function id_cetpo(){
	$conpo = "SELECT id_cetak FROM cetak_po order by id_cetak desc LIMIT 1";
	$qrpo = mysql_query($conpo);
	$jmlpo = mysql_num_rows($qrpo);
	
	$z = 1;
	if($jmlpo>0){
		$b = mysql_fetch_assoc($qrpo);
		$c = $b['id_cetak'];
		$z = $c + 1;
		echo $z;
		$z++;
	}
}
function select_supplier(){
	$sup = "SELECT * FROM master_supplier";
	$qrsup = mysql_query($sup);
	$jmlsup = mysql_num_rows($qrsup);
	
	if($jmlsup>0){
		while($row = mysql_fetch_assoc($qrsup)){
			$a = $row['supplier'];
			
			echo "<option value='$a'>$a</option>";
		}
	}
}
function select_jenis_produk(){
	$sql = "SELECT * FROM master_produk";
	$qry = mysql_query($sql);
	$jml = mysql_num_rows($qry);
	
	if($jml > 0){
		while($row = mysql_fetch_assoc($qry)){
		$jp = $row['nm_prod'];
		
		echo "<option value='$jp'>$jp</option>";
		}
	}
}
function load_table_data_barang_urgent(){
	$urgent = "SELECT * FROM stock_barang WHERE ket='urgent'";
	$qrurgent = mysql_query($urgent);
	$jmlurgent = mysql_num_rows($qrurgent);
	
	if($jmlurgent>0){
	$no = 1;
	
	while($row = mysql_fetch_assoc($qrurgent)){
		$a = $row['kode'];
		$b = $row['kodebb'];
		$c = $row['sat'];
		$d = $row['s_akhir'];
		$e = $row['smin'];
		$f = $d - $e;
		$g = $row['kategori'];
		$h = $row['ket'];
		
		if($no%2==1){
			echo
			"<tr class='tr_1'>
				<td align='center'>$no</td>
				<td align=''>$a</td>
				<td align=''>$b</td>
				<td align='center'>$c</td>
				<td align='center'>$d</td>
				<td align='center'>$e</td>
				<td align='center'>$f</td>
				<td align=''>$g</td>
				<td align='center'>$h</td>
			</tr>";
		}else{
			echo
			"<tr class='tr_2'>
				<td align='center'>$no</td>
				<td align=''>$a</td>
				<td align=''>$b</td>
				<td align='center'>$c</td>
				<td align='center'>$d</td>
				<td align='center'>$e</td>
				<td align='center'>$f</td>
				<td align=''>$g</td>
				<td align='center'>$h</td>
			</tr>";
		}
		$no++;
		}
	}
}
function load_table_permintaan(){
	$result = mysql_query("SELECT * FROM ppb");
	$num_rows = mysql_num_rows($result);
	
	$items = 5;
	$page_amount = ceil($num_rows/$items);
	$page_amount = $page_amount - 1;
	$page = mysql_real_escape_string($_GET['p']);
	if($page < 1) $page = 0;
	$page_num = $items * $page;
	
	$result = mysql_query("SELECT * FROM ppb LIMIT $page_num, $items");
	$num_rows = mysql_num_rows($result);
	
	$no = 1;
	while($row = mysql_fetch_assoc($result)){
		$a = $row['no_ppb'];
		$b = $row['kode'];
		$c = $row['kodebb'];
		$d = $row['sat'];
		$e = $row['unit'];
		$f = $row['tonage'];
		$g = $row['tgl_ppb'];
		$h = $row['jthtmpo_ppb'];
		$i = $row['no_po'];
		$j = $row['kategori'];
		$k = $row['ket'];
		
		echo 
		"<tr class='fonttd'>
			<td align='center'>$no</td>
			<td align=''>$a</td>
			<td align=''>$b</td>
			<td align=''>$c</td>
			<td align='center'>$d</td>
			<td align='center'>$e</td>
			<td align='center'>$f</td>
			<td align='center'>$g</td>
			<td align='center'>$h</td>
			<td align=''>$i</td>
			<td align=''>$j</td>
			<td align=''>$k</td>
		</tr>";
		$no++;
	}
	if($page_amount != "0"){ 
		echo "<div class='paging'>";
		if($page != "0"){
			$prev = $page-1;
			echo "<a href=\"data_permintaan.php?p=$prev\">Prev</a>";
		}
		for ( $counter = 0; $counter <= $page_amount; $counter += 1) {
			echo "<a href=\"data_permintaan.php?p=$counter\">";
			echo $counter+1;
			echo "</a>";
		}
		if($page < $page_amount){
			$next = $page+1;
			echo "<a href=\"data_permintaan.php?p=$next\">Next</a>";
		}
		echo "</div>";
	}
}
function load_table_data_pembelian(){
	$po = "SELECT * FROM po";
	$qrpo = mysql_query($po);
	$jmlpo = mysql_num_rows($qrpo);
	
	if($jmlpo>0){
		$no = 1;
		
		while($row = mysql_fetch_assoc($qrpo)){
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
			"<tr class='fonttd'>
				<td align='center'>$no</td>
				<td align=''>$a</td>
				<td align=''>$b</td>
				<td align=''>$c</td>
				<td align=''>$d</td>
				<td align=''>$e</td>
				<td align=''>$f</td>
				<td align='center'>$g</td>
				<td align='center'>$h</td>
				<td align='center'>$i</td>
				<td align='center'>$j</td>
				<td align='center'>$k</td>
				<td align='center'>$l</td>
				<td align=''>$m</td>
				<td align=''>$n</td>
				<td align=''>$o</td>
				<td align=''>$p</td>
				<td align=''>$q</td>
			</tr>";
			$no++;
		}
	}
}
function load_table_master_supplier(){
	$btl_ppb = "SELECT * FROM master_supplier order by supplier ASC";
	$qrbtl = mysql_query($btl_ppb);
	$jmlbtl = mysql_num_rows($qrbtl);
	
	if($jmlbtl>0){
		$no = 1;
		while($row = mysql_fetch_assoc($qrbtl)){
			$a = $row['supplier'];
			$b = $row['no_telp'];
			$c = $row['email'];
			$d = $row['alamat'];
			$e = $row['attn'];
			$f = $row['kategori'];
			$g = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td><td >$a</td><td>$b</td><td >$c</td><td align=''>$d</td><td>$e</td><td>$f</td><td>$g</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center'>$no</td><td >$a</td><td>$b</td><td >$c</td><td align=''>$d</td><td>$e</td><td>$f</td><td>$g</td>
				</tr>";
			}
			$no++;
		}
	}
}
function load_table_data_sisa_po(){
	$po = "SELECT * FROM po WHERE sisa_po > 0";
	$qrpo = mysql_query($po);
	$jmlpo = mysql_num_rows($qrpo);
	
	if($jmlpo>0){
		$no = 1;
		
		while($row = mysql_fetch_assoc($qrpo)){
			$a = $row['no_po'];
			$b = $row['supplier'];
			$c = $row['no_ppb'];
			$d = $row['kode'];
			$e = $row['kodebb'];
			$f = $row['packing'];
			$g = $row['sat'];
			$h = $row['unit'];
			$i = $row['po_datang'];
			$j = $row['sisa_po'];
			$k = $row['tgl_po'];
			$l = $row['tgl_kirim'];
			$m = $row['attn'];
			$n = $row['po_untuk'];
			$o = $row['kirim_ke'];
			$p = $row['kategori'];
			$q = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td><td align=''>$a</td><td align=''>$b</td><td align=''>$c</td><td align=''>$d</td><td align=''>$e</td><td align=''>$f</td><td align='center'>$g</td><td align='center'>$h</td><td align='center'>$i</td><td align='center'>$j</td><td align='center'>$k</td><td align='center'>$l</td><td align=''>$q</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
				<td align='center'>$no</td><td align=''>$a</td><td align=''>$b</td><td align=''>$c</td><td align=''>$d</td><td align=''>$e</td><td align=''>$f</td><td align='center'>$g</td><td align='center'>$h</td><td align='center'>$i</td><td align='center'>$j</td><td align='center'>$k</td><td align='center'>$l</td><td align=''>$q</td>
			</tr>";
			}
			$no++;
		}
	}
}
function load_table_data_penerimaan_barang_prc(){
	$btb = "SELECT * FROM btb";
	$qrbtb = mysql_query($btb);
	$jmlbtb = mysql_num_rows($qrbtb);
	
	if($jmlbtb>0){
		$no = 1;
		
		while($row = mysql_fetch_assoc($qrbtb)){
			$a = $row['no_btb'];
			$b = $row['no_sj'];
			$c = $row['no_po'];
			$d = $row['kode'];
			$e = $row['kodebb'];
			$f = $row['packing'];
			$g = $row['sat'];
			$h = $row['unit'];
			$i = $row['tonage'];
			$j = $row['tgl_btb'];
			$k = $row['kategori'];
			$l = $row['ket'];
			
			echo
			"<tr class='fonttd'>
				<td align='center'>$no</td><td align=''>$a</td><td align=''>$b</td><td align=''>$c</td><td align=''>$d</td><td align=''>$e</td><td align=''>$f</td><td align='center'>$g</td><td align='center'>$h</td><td align='center'>$i</td><td align='center'>$j</td><td align=''>$k</td><td align=''>$l</td>
			</tr>";
			$no++;
		}
	}

}
function load_table_data_ppb_belum_ada_po(){
	$data_ppb = "SELECT * FROM ppb where no_po=''";
	$qr = mysql_query($data_ppb);
	$jmlqr = mysql_num_rows($qr);
	
	if($jmlqr>0){
	$no = 1;
	
	while($row = mysql_fetch_assoc($qr)){
		$a = $row['no_ppb'];
		$b = $row['kode'];
		$c = $row['kodebb'];
		$d = $row['sat'];
		$e = $row['unit'];
		$f = $row['tonage'];
		$g = $row['tgl_ppb'];
		$h = $row['jthtmpo_ppb'];
		$i = $row['no_po'];
		$j = $row['kategori'];
		$k = $row['ket'];
		
		if($no%2==1){
			echo 
			"<tr class='tr_1'>
				<td align='center'>$no</td>
				<td align='' >$a</td>
				<td align=''>$b</td>
				<td align=''>$c</td>
				<td align='center'>$d</td>
				<td align='center'>$e</td>
				<td align='center'>$f</td>
				<td align='center'>$g</td>
				<td align='center'>$h</td>
				<td align=''>$j</td>
				<td align=''>$k</td>
			</tr>";
		}else{
			echo 
			"<tr class='tr_2'>
				<td align='center'>$no</td>
				<td align='' >$a</td>
				<td align=''>$b</td>
				<td align=''>$c</td>
				<td align='center'>$d</td>
				<td align='center'>$e</td>
				<td align='center'>$f</td>
				<td align='center'>$g</td>
				<td align='center'>$h</td>
				<td align=''>$j</td>
				<td align=''>$k</td>
			</tr>";
		}
		$no++;
		}
	}
}
function load_table_data_master_bb(){
	$btl_ppb = "SELECT * FROM master_barang WHERE kategori='Bahan Baku' LIMIT 10";
	$qrbtl = mysql_query($btl_ppb);
	$jmlbtl = mysql_num_rows($qrbtl);
	
	if($jmlbtl>0){
		$no = 1;
		while($row = mysql_fetch_assoc($qrbtl)){
			$a = $row['kode'];
			$b = $row['kodebb'];
			$c = $row['packing'];
			$d = $row['sat'];
			$f = $row['hrg_sat'];
			$g = $row['smin'];
			$h = $row['rop'];
			$i = $row['smax'];
			$j = $row['supplier'];
			$e = $row['LT'];
			$k = $row['kategori'];
			$l = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td>
					<td>$a</td>
					<td>$b</td>
					<td align='center'>$c</td>
					<td align='center'>$d</td>
					<td align='center'>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td>$j</td>
					<td>$e</td>
					<td>$l</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center'>$no</td>
					<td>$a</td>
					<td>$b</td>
					<td align='center'>$c</td>
					<td align='center'>$d</td>
					<td align='center'>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td>$j</td>
					<td>$e</td>
					<td>$l</td>
				</tr>";
			}
			$no++;
		}
	}
}
function load_table_data_master_kms(){
	$btl_ppb = "SELECT * FROM master_barang WHERE kategori='Kemasan' LIMIT 10";
	$qrbtl = mysql_query($btl_ppb);
	$jmlbtl = mysql_num_rows($qrbtl);
	
	if($jmlbtl>0){
		$no = 1;
		while($row = mysql_fetch_assoc($qrbtl)){
			$a = $row['kode'];
			$b = $row['kodebb'];
			$c = $row['packing'];
			$d = $row['sat'];
			$f = $row['hrg_sat'];
			$g = $row['smin'];
			$h = $row['rop'];
			$i = $row['smax'];
			$j = $row['supplier'];
			$e = $row['LT'];
			$k = $row['kategori'];
			$l = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td>
					<td>$a</td>
					<td>$b</td>
					<td align='center'>$d</td>
					<td align='center'>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td>$j</td>
					<td>$e</td>
					<td>$l</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td>
					<td>$a</td>
					<td>$b</td>
					<td align='center'>$d</td>
					<td align='center'>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td>$j</td>
					<td>$e</td>
					<td>$l</td>
				</tr>";
			}
			$no++;
		}
	}
}
function load_table_data_master_dus(){
	$btl_ppb = "SELECT * FROM master_barang WHERE kategori='Dus' LIMIT 10";
	$qrbtl = mysql_query($btl_ppb);
	$jmlbtl = mysql_num_rows($qrbtl);
	
	if($jmlbtl>0){
		$no = 1;
		while($row = mysql_fetch_assoc($qrbtl)){
			$a = $row['kode'];
			$b = $row['kodebb'];
			$c = $row['packing'];
			$d = $row['sat'];
			$d2 = $row['isi'];
			$f = $row['hrg_sat'];
			$g = $row['smin'];
			$h = $row['rop'];
			$i = $row['smax'];
			$j = $row['supplier'];
			$e = $row['LT'];
			$k = $row['kategori'];
			$l = $row['ket'];
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center'>$no</td>
					<td>$a</td>
					<td>$b</td>
					<td align='center'>$d</td>
					<td align='center'>$d2</td>
					<td align='center'>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td>$j</td>
					<td>$e</td>
					<td>$l</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center'>$no</td>
					<td>$a</td>
					<td>$b</td>
					<td align='center'>$d</td>
					<td align='center'>$d2</td>
					<td align='center'>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td>$j</td>
					<td>$e</td>
					<td>$l</td>
				</tr>";
			}
			$no++;
		}
	}
}

function load_table_data_po(){
	$po = "SELECT * FROM po";
	$qrpo = mysql_query($po);
	$jmlpo = mysql_num_rows($qrpo);
	
	if($jmlpo>0){
		$no = 1;
		
		while($row = mysql_fetch_assoc($qrpo)){
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
			
			if($no%2==1){
			echo
			"<tr class='tr_1'>
				<td align='center'>$no</td>
				<td align=''>$a</td>
				<td align=''>$b</td>
				<td align=''>$c</td>
				<td align=''>$d</td>
				<td align=''>$e</td>
				<td align=''>$f</td>
				<td align='center'>$g</td>
				<td align='center'>$h</td>
				<td align='center'>$i</td>
				<td align='center'>$j</td>
				<td align='center'>$k</td>
				<td align='center'>$l</td>
				<td align=''>$m</td>
				<td align=''>$n</td>
				<td align=''>$o</td>
				<td align=''>$q</td>
			</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center'>$no</td>
					<td align=''>$a</td>
					<td align=''>$b</td>
					<td align=''>$c</td>
					<td align=''>$d</td>
					<td align=''>$e</td>
					<td align=''>$f</td>
					<td align='center'>$g</td>
					<td align='center'>$h</td>
					<td align='center'>$i</td>
					<td align='center'>$j</td>
					<td align='center'>$k</td>
					<td align='center'>$l</td>
					<td align=''>$m</td>
					<td align=''>$n</td>
					<td align=''>$o</td>
					<td align=''>$q</td>
				</tr>";
			}
			$no++;
		}
	}
}
//-------- BTB-----
function nobtb(){
	date_default_timezone_set("Asia/Jakarta");
	$sql = "SELECT no_btb FROM btb ORDER BY no_btb DESC LIMIT 1";
	
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	$bulan = date('m');
	
	$tahun = date('y');
	$kode = '';
	
	if($jml > 0){
		$b = mysql_fetch_assoc($sq);
		
		$kode = $b['no_btb'];
		$kode_split = explode('.', $kode);
		$kode_index_0 = $kode_split[0];
		$kode_index_1 = (int) $kode_split[1];
		$kode_index_2 = (String) $kode_split[2];
		$kode_index_3 = (int) $kode_split[3];

		if($bulan != $kode_index_2){
			$counter = 1;
			if($counter <= 9) $kode_index_3 = "0000".$counter;
			else if($counter > 9 && $counter <= 99) $kode_index_3 = "000".$counter;
			else if($counter > 99 && $counter <= 999) $kode_index_3 = "00".$counter;
			else if($counter > 999 && $counter <= 9999) $kode_index_3 = "0".$counter;
			else if($counter > 9999 && $counter <= 99999) $kode_index_3 = $counter;
			else $kode_index_3 = "00001";
			
			$kode = $kode_index_0.'.'.$tahun.'.'.$bulan.'.'.$kode_index_3;
		}else{
			$counter = $kode_index_3 + 1;
			if($counter <= 9) $kode_index_3 = "0000".$counter;
				else if($counter > 9 && $counter <= 99) $kode_index_3 = "000".$counter;
				else if($counter > 99 && $counter <= 999) $kode_index_3 = "00".$counter;
				else if($counter > 999 && $counter <= 9999) $kode_index_3 = "0".$counter;
				else if($counter > 9999 && $counter <= 99999) $kode_index_3 = $counter;
				else $kode_index_3 = "0001";
				
			$kode = $kode_index_0.'.'.$tahun.'.'.$bulan.'.'.$kode_index_3;
			
		}
	}else $kode='BTB.'.$tahun.'.'.$bulan.'.00001';
	
	echo $kode;
}

//----PROFILE
function profile(){
	$sesUser = $_SESSION['username'];
	
	$profil = "SELECT * from profile where username='$sesUser'";
	$getprof = mysql_query($profil);

	$outprof = mysql_fetch_assoc($getprof);
	$a = $outprof['nama'];
	$b = $outprof['image'];
	$c = $outprof['jabatan'];
	$d = $outprof['alamat'];
	echo "<center><img src='$b' width='200' style='border:5px solid white;cursor:pointer;' id='gmbr' class='gambar' /><br/></center><br/>";
	echo "<table align='center' style='margin:0 0 0 5px';>
	<tr>
		<td class='nama'><a href='profile.php'>$a</a></td>
	</tr>
	<tr>
		<td class='ketp'>$c</td>
	</tr>
	<tr>
		<td class='ketp'>$d</td>
	</tr>
	</table>
	<br/>";
}	

function id_status(){
	$sql = "SELECT id_nm FROM status order by id_nm desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}

function id_komentar(){
$conpo = "SELECT id_k FROM komentar order by id_k desc LIMIT 1";
	$qrpo = mysql_query($conpo);
	$jmlpo = mysql_num_rows($qrpo);
	
	$a = 1;
	if($jmlpo>0){
		$b = mysql_fetch_assoc($qrpo);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
		$a++;
	}else echo $a;
}
function status(){
	$sql = "SELECT stat.*, kom.* FROM status stat LEFT OUTER JOIN komentar kom ON stat.id_nm=kom.id_m ORDER BY stat.id_nm DESC LIMIT 10";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$no  = 0;
	if($num>0){
		while ($row = mysql_fetch_assoc($qry)){
			$waktu = $row['waktu'];
			
			$id_nm = $row['id_nm'];
			$id_m = $row['id_m'];
			$pengirim = $row['pengirim'];
			$masalah = $row['masalah'];
			$pengirim_k = $row['pengirim_k'];
			$komentar = $row['komentar'];
			$waktu_k = $row['waktu_k'];
			
			
			$sql_p = "SELECT * FROM komentar WHERE id_m='$id_nm'";
			$qry_p = mysql_query($sql_p);
			$num_p = mysql_num_rows($qry_p);
			
			echo
			
			"
			<form name='komentar_p' id='komentar_p' action='komentar.php' method='POST'>
				
				<table style='margin-left:200px;margin-top:10px;border:2px solid grey;background-color:white;color:purple;width:780px;border-radius:0 10px 0 10px'>
					<tr>
						<td style='font-weight:bold;padding-left:10px;padding-top:10px;'>$pengirim <br/><span style='color:grey;font-size:12px'><i>$waktu</i></span></td>
					</tr>
					<tr>
						<td style='color:black;padding-left:10px;width:750px;padding-top:15'><div class='ktk_stts'>$masalah</div><br/><span style='color:grey;font-size:12px'>$num_p Solusi</span><hr/></td>
					</tr>
					<input type='hidden' name='id_nm' id='id_nm' value='$id_nm' />
					<tr>
						<td style='font-weight:bold;padding-right:30px;text-align:right;color:blue;cursor:pointer;'>$pengirim_k<br/><span style='color:grey;font-size:12px'>$waktu_k</span></td>
					</tr>
					<tr>
						<td style='padding-right:25px;text-align:right;'><div class='komen'>$komentar</div><br/><hr style='clear:right;margin-top:10px;width:300px;float:right;background-color:#e9e8e8;border:none;'/></td>
					</tr>
					<input type='hidden' name='id_k' id='id_k' value='id_komentar()' />
					<tr>
						<td><textarea name='komentar' id='komentar' style='color:black;padding:10px;width:740;margin-left:10px;'> </textarea></td>
					</tr>
					<tr>
						<td style='text-align:right;padding-right:20px;'><input type='submit' value='Kirim Solusi' class='sub_prof' style=''/></td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>
			</form>";
			$no++;
		}
	}
}
function id_btb(){
	$conpo = "SELECT id_nm FROM btb order by id_nm desc LIMIT 1";
	$qrpo = mysql_query($conpo);
	$jmlpo = mysql_num_rows($qrpo);
	
	$a = 1;
	if($jmlpo>0){
		$b = mysql_fetch_assoc($qrpo);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
		$a++;
	}
}

function noreturp(){
	date_default_timezone_set("Asia/Jakarta");
	$tahun	= date('y');
	$bulan	= date('m');
	$sql	= "SELECT * FROM retur_prod order by id_nm DESC LIMIT 1";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	$row	= mysql_fetch_assoc($qry);
	$no_ret	= $row['no_ret'];
	$ret_ex = explode(".",$no_ret);
	$ret1	= $ret_ex[1];
	$ret2	= $ret_ex[2];
	$ret3	= (int)$ret_ex[3];
	$no_rets= $ret3 + 1;
	
	if($num>0){
		if($ret2!=$bulan){
			echo "RTP.".$tahun.".".$bulan.".0001";
		}else{
			if($no_rets<=9) echo "RTP.".$tahun.".".$bulan.".000".$no_rets;
			else if($no_rets >9 && $no_rets<=99) echo "RTP.".$tahun.".".$bulan.".00".$no_rets;
			else if($no_rets >99 && $no_rets<=999) echo "RTP.".$tahun.".".$bulan.".0".$no_rets;
			else echo "RTP.".$tahun.".".$bulan.".".$no_rets;
		}
		
	}else{
		echo "RTP.".$tahun.".".$bulan.".0001";
	}
	
}

function nobkb(){
	date_default_timezone_set("Asia/Jakarta");
	$tahun	= date('y');
	$bulan	= date('m');
	$sql	= "SELECT * FROM bkb order by id_nm DESC LIMIT 1";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	$row	= mysql_fetch_assoc($qry);
	$no_ret	= $row['no_bkb'];
	$ret_ex = explode(".",$no_ret);
	$ret1	= $ret_ex[1];
	$ret2	= $ret_ex[2];
	$ret3	= (int)$ret_ex[3];
	$no_rets= $ret3 + 1;
	
	if($num>0){
		if($ret2!=$bulan){
			echo "BKB.".$tahun.".".$bulan.".0001";
		}else{
			if($no_rets<=9) echo "BKB.".$tahun.".".$bulan.".000".$no_rets;
			else if($no_rets >9 && $no_rets<=99) echo "BKB.".$tahun.".".$bulan.".00".$no_rets;
			else if($no_rets >99 && $no_rets<=999) echo "BKB.".$tahun.".".$bulan.".0".$no_rets;
			else echo "BKB.".$tahun.".".$bulan.".".$no_rets;
		}
		
	}else{
		echo "BKB.".$tahun.".".$bulan.".0001";
	}
	
}

function id_bkb(){
	$sql = "SELECT id_nm from bkb order by id_nm desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}

function no_val_ret(){
	$sql	= "SELECT * FROM val_ret order by id_nm DESC LIMIT 1";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	$row	= mysql_fetch_assoc($qry);
	$no_val	= $row['no_val'];
	$val	= (int) $no_val;
	$noval	= $val + 1;
	
	
	
	if($num>0){
		if($noval<=9) echo "0000".$noval;
		else if($noval>9 and $noval<=99) echo "000".$noval;
		else if($noval>99 and $noval<=999) echo "00".$noval;
		else if($noval>999 and $noval<=9999) echo "0".$noval;
		else if($noval>9999 and $noval<=99999) echo $noval;
	}else{
		echo "00001";
	}
}

function id_val_ret(){
	$sql = "SELECT id_nm from val_ret order by id_nm desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}

function id_val_tmb(){
	$sql = "SELECT id_nm from val_bkb order by id_nm desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}

function id_ret(){
	$sql = "SELECT id_nm FROM retur_prod order by id_nm desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}

function load_table_data_retur_produksi(){
	$sql = "SELECT ret.*, val.* FROM retur_prod ret LEFT OUTER JOIN val_ret val ON ret.no_val=val.no_val";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$no = 0;
	
	if($num>0){
		while($row = mysql_fetch_assoc($qry)){
			$no_ret = $row['no_ret'];
			$no_val = $row['no_val'];
			$tgl_ret= $row['tgl_ret'];
			$tgl_val= $row['tgl_val'];
			$kode 	= $row['kode'];
			$kodebb = $row['kodebb'];
			$sat 	= $row['sat'];
			$unit 	= $row['unit'];
			$tonage = $row['tonage'];
			$ket 	= $row['ket'];
			$no++;
			
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center' width='30'>$no</td>
					<td align='' width='90'>$no_ret</td>
					<td align='center' width='80'>$tgl_ret</td>
					<td align='center' width='90'>$no_val</td>
					<td align='center' width='80'>$tgl_val</td>
					<td align='' width='115'>$kode</td>
					<td align='' width='135'>$kodebb</td>
					<td align='center' width='40'>$sat</td>
					<td align='right' width='70'>$unit</td>
					<td align='right' width='70'>$tonage</td>
					<td width='95'>$ket</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center' width='30'>$no</td>
					<td align='' width='90'>$no_ret</td>
					<td align='center' width='80'>$tgl_ret</td>
					<td align='center' width='90'>$no_val</td>
					<td align='center' width='80'>$tgl_val</td>
					<td align='' width='115'>$kode</td>
					<td align='' width='135'>$kodebb</td>
					<td align='center' width='40'>$sat</td>
					<td align='right' width='70'>$unit</td>
					<td align='right' width='70'>$tonage</td>
					<td width='95'>$ket</td>
				</tr>";
			
			}
		}
	}

}

function load_table_keluar_barang(){
	$sql = "SELECt * FROM bkb";
	$qry = mysql_query($sql);
	$num =mysql_num_rows($qry);
	$no = 0;
	
	if($num>0){
		while($row = mysql_fetch_assoc($qry)){
			$no_bkb = $row['no_bkb'];
			$tgl_bkb= $row['tgl_bkb'];
			$klr_ke= $row['klr_ke'];
			$kode 	= $row['kode'];
			$kodebb = $row['kodebb'];
			$sat 	= $row['sat'];
			$unit 	= $row['unit'];
			$tonage = $row['tonage'];
			$ket 	= $row['ket'];
			$no++;
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center' width='30'>$no</td>
					<td align='left' width='120'>$no_bkb</td>
					<td align='center' width='80'>$tgl_bkb</td>
					<td align='left' width='100'>$klr_ke</td>
					<td align='left' width='120'>$kode</td>
					<td align='center' width='150'>$kodebb</td>
					<td align='center' width='40'>$sat</td>
					<td align='center' width='80'>$unit</td>
					<td align='center' width='80'>$tonage</td>
					<td align='center' width='120'>$ket</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center' width='30'>$no</td>
					<td align='left' width='120'>$no_bkb</td>
					<td align='center' width='80'>$tgl_bkb</td>
					<td align='left' width='100'>$klr_ke</td>
					<td align='left' width='120'>$kode</td>
					<td align='center' width='150'>$kodebb</td>
					<td align='center' width='40'>$sat</td>
					<td align='center' width='80'>$unit</td>
					<td align='center' width='80'>$tonage</td>
					<td align='center' width='120'>$ket</td>
				</tr>";
			
			}
		}
	}
}

function nobkbtm(){
	date_default_timezone_set("Asia/Jakarta");
	$tahun	= date('y');
	$bulan	= date('m');
	$sql	= "SELECT * FROM bkbtm order by id_nm DESC LIMIT 1";
	$qry	= mysql_query($sql);
	$num	= mysql_num_rows($qry);
	$row	= mysql_fetch_assoc($qry);
	$no_ret	= $row['no_bkbtm'];
	$ret_ex = explode(".",$no_ret);
	$ret1	= $ret_ex[1];
	$ret2	= $ret_ex[2];
	$ret3	= (int)$ret_ex[3];
	$no_rets= $ret3 + 1;
	
	if($num>0){
		if($ret2!=$bulan){
			echo "BKBTM.".$tahun.".".$bulan.".0001";
		}else{
			if($no_rets<=9) echo "BKBTM.".$tahun.".".$bulan.".000".$no_rets;
			else if($no_rets >9 && $no_rets<=99) echo "BKBTM.".$tahun.".".$bulan.".00".$no_rets;
			else if($no_rets >99 && $no_rets<=999) echo "BKBTM.".$tahun.".".$bulan.".0".$no_rets;
			else echo "BKBTM.".$tahun.".".$bulan.".".$no_rets;
		}
		
	}else{
		echo "BKBTM.".$tahun.".".$bulan.".0001";
	}
	
}

function id_bkbtm(){
	$sql = "SELECT id_nm FROM bkbtm order by id_nm desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}

function load_table_data_bkb_tambahan(){
	$sql = "SELECT tmb.*, val.* FROM bkbtm tmb LEFT OUTER JOIN val_bkb val ON tmb.no_val=val.no_val ORDER by tmb.id_nm DESC";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$no = 0;
	
	if($num>0){
		while($row = mysql_fetch_assoc($qry)){
			$no_ret = $row['no_bkbtm'];
			$no_val = $row['no_val'];
			$tgl_ret= $row['tgl_bkbtm'];
			$tgl_val= $row['tgl_val'];
			$kode 	= $row['kode'];
			$kodebb = $row['kodebb'];
			$sat 	= $row['sat'];
			$unit 	= $row['unit'];
			$tonage = $row['tonage'];
			$ket 	= $row['ket'];
			$no++;
			
			
			if($no%2==1){
				echo
				"<tr class='tr_1'>
					<td align='center' width='30'>$no</td>
					<td align='' width='90'>$no_ret</td>
					<td align='center' width='80'>$tgl_ret</td>
					<td align='center' width='90'>$no_val</td>
					<td align='center' width='80'>$tgl_val</td>
					<td align='' width='115'>$kode</td>
					<td align='' width='135'>$kodebb</td>
					<td align='center' width='40'>$sat</td>
					<td align='right' width='70'>$unit</td>
					<td align='right' width='70'>$tonage</td>
					<td width='95'>$ket</td>
				</tr>";
			}else{
				echo
				"<tr class='tr_2'>
					<td align='center' width='30'>$no</td>
					<td align='' width='90'>$no_ret</td>
					<td align='center' width='80'>$tgl_ret</td>
					<td align='center' width='90'>$no_val</td>
					<td align='center' width='80'>$tgl_val</td>
					<td align='' width='115'>$kode</td>
					<td align='' width='135'>$kodebb</td>
					<td align='center' width='40'>$sat</td>
					<td align='right' width='70'>$unit</td>
					<td align='right' width='70'>$tonage</td>
					<td width='95'>$ket</td>
				</tr>";
			
			}
		}
	}
}

function id_masalah(){
	$sql = "SELECT id_nm FROM masalah order by id_nm desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_nm'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}

function load_table_masalah(){
	$username = $_SESSION['username'];
	
	$sql = "SELECT mslh.*, sol.* FROM masalah mslh LEFT OUTER JOIN solusi sol ON mslh.id_nm=sol.id_ms WHERE nama='$username' ORDER by mslh.id_nm DESC";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$no = 1;
	
	if($num>0){
		while($row=mysql_fetch_assoc($qry)){
			$tanggal 	= $row['tanggal'];
			$jam 		= $row['jam'];
			$masalah 	= $row['masalah'];
			$jam_s 		= $row['jam_s'];
			$tanggal_s 	= $row['tanggal_s'];
			$solusi 	= $row['solusi'];
			
			if($no%2==1){
			echo "
			<tr class='tr_1'>
				<td align='center' width='30'>$no</td>
				<td align='center' width='85'>$tanggal</td>
				<td align='center' width='60'>$jam</td>
				<td width='300' style='padding-left:10px'>$masalah</td>
				<td align='center' width='85'>$tanggal_s</td>
				<td align='center' width='60'>$jam_s</td>
				<td width='300' style='padding-left:10px' >$solusi</td>
			</tr>";
			}else{
			echo "
			<tr class='tr_2'>
				<td align='center' width='30'>$no</td>
				<td align='center' width='85'>$tanggal</td>
				<td align='center' width='60'>$jam</td>
				<td width='300' style='padding-left:10px'>$masalah</td>
				<td align='center' width='85'>$tanggal_s</td>
				<td align='center' width='60'>$jam_s</td>
				<td width='300'style='padding-left:10px' >$solusi</td>
			</tr>";
			}
			$no++;
		}
	}else{
	
	}
}

function load_table_masalah_adm(){
	$username = $_SESSION['username'];
	
	$sql = "SELECT mslh.*, sol.* FROM masalah mslh LEFT OUTER JOIN solusi sol ON mslh.id_nm=sol.id_ms ORDER by mslh.id_nm DESC";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	$no = 1;
	
	if($num>0){
		while($row=mysql_fetch_assoc($qry)){
			$tanggal 	= $row['tanggal'];
			$jam 		= $row['jam'];
			$masalah 	= $row['masalah'];
			$jam_s 		= $row['jam_s'];
			$nama 	= $row['nama'];
			$tanggal_s 	= $row['tanggal_s'];
			$solusi 	= $row['solusi'];
			$id 	= $row['id_nm'];
			
			if($no%2==1){
			echo "
			<tr class='tr_1'>
				<td align='center' width='30'>$no</td>
				<td align='center' width='50'>$tanggal</td>
				<td align='center' width='85'>$nama</td>
				<td align='center' width='60'>$jam</td>
				<td width='270' style='padding-left:10px'>$masalah</td>
				<td align='center' width='50'>$tanggal_s</td>
				<td align='center' width='60'>$jam_s</td>
				<td width='270' style='padding-left:10px' >$solusi</td>
				<td><img src='../image/edit.png' height='30' style='margin:0 15px;cursor:pointer;' onclick='jawab_komplain($id)' /></td>
			</tr>";
			}else{
			echo "
			<tr class='tr_2'>
				<td align='center' width='30'>$no</td>
				<td align='center' width='50'>$tanggal</td>
				<td align='center' width='85'>$nama</td>
				<td align='center' width='60'>$jam</td>
				<td width='270' style='padding-left:10px'>$masalah</td>
				<td align='center' width='50'>$tanggal_s</td>
				<td align='center' width='60'>$jam_s</td>
				<td width='270'style='padding-left:10px' >$solusi</td>
				<td><img src='../image/edit.png' height='30' style='margin:0 15px;cursor:pointer;' onclick='jawab_komplain($id)' /></td>
			</tr>";
			}
			$no++;
		}
	}else{
	
	}
}

function id_solusi(){
	$sql = "SELECT id_s FROM solusi order by id_s desc LIMIT 1";
	$sq = mysql_query($sql);
	$jml = mysql_num_rows($sq);
	
	$a = 1;
	if($jml>0){
		$b = mysql_fetch_assoc($sq);
		$c = $b['id_s'];
		$a = $c + 1;
		echo $a;
	}else echo $a;
}

function load_table_stok_real(){
	$sql = "SELECt * FROM stock_barang";
	$qry = mysql_query($sql);
	$num = mysql_num_rows($qry);
	
	if($num>0){
		$no=1;
		while($row = mysql_fetch_assoc($qry)){
			$kode  		= $row['kode'];
			$kodebb 	= $row['kodebb'];
			$packing  	= $row['packing'];
			$sat  		= $row['sat'];
			$s_awal  	= $row['s_awal'];
			$masuk  	= $row['masuk'];
			$keluar  	= $row['keluar'];
			$s_akhir  	= $row['s_akhir'];
			$smin  		= $row['smin'];
			$rop  		= $row['rop'];
			$smax  		= $row['smax'];
			
			
			if($no%2==1){
			echo "
				<tr class='tr_1'>
					<td align='center' width=''>$no</td>
					<td align='' width=''>$kode</td>
					<td align='' width=''>$kodebb</td>
					<td align='' width=''>$packing</td>
					<td align='center' width=''>$sat</td>
					<td align='right' width=''>$s_awal</td>
					<td align='right' width=''>$masuk</td>
					<td align='right' width=''>$keluar</td>
					<td align='right' width=''>$s_akhir</td>
					<td align='right' width=''>$smin</td>
					<td align='right' width=''>$rop</td>
					<td align='right' width=''>$smax</td>
					<td><abbr title='Edit' ><img src='../image/edit.png' height='30' style='margin:0 15px;cursor:pointer;' onclick='edit_stok(\"$kode\")' name='hapus_st' id='hapus_st'/></abbr></td>
				</tr>
			";
			
			
			}else{
			echo "
				<tr class='tr_2'>
					<td align='center' width=''>$no</td>
					<td align='' width=''>$kode</td>
					<td align='' width=''>$kodebb</td>
					<td align='' width=''>$packing</td>
					<td align='center' width=''>$sat</td>
					<td align='right' width=''>$s_awal</td>
					<td align='right' width=''>$masuk</td>
					<td align='right' width=''>$keluar</td>
					<td align='right' width=''>$s_akhir</td>
					<td align='right' width=''>$smin</td>
					<td align='right' width=''>$rop</td>
					<td align='right' width=''>$smax</td>
					<td><img src='../image/edit.png' height='30' style='margin:0 15px;cursor:pointer;' onclick='edit_stok(\"$kode\")' name='hapus_st' id='hapus_st'/></td>
				</tr>
			";
			}
			$no++;
			
		}
	}
}

function user(){
	$sql = "SELECt * FROM profile";
	$qry = mysql_query($sql);
	$no = 1;
	while($row=mysql_fetch_assoc($qry)){
		$username 	= $row['username'];
		$password 	= $row['password'];
		$nama 		= $row['nama'];
		$no_telp 	= $row['no_telp'];
		$email 		= $row['email'];
		$jk 		= $row['jk'];
		$agama 		= $row['agama'];
		$alamat 	= $row['alamat'];
		$jabatan 	= $row['jabatan'];
		$image 		= $row['image'];
		
		if($no%2==1){
		echo "
			<tr class='tr_1'>
				<td width='30' align='center'>$no</td>
				<td width='120' >$username</td>
				<td width='120' >$password</td>
				<td width='130' >$nama</td>
				<td width='100' >$no_telp</td>
				<td width='120' >$email</td>
				<td width='70' >$jk</td>
				<td width='100' >$agama</td>
				<td width='200' >$alamat</td>
				<td width='50' ><img src='../image/edit.png' height='30' style='margin:0 15px;cursor:pointer;' onclick='edit_user(\"$username\")'/></td>
			</tr>
		
		";
		}else{
		echo "
			<tr class='tr_2'>
				<td width='30' align='center'>$no</td>
				<td width='120' >$username</td>
				<td width='120' >$password</td>
				<td width='130' >$nama</td>
				<td width='100' >$no_telp</td>
				<td width='120' >$email</td>
				<td width='70' >$jk</td>
				<td width='100' >$agama</td>
				<td width='200' >$alamat</td>
				<td width='50' ><img src='../image/edit.png' height='30' style='margin:0 15px;cursor:pointer;' onclick='edit_user(\"$username\")'/></td>
			</tr>
		
		";
		}
		$no++;
	}
	
}
?>