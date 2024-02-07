<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA VALIDAR EL USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_RECOVERY_PASS`('".$_POST['use_log']."')";

	if (!$aym_sql_recovery_pass=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_count = mysqli_num_rows($aym_sql_recovery_pass);
		$row_recovery_pass = mysqli_fetch_assoc($aym_sql_recovery_pass);
		mysqli_free_result($aym_sql_recovery_pass);
	} 
	
	mysqli_close($link);
	
?>
	
	
