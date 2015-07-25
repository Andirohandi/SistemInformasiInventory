<?php
	$search = $_POST['search-text'];
	$sql = "SELECT * FROM ppb where no_ppb='".$search."'";
	$qry = mysql_query($sql);

?>