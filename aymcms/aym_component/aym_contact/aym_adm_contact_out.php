<?php # **************************** AYM EASY SITE V: 5.1 ********************
# COMPONENTE PARA ADMINSITRAR LOS CONTACTOS
# AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ABR/21/2014 

	session_start();

	# VALIDACIÓN QUE ENTRE POR EL APLICATIVO
	if ($_SESSION['alr'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }
	if ($_SESSION['contact'] <> md5(session_id())) { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }
	if ($_SESSION['use_id'] <> '0') { include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php'; }
		
	# ZONA HORARIA
	date_default_timezone_set('America/Bogota');
	
	# PRELOAD	
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	echo '<center style="position: absolute;top: 0;bottom: 0;right: 0;left: 0;margin: auto;width: fit-content;height: fit-content;"><img src="/aym_image/aym_loading.svg" style="width:30px !important" /></center>';

	if ($_POST['action']== "I") { # INSERTAR CONTACTO 

		
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		
		# FUNCION --> FECHA NO HABIL
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_date/aym_fun_get_holiday.php';
		
		# FUNCION ---> OBTIENE LA IP
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = $_SERVER['HTTP_REFERER']; 
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['con_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['con_ema'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['con_tel'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['con_com'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['token'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['con_nam']=aym_clean_string($_POST['con_nam']);
		$_POST['con_ema']=aym_clean_string($_POST['con_ema']);
		$_POST['con_tel']=aym_clean_string($_POST['con_tel']);
		$_POST['con_com']=aym_clean_string($_POST['con_com']);
		#$_POST['captchacode']=aym_clean_string($_POST['captchacode']);
		
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['con_nam'])< 3){ $Msg = 'Nombre NO válido'; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message_out/aym_show_message_redirect.php';}
		if (!filter_input(INPUT_POST, 'con_ema', FILTER_VALIDATE_EMAIL)){ $Msg = 'Email NO válido'; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message_out/aym_show_message_redirect.php';}
		if (strlen($_POST['con_tel'])< 7){ $Msg = 'Teléfono NO Válido'; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message_out/aym_show_message_redirect.php';}
		if (strlen($_POST['con_com'])< 4){ $Msg = 'Comentario NO válido'; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message_out/aym_show_message_redirect.php';}
		
		#=================================================================================================
		#========================================== CODIGO CAPCHA ========================================
		#=================================================================================================
		
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $secret = "6LeJowgnAAAAAITTZ9p29fWNdQo3TJrrxHzqdWiX" ;
        $response = $_POST['token'];
        $remoteip = $_SERVER['REMOTE_ADDR'];
        
        $dav = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$ip);
        $response = json_decode($dav,true);
        
        if($response['success'] == false){
			$ReturnStatus = 1;
			$Msg =  '<br /> El sistema detecto actividad sospechosa <br /> <br /> No se identifico que sea una persona.'; 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';
		}
		
		$aym_root = $_SERVER['DOCUMENT_ROOT'].'/admin/aym_file_tmp/'.md5(session_id());
		
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_email/aym_send_mail_contact_file.php';

		
		# REGISTRO SATISFACTORIAMENTE 
		if ($ReturnStatus < 1) {

			$aym_url = '/inicio'; 			
		}

		# PROCEDIMIENTO PARA LIMPIAR ARCHIVOS TEMPORALES
		$action = 'tmp';
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_clear_file_tmp_out.php';

		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message_out/aym_show_message.php';	

	}

?>