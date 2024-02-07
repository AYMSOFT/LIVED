<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA LISTAR TODOS LOS TIPOS DE LENGUAGE
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect(); 
	mysqli_set_charset($link,"utf8");
	
	# QUERY
	 $aym_sql = "CALL `AYM_SP_LIST_ALL_LANGUAGE`();";
	
	if (!$aym_sql_list_all_language=mysqli_query($link, $aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$aym_num_rows = mysqli_num_rows($aym_sql_list_all_language);
	}
	
	mysqli_close($link);
?>