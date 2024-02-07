<?php # **************************** AYMCORE V: 14.0 ****************************
# PROCEDIMIENTO PARA EDITAR USUARIOS
# � 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_security/aym_validate_security.php");

	# FUNCION --> CONENCION A LA BD
	include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_function/aym_connection/aym_connection.php");
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_UPDATE_USER_STATUS`(
		'".$_POST['use_id']."',
		'".$_POST['sta_id']."'
	);"; 
	
	if (!$aym_sql_update_user_status=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_get_user_status=mysqli_fetch_assoc($aym_sql_update_user_status); 
		$ReturnStatus=$row_get_user_status['ReturnStatus'];
		$Msg=$row_get_user_status['Msg'];
		$aym_push=$row_get_user_status['aym_push'];
		$aym_title=$row_get_user_status['aym_title'];
		mysqli_free_result($aym_sql_update_user_status);
	}
	mysqli_close($link);
?>