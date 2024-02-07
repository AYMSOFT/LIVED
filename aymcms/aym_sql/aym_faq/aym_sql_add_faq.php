<?php # **************************** AYMCMS V: 7.0 ****************************
# PROCEDIMIENTO PARA INSERTAR FAQ
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect_cms();
	mysqli_set_charset($link, "utf8");
	
	# QUERY
	$aym_sql = "CALL `AYM_SP_ADD_FAQ`(
		'".$_POST['faq_cat_id']."', 
		'".$_POST['faq_que']."', 
		'".$_POST['faq_ans']."', 
		'".$use_ip."', 
		'".$_SESSION['use_id']."'
	);";
	
	if (!$aym_sql_add_faq=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {
		$row_add_faq=mysqli_fetch_assoc($aym_sql_add_faq); 
		$ReturnStatus=$row_add_faq['ReturnStatus'];
		$Msg = $row_add_faq['Msg'];
		$_POST['faq_id'] = $row_add_faq['faq_id'];
		mysqli_free_result($aym_sql_add_faq);
	}

	mysqli_close($link);
?>