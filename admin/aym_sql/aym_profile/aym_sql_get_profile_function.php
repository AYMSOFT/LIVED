<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA OBTENER LAS FUNCIONES DE UN PERFIL
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");

	
	# QUERY --> LISTA DE REGISTROS 	
	$aym_sql = "CALL `AYM_SP_GET_PROFILE_FUNCTION`(".$_GET['pro_id'].",".$_GET['fun_id'].");";

	if (!$aym_get_profile_function=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	} else {
		$aym_num_rows = mysqli_num_rows($aym_get_profile_function);
		mysqli_free_result($aym_get_profile_function);
	}
	mysqli_close($link);
?>