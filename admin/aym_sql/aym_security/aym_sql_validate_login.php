<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA VALIDAR EL USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_VALIDATE_LOGIN`('".$_POST['use_log']."','".$_POST['use_pwd']."')";
 
	if (!$aym_sql_validate_login=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_val_login=mysqli_fetch_assoc($aym_sql_validate_login); 
		$ReturnStatus=$row_val_login['ReturnStatus'];
		$Msg=$row_val_login['Msg'];
		$use_id=$row_val_login['use_id'];
	} 
	
	mysqli_close($link);
?>