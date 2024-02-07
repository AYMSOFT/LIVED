<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA ADMINISTRAR LISTAS DE CORREO
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start(); 
	
	date_default_timezone_set('America/Bogota');
	
	
	#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';



	#=============================================================================================================
	#============================================== ELIMINAR CORREO ==============================================
	#=============================================================================================================

		if ($_POST['action'] == 'D') { # D -->  ELIMINAR CORREO

			# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
			if (!isset($_POST['lis_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

			# VALIDACION ---> INTEGRIDAD DE VARIABLES
			if (!filter_var($_POST['lis_id'],FILTER_VALIDATE_INT)){$ReturnStatus=1;$Msg="ID Correo NO válido";include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

			# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
			include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_list_mail/aym_sql_delete_list_mail.php'; 

			# ENVIAR ESTADO A LA TABLA 
			echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 


		} # --> FIN SI ES ELIMINAR 	
?>