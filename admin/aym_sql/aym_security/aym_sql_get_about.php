<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA OBTENER LA INFORMACIÓN DE LA APLICACIÓN
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_GET_ABOUT`()";

	if (!$aym_sql_get_about=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_get_about=mysqli_fetch_assoc($aym_sql_get_about); 
		mysqli_free_result($aym_sql_get_about);
	} 
	
	mysqli_close($link);
?>