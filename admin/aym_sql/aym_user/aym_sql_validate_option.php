<?php # **************************** AYMPROJECT V: 1.0 ********************
# COMPONENTE VALIDAR SI EL USUARIO CUMPLE CON EL TIPO DE USUARIO PERMITIDO
# AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUL/19/2014 

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_VALIDATE_OPTION`('".$_SESSION['use_id']."', '".$_GET['option']."');";

	if (!$aym_sql_validate_option=mysqli_query($link,$aym_sql)) {
		$aym_sp = 'AYM_SP_VALIDATE_OPTION';
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$aym_num_rows=mysqli_num_rows($aym_sql_validate_option);
		$row_validate_option=mysqli_fetch_assoc($aym_sql_validate_option); 
		$ReturnStatus = $row_validate_option['ReturnStatus'];
		$Msg = $row_validate_option['Msg'];
		mysqli_free_result($aym_sql_validate_option);
	}
	mysqli_close($link);
?>

