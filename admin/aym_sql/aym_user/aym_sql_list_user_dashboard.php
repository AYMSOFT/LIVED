<?php # **************************** AYMCORE V: 1.0 ********************
# PROCEDIMIENTO PARA OBTENER EL DASHBOARD DE UN USUARIO
# � 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY --> LISTA DE REGISTROS 	
	$aym_sql = "CALL `AYM_SP_LIST_USER_DASHBOARD`(".$_GET['use_id'].");";

	if (!$aym_sql_list_user_dashboard=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';
	} 

	mysqli_close($link);
?>