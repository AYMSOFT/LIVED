<?php 

session_start();

#INCLUSIÓN---> SQL PARA BUSCAR LAS PAGINAS
include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_list_search_image.php';

$imag  ='';
while($ima = mysqli_fetch_assoc($aym_sql_list_gallery_image)){
	$imag = $imag."<div class='aym_gallery_result' id='".$ima["gal_id"]."'><span>".$ima["gal_nam"]."</span><span>".$ima["gal_des"]."</span></div>"; 
}mysqli_free_result($aym_sql_list_gallery_image);
echo $imag;
?>