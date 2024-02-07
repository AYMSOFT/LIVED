<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA LISTAR LAS FUNCIONES DE UN PERFIL
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY 
	$aym_sql = "CALL `AYM_SP_COUNT_FUNCTION_PROFILE`(".$_GET['pro_id'].");";
 
	if (!$aym_count_function_profile=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';		
	} else {
		$aym_num_function = mysqli_num_rows($aym_count_function_profile);
		mysqli_free_result($aym_count_function_profile);
	}
	mysqli_close($link);
?>