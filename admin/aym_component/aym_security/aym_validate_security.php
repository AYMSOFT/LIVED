<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA VALIDAR EL INGRESO POR LA APLICACIÓN
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022


	# VALIDACION  --> VARIABLE DE SESIÓN
	if (!isset($_SESSION['use_id'])) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_expire.php'; }
	# VALIDACION  --> PARA QUE INGRESE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }	
	if ($_SESSION['user_log_in'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }
	
?>