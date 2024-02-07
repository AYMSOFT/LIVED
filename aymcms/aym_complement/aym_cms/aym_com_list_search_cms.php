<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA BUSCAR LAS PAGINAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start();
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_search_page_list.php';
	while($page = mysqli_fetch_assoc($aym_sql_list_page)){
		$pages = $pages."<div class='aym_page_result' id='".$page["pag_id"]."'><span>".$page["pag_tit"]."</span><span>".$page["pag_des"]."</span></div>"; 
	}	
	echo $pages;
?>