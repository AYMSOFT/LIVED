<?php # **************************** AYMCMS V: 7.0 ****************************
# PROCEDIMIENTO PARA CONTAR LAS NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link = aym_connect_cms();
	mysqli_set_charset($link, 'utf8');
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_COUNT_NEWS`('".$_GET['aym_tex_sea']."',".$_GET['new_cat_id'].",".$_GET['lan_id'].");";

	if (!$aym_count_news = mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_error.php';
	} else {
		$rows_for_page=0;
		$row_count_news =  mysqli_fetch_assoc($aym_count_news);
		$num_rows = $row_count_news['num_rows'];
		$aym_pages = ($row_count_news['num_rows'] / $_GET['aym_page_size']);
		$aym_page_ceil = ceil($aym_pages);
		mysqli_free_result($aym_count_news);
	}
	mysqli_close($link); 	
?>