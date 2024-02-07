<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA ADMINISTRAR EL MODULO FEEDBACK
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	session_start(); 

	# ZONA HORARIA
	date_default_timezone_set('America/Bogota');

	#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

	# VARIABLE GLOBAL
	$ReturnStatus='';

#============================================================================================
#=================================== AGREGAR UN FEEDBACK ====================================
#============================================================================================


if ($_POST['action'] == 'I'){ # I -->  INSERTAR FEEDBACK

	# FUNCION --> URL AMIGABLE
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_url/aym_fun_url.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	$use_ip=aym_get_ip();

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['fun_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['fee_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['fun_id'], FILTER_VALIDATE_INT)){$Msg = "Módulo a reportar NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['fee_des'])< 5){ $Msg = "Descripción del error NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	# PROCEDIMIENTO --> PARA TRAER LA OPCIÓN DEL MENU
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_get_menu.php';

    # ENVIAMOS MENSAJE AL ADMINISTRADOR
    $aym_dir_fol = $_SERVER['DOCUMENT_ROOT'].'/admin/aym_file_tmp/'.$_SESSION['use_id'];
    $aym_mail_from = $_SESSION['use_log'];
	$aym_mail_to = 'contacto@aymsoft.com';
	#$aym_mail_to = 'dsuaza@aymsoft.us';
	$aym_subject = 'Feedback - Servicio de error admin';
    $aym_message = '
        <html> 
            <head> 
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
                <title>REPORTE DE ERROR</title> 
            </head>
            <body> 
                <div id="aym_content_mail_recep">
                    <div style="border-bottom: 1px solid #000000; height: 5px; width: 100%; margin: 10px 0px;"></div>
                    <div><h2>Reporte de Error</h2></div>
                    <div class="aym_email_recep_text"><span><strong>M&oacute;dulo Reportado</strong></span><span>&nbsp;&nbsp;'.$row_get_function['fun_nam'].'</span></div>
                    <div class="aym_email_recep_text"><strong>Comentario:</strong></div>
                    <div class="aym_email_recep_msg">'.$_POST['fee_des'].'</div>
                    <div style="border-bottom: 1px solid #000000; height: 5px; width: 100%; margin: 10px 0px;"></div>
                </div>
            </body> 
        </html>';

    # COMPONENTE PARA ENVIAR EL CORREO CON MULTIPLES ARCHIVO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_email/aym_send_mail_multiple_file.php';
	
	# COMPONENTE PARA ENVIAR LA CONFIRMACIÓN DEL REQUERIMIENTO AL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_email/aym_send_mail_user_feedback.php';


	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

} # --> FIN DEL INSERTAR

#============================================================================================
#=================================== INSERTAR IMAGENES ======================================
#============================================================================================

if($_POST['action'] == 'II'){  # II -->  INSERTAR IMAGENES

	$aym_root = $_SERVER['DOCUMENT_ROOT'].'/aym_document/aym_help/'.md5($_SESSION['use_id']);

	if (!is_dir($aym_root)) {

		//VALIDACION --> CREACIÓN DEL DIRECTORIO
		if (!mkdir($aym_root,0755)) {
			$ReturnStatus =1;
			$Msg = 'No se pudo crear el directorio <br /><br /> <strong>Motivo:</strong> La carpeta raiz (aym_image) no ha sido creada. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.';
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}
	}


	if ($_FILES["use_ima"]['name'] <> ""){
		$nombre_archivo_ori = $_FILES['use_ima']['name'];
		#VALIDACION --> CARGA DE LA IMAGEN AL SERVIDOR
		if (!move_uploaded_file($_FILES['use_ima']["tmp_name"], $aym_root."/".$nombre_archivo_ori)){

			$ReturnStatus =1;
			$Msg = "No se pudo establecer la carpeta de destino <br /><br /> <strong> Motivo:</strong> La carpeta raiz no ha sido creada. <br /><br /> <strong>Sugerencia:</strong> Consulte al administrador del aplicativo.";
		}
	}
}

#============================================================================================
#=================================== ELIMINAR ARCHIVOS ======================================
#============================================================================================

if($_POST['action'] == 'DF'){ # DF -->  ELIMINAR ARCHIVOS

	if (!isset($_POST['url'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	$row_url = explode('/',$_POST['url']);

	if(count($row_url)<>5){
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';
	}

	if($row_url[3] <> md5($_SESSION['use_id'])){
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';
	}

	if(!unlink($_SERVER['DOCUMENT_ROOT'].$_POST['url'])){

	}

	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

}
?>