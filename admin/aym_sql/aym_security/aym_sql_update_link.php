<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA ACTIVAR EL LINK DE RECUPERACION 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_UPDATE_LINK`('".$_GET['use_id']."','".$use_pwd."','".$use_pwd_ses."','".md5(base64_encode(session_id()))."')";


	if (!$aym_sql_update_link=mysqli_query($link,$aym_sql)) {
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_update_link=mysqli_fetch_assoc($aym_sql_update_link); 
		$ReturnStatus= $row_update_link['ReturnStatus'];
		$Msg=$row_update_link['Msg'];
		mysqli_free_result($aym_sql_update_link);
	}  
	
	mysqli_close($link);
?>
