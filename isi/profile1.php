    <?php  
	include "../koneksi.php";  
      
    $dataGambar = mysql_fetch_array(mysql_query("select * from profile"));  
    $filename = $dataGambar['file_name'];  
    $mime_type = $dataGambar['mime_type'];  
    $filedata = $dataGambar['file_data'];  
    header("content-disposition: inline; filename='".$filename."'");  
    header("content-type: $mime_type");  
    header("content-length: ".strlen($filedata));  
    echo ($filedata);  
    ?>   