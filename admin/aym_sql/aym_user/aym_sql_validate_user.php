<?php # **************************** AYMPROJECT V: 1.0 ********************
# COMPONENTE VALIDAR LA EXISTENCIA DE UAN CUENTA DE USUARIO
# AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUL/19/2014 

	
	# FUNCION --> CONENCION A LA BD
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_VALIDATE_USER`('".$_POST['use_log']."');";

	if (!$aym_sql_val_user=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$aym_num_rows=mysqli_num_rows($aym_sql_val_user);
		$row_get_user=mysqli_fetch_assoc($aym_sql_val_user); 
		mysqli_free_result($aym_sql_val_user);
	}
	mysqli_close($link);
?>

