<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA VALIDAR LA EXISTENCIA DE UN USUARIO
# � 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_VALIDATE_USER`('".$_POST['use_log']."')";
 
	if (!$aym_sql_validate_user=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		
		$row_count = mysqli_num_rows($aym_sql_validate_user);
		$row_validate_user=mysqli_fetch_assoc($aym_sql_validate_user); 
		mysqli_free_result($aym_sql_validate_user);
	} 
	
	mysqli_close($link);
?>