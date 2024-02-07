<?php # **************************** AYMSHOP V: 6.0 ********************
# PROCEDIMIENTO QUE LISTA TODAS LAS CATEGORIAS DASHBOARD
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
		
	# QUERY
	$aym_sql = "CALL `AYM_SP_LIST_ALL_DASHBOARD_CATEGORY`();";

	# QUERY --> LISTADO LOS REGISTROS 	
	if (!$aym_sql_list_all_dashboard_category=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {	
		$aym_num_rows = mysqli_num_rows($aym_sql_list_all_dashboard_category);
 	}
	mysqli_close($link);
?>       