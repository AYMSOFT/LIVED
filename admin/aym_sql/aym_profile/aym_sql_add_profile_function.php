<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE ASIGNAR FUNCIONES A LOS PERFILES 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
					
	# QUERY
	$aym_sql = "CALL `AYM_SP_ADD_PROFILE_FUNCTION`(".$_POST['pro_id'].", ".$_POST['fun_id'].");";
	# VALIDACION --> SINTAXIS
	if (!$aym_sql_insert_profile_function=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';			
	} else{
		$row_insert_profile_function=mysqli_fetch_assoc($aym_sql_insert_profile_function); 
		$ReturnStatus=$row_insert_profile_function['ReturnStatus'];
		$Msg=$row_insert_profile_function['Msg'];		
	} 
		
	mysqli_close($link); 	 
?>