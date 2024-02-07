<?php # **************************** AYMCMS V: 7.0 ********************
# PROCEDIMIENTO QUE TRAE NOTICIA DESTACADA
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_security/aym_validate_security_out.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");

	# QUERY
	$aym_sql = "CALL `AYM_SP_GET_NEWS_COVER`(".$_GET['new_cat_id'].", ".$_GET['lan_id'].")";
	
	if (!$aym_sql_get_news_cover=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_get_news_cover=mysqli_fetch_assoc($aym_sql_get_news_cover); 
		mysqli_free_result($aym_sql_get_news_cover);
	} 

	mysqli_close($link);
?>