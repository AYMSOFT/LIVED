<?php # **************************** AYMCORE V: 14.0 ********************
# PROCEDIMIENTO PARA LISTAR LOS USUARIOS
# � 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }	
	
	# FUNCION --> CONENCION A LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_connection/aym_connection.php';
	$link=aym_connect();
	mysqli_set_charset($link, "utf8");

	# QUERY
	$aym_sql = "CALL `AYM_SP_LIST_USER`(".$_GET['use_typ_id'].",'".$_GET['sta_id']."','".$_GET['aym_tex_sea']."', ".$aym_show_page.", ".$_GET['aym_page_size'].", ".$_GET['aym_order'].", ".$_GET['aym_order_type'].");";
	
	# QUERY --> LISTADO LOS REGISTROS 	
	if (!$aym_sql_list_user=mysqli_query($link,$aym_sql)) {
		# INCLUSI�N --> COMPONENTE QUE MUESTRA LOS ERRORES DE SINTAXIS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_error.php';	
	} else {	
		$aym_num_rows = mysqli_num_rows($aym_sql_list_user);
 	}
	mysqli_close($link); 	
?>