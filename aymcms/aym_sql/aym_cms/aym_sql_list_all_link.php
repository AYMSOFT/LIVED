<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA TRAER LA PRIMERA PAGINA DEPENDIENDO DE LA CATEGORIA
# � 2023, AYMSOFT SAS 
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 
	  
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");

	# QUERY 
	$aym_sql = "CALL `AYM_SP_LIST_ALL_LINK`(".$_GET['lan_id'].", ".$_GET['pag_cat_id'].")";
	
	# EJECUCION  --> LISTAR LAS PAGINAS
	if (!$aym_sql_get_page=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_get_page = mysqli_fetch_assoc($aym_sql_get_page);
		mysqli_free_result($aym_sql_get_page);
	}

	mysqli_close($link);
?>