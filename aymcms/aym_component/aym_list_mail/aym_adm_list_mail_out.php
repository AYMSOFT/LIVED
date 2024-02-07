<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA ADMINISTRAR LOS USUARIOS DE LA LISTA
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

session_start();

# ZONA HORARIA
date_default_timezone_set('America/Bogota');


/* --------------------------- AGREGAR UN CORREO --------------------------- */
if ($_POST['action'] == "I") {

	#ECHO '<pre>';print_r($_POST);ECHO '</pre>';EXIT;

	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['lis_ema'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
			
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (strlen($_POST['lis_ema'])< 3 || strlen($_POST['lis_ema'])>150){ $Msg = 'Nombre NO válido'; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}


	# VARIABLE
	$use_ip = aym_get_ip();
	
	# COMPONENTE ---> PROCESA LOS DATOS EN LA BD
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_list_mail/aym_sql_add_list_mail.php'; 
				
	# MENSAJE DE ERROR/CONFIRMACION
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
}

?>