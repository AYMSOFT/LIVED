<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA LISTAR TODOS LOS REGISTROS DE LOG DEL USUARIO
# � 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 


	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_LIST_USER_LOG`(".$_GET['use_id'].", ".$aym_show_page.", ".$_GET['aym_page_size'].");";
	
	if (!$aym_sql_list_user_log=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} 
	
	mysqli_close($link);
?>