  <?php

    include "koneksi.php";

    //echo "<a href=’input.php’>Add New data</a>";

    if(isset($_POST[CARI]))
    {
    $nama = $_POST[KUNCI];
    $sql = "SELECT * FROM ppb WHERE no_ppb = '".$nama."'";

    }
    else
    {

    $sql = "SELECT * FROM ppb";//-> ini query untuk select satu tabel. yaitu tabel mahasisiwa
    }

    //$sql = "SELECT * FROM mahasiswa";//-> ini query untuk select satu tabel. yaitu tabel mahasisiwa
    $hasil = mysql_query($sql);

    $warnaGenap = "#FFFFF"; // warna abu-abu
    $warnaGanjil = "#CEF6F5"; // warna putih
    //$warnaHeading = "#66CC00"; // warna merah untuk heading tabel

    echo "<table align=center border=1 cellpadding=2 cellspacing=0><tr>";
    echo "<tr bgcolor = ‘##F6CECE’><td align=’center’ colspan=’3′><b>Data Mahasiswa<b></td></tr>";
    echo "<th>Nama</th>";
    echo "<th>Jurusan</th>";
    echo "<th>Email</th>";
    echo "<tr>";
    $no=0;
    WHILE($data = mysql_fetch_array($hasil)){

    if ($no % 2 == 0) $warna = $warnaGenap;
    else $warna = $warnaGanjil;

    echo "<tr bgcolor=’.$warna’>";
    echo "<td>$data[no_ppb]</td>";
    echo "<td>$data[tgl_ppb]</td>";
    echo "<td>$data[ket]</td></tr>";

    $no++;

    }
    echo "</table>";

    ?>