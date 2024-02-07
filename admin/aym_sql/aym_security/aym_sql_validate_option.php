<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA VALIDAR MENU DE OPCIONES 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_VALIDATE_OPTION`(".$_SESSION['use_id'].", '".$_POST['fun_acc']."')";
 
	if (!$aym_sql_validate_option=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_val_option=mysqli_fetch_assoc($aym_sql_validate_option); 
		$ReturnStatus=$row_val_option['ReturnStatus'];
		$Msg=$row_val_option['Msg'];
		$aym_num_rows=$row_val_option['aym_num_rows'];
	} 
	
	mysqli_close($link);
?>