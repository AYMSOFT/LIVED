<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA LISTAR NOTICIAS
# 2023 AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_GET_NEWS_COVER`('".$_GET['new_cat_id']."');";
	
	if (!$aym_sql_list_news_cover = mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	}else{
		$aym_num_rows = mysqli_num_rows($aym_sql_list_news_cover);
		$row_get_news_cover = mysqli_fetch_assoc($aym_sql_list_news_cover);
        mysqli_free_result($aym_sql_list_news_cover);
 	}

	mysqli_close($link); 
?>