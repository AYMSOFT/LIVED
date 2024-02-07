<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA VALIDAR EL USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022


    $_SESSION['alr'] = md5(session_id());

	# VALIDACION  DE VARIABLES
	if(isset($_GET['code'])) { 
		//echo '<br>'.$_GET['code'];
	}	
	if (isset($_GET['state'])) { 
		//echo '<br>'.$_GET['state'];
	}

	if (isset($_GET['error'])){ 
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = '/admin';
		$Msg = "Error: <strong>".$_GET['error']."</strong> <br><strong>".$_GET['error_description']."</strong>";
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';
	}

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
#================== AUTENTICACION DE USUARIO  ================== 


	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['use_log'], FILTER_VALIDATE_EMAIL)){ $Msg = "Email NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
    # COMPONENTE --> PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_validate_login_auth.php';

	# AUTENTICACIÓN EXITOSA
	if ($ReturnStatus == '0' ){ 
		
		# VARIABLES
		$use_log_ip = aym_get_ip();
		
		# VARIABLES DE SESION 
		$_SESSION['user_log_in'] = md5(session_id());
		$_SESSION['use_id'] = $row_val_login['use_id'];
		$_SESSION['use_log'] = $row_val_login['use_log'];
		$_SESSION['use_nam'] = $row_val_login['use_nam'];
		$_SESSION['cli_id'] = $row_val_login['cli_id'];
		$_SESSION['use_ava'] = $row_val_login['use_ima'];
		$_SESSION['sho_men']=1; # MOSTARR EL MENU
		
		
		#=======================================  LOG DE AUDITORIA  ========================================
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_add_login.php';	
		#================== ===================== CONTADOR DE ENTRADAS ==================================== 
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_update_login.php';	
		#================================================================================================
		
		
		# REDIRECIÓN DE LAS URL PARA DEVOLVERLO A LA ULTIMA 
		if(!empty($_POST['aym_referer'])){
			
			$row_url = explode('/',$_POST['aym_referer']);
			$row_url_discad = array('send-request-password','request-password','send-login','logout');
			$aym_url = $_POST['aym_referer'];

			foreach($row_url_discad as $key => $val){
				if(in_array($val,$row_url)){
					$aym_url = '/admin/welcome';
				}
			}
		} else {
			$aym_url = '/admin/welcome';
		}
		
		# REDIRECCION 
		echo "<meta http-equiv='Refresh'content='1; URL=".$aym_url."'>";
		exit;
		
	} else 
		
	# CAMBIAR LA CONTRASEÑA
	if ($ReturnStatus == '1' ){ 
		
		# VARIABLES
		$use_log_ip = aym_get_ip();
	
		# VARIABLES DE SESION 
		$_SESSION['user_log_in'] = md5(session_id());
		$_SESSION['use_id'] =$row_val_login['use_id'];
		$_SESSION['use_log'] = $row_val_login['use_log'];
		$_SESSION['use_nam'] = $row_val_login['use_nam'];
		$_SESSION['sho_men']=0; # OCULTAR EL MENU
		
		#=======================================  LOG DE AUDITORIA  ========================================
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_add_login.php';	
		#================== ===================== CONTADOR DE ENTRADAS ==================================== 
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_update_login.php';	
		#================================================================================================
		
		# REDIRECCION 
		$aym_url = "/admin/reset-password";		
		
		
	} else
	
	# AUTENTICACIÓN FALLIDA
	if ($ReturnStatus == '2' ){ 
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

			session_destroy(); 
			session_unset (); 
	}

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES 
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
?>