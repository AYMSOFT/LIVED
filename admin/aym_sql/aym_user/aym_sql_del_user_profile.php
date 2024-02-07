<?php # **************************** AYMCORE V: 14.0 ****************************
# COMPONENTE ASIGNAR PERFILES A LOS USUARIOS 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_security/aym_validate_security.php");

	# FUNCION --> CONENCION A LA BD
	include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_function/aym_connection/aym_connection.php");
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY --> ELIMINA LOS PERFILES DEL USUARIO 
	$aym_sql = "CALL `AYM_SP_DELETE_USER_PROFILE`(".$_POST['use_id'].");";
	
	if (!$aym_sql_delete_user_profile=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_del_user_profile=mysqli_fetch_assoc($aym_sql_delete_user_profile); 
		$ReturnStatus=$row_del_user_profile['ReturnStatus'];
		$Msg=$row_del_user_profile['Msg'];
		mysqli_free_result($aym_sql_delete_user_profile);
	} 
	
	mysqli_close($link);
?>
