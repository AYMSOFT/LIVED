<?php # **************************** AYM EASY SITE V: 6.0 ********************
# COMPONENTE PARA LISTAR NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 sd

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_HEAD_NEWS`(0, ".$_GET['num_news'].", ".$_GET['new_cat_id'].", ".$_GET['lan_id'].")";
	
	if (!$aym_sql_list_news = mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	} else {
		$aym_num_news = mysqli_num_rows($aym_sql_list_news);
	}

	mysqli_close($link); 
?>