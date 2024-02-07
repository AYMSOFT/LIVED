<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA TRAER LOS DETALLES DE UN PERFIL
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");

	# QUERY
	$aym_sql = "CALL `AYM_SP_GET_PROFILE`(".$_GET['pro_id'].")";
	
	if (!$aym_sql_get_profile=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	} else {
		
		$aym_num_rows=mysqli_num_rows($aym_sql_get_profile);
		
		if ($aym_num_rows<1) {
			
			# VARIABLE 
			$Msg = 'El regisro que intentó editar ya NO existe en la base de datos.';
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
		}
		$row_get_profile = mysqli_fetch_assoc($aym_sql_get_profile);
		mysqli_free_result($aym_sql_get_profile);
	} 
	
	mysqli_close($link); 	
?>