<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA LISTAR LOS SUBMODULOS DE UN MODULO PRINCIPAL
# © 2023, AYMSOFT SAS
# DIEGO SUAZA AGO/08/23


	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_LIST_FUNCTION_SUB_FUNCTION`('".$_POST['fun_id']."');";
	
	if (!$aym_sql_list_function_sub_function=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	}else{
		$aym_num_rows = mysqli_num_rows($aym_sql_list_function_sub_function);
	}
	
	mysqli_close($link);
?>