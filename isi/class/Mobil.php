<?php
class Mobil{

	function ban(){
		echo "ma aing";
	}
	function panto(){
	// kode buntut
		$naonwe = "ma sia";
		return $naonwe;
	}
	function kaca_mobil($term){
		$arr_val = '';
		if($term == "array"){
			$arr_val = array(
				'kode' => 'A',
				'value' => 'A0'
			);
		}
		return json_encode($arr_val);
	}
}

include "class/Mobil.php";

$mobil = new Mobil();

echo $mobil->ban();
$tampil = $mobil->panto();
echo "<br />".$tampil;

$kaca = $mobil->kaca_mobil("array");
$kaca = json_decode($kaca);
echo $kaca->kode."<br />";
echo $kaca->value;

?>