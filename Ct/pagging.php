<?php
include("../koneksi.php");

$results ="SELECT supplier FROM master_supplier";
$get_total_rows = mysql_fetch_array($results); //total records

//break total records into pages
$pages = ceil($get_total_rows[0]/$item_per_page);  

//create pagination
$pagination = '';
if($pages > 1)
{
    $pagination .= '<ul>';
    for($i = 1; $i<$pages; $i++)
    {
        $pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';
    }
    $pagination .= '</ul>';
}

?>