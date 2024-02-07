<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA ADMINISTRAR LOS USUARIOS
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	session_start(); 
	
	# ZONA HORARIA
	date_default_timezone_set('America/Bogota');
	
	#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
#============================================================================================
#=================================== AGREGAR UN USUARIO =====================================
#============================================================================================

if ($_POST['action'] == 'I') { # I -->  INSERTAR USUARIO

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = "/admin/admuser/aym_add_user";
	

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_typ_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd2'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['cli_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['off_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['use_nam']=aym_clean_string($_POST['use_nam']);	
	$_POST['emp_tex']=aym_clean_string($_POST['emp_tex']);	
	$_POST['use_log']=aym_clean_string($_POST['use_log']);	
	$_POST['use_pwd']=aym_clean_string($_POST['use_pwd']);
	$_POST['cli_id']=aym_clean_string($_POST['cli_id']);
	$_POST['off_id']=aym_clean_string($_POST['off_id']);


	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if($_POST['use_typ_id'] == 2){ # SI ES EMPLEADO
		if (strlen($_POST['emp_tex'])< 3 || strlen($_POST['emp_tex'])>150){ $Msg = "Empleado NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (!filter_var($_POST['cli_id'],FILTER_VALIDATE_INT)){ $Msg = "Seleccione un empleado NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}

		$_POST['use_nam'] = $_POST['emp_tex'];
		$_POST['off_id'] = 0;
	}else{
		if (strlen($_POST['use_nam'])< 3){ $Msg = "Nombre de Usuario NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	}
	if (strlen($_POST['off_id'])< 1){ $Msg = "Dependencia de Usuario NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_log'])< 3){ $Msg = "Cuenta de Usuario NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd'])< 8){ $Msg = "Contraseña NO nueva válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd2'])< 8){ $Msg = "Contraseña NO nueva válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if ($_POST['use_pwd'] <> $_POST['use_pwd2'] ){ $Msg = "Las Contraseñas nuevas NO coinciden"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	
	# VARIABLE
	$use_ip=aym_get_ip();

	
	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_add_user.php'; 


	if($ReturnStatus < 1){

		if($_POST['use_typ_id'] == 2){ # SI ES EMPLEADO

			$_POST['pro_id'] = 3; # PERFIL DE EMPLEADO
					
			# QUERY --> ASIGNAR PERFILES A LOS USUARIOS 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_add_user_profile.php';

		}


	}
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
} 

#============================================================================================
#=================================== EDITAR UN USUARIO ======================================
#============================================================================================

if ($_POST['action'] ==  'U') { # U -->  EDITAR USUARIO
	
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = "/admin/admuser/aym_edit_user/".$_POST['use_id'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_typ_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['cli_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['sta_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['off_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['use_nam']=aym_clean_string($_POST['use_nam']);	
	$_POST['use_log']=aym_clean_string($_POST['use_log']);
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (strlen($_POST['off_id'])< 1){ $Msg = "Dependencia de Usuario NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_nam'])< 3){ $Msg = "Nombre de Usuario NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_log'])< 3){ $Msg = "Cuenta de Usuario NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	$_GET['use_id']=$_POST['use_id'];
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php';
	
	
	if(!isset($_POST['use_dat_exp'])){
		$_POST['use_dat_exp'] = $row_get_user['use_dat_exp'];
	}
	
	#$_POST['cli_id'] = $row_get_user['cli_id'];

	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_update_user.php'; 

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
} # --> FIN SI ES EDITAR


#============================================================================================
#=================================== EDITAR UN USUARIO ======================================
#============================================================================================

if ($_POST['action'] ==  'UT') { # U -->  EDITAR USUARIO
	
	
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	if (!isset($_POST['use_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['use_id'],FILTER_VALIDATE_INT)){ $Msg = "Id de Usuario NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	
	$_GET['use_id']=$_POST['use_id'];
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php';
	
	if(isset($_POST['use_nam'])){
		$_POST['use_nam']=aym_clean_string($_POST['use_nam']);	
		if (strlen($_POST['use_nam'])<3){ 
			$Msg = "Nombre de Usuario NO válido"; 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';
		}
	}else{
		$_POST['use_nam'] =$row_get_user['use_nam'];
	}
	

	if(isset($_POST['off_id'])){
		$_POST['off_id']=aym_clean_string($_POST['off_id']);	
		if (!filter_var($_POST['off_id'],FILTER_VALIDATE_INT)){ $Msg = "Dependencia NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';
		}
	}else{
		$_POST['off_id'] = $row_get_user['off_id'];
	}
	
	$_POST['use_dat_exp'] = $row_get_user['use_dat_exp'];
	$_POST['use_log'] = $row_get_user['use_log'];
	$_POST['use_pwd'] = $row_get_user['use_pwd'];
	$_POST['use_pwd_cha'] = $row_get_user['use_pwd_cha'];
	$_POST['use_pwd_dat'] = $row_get_user['use_pwd_dat'];
	$_POST['use_pwd_ses'] = $row_get_user['use_pwd_ses'];
	$_POST['use_num_log'] = $row_get_user['use_num_log'];
	$_POST['use_ima'] = $row_get_user['use_ima'];
	$_POST['use_typ_id'] = $row_get_user['use_typ_id'];
	$_POST['sta_id'] = $row_get_user['sta_id'];
	$_POST['cli_id'] = $row_get_user['cli_id'];
	
	
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_update_user.php'; 
	

	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
	
} # --> FIN SI ES EDITAR


#============================================================================================
#================================== ELIMINAR UN USUARIO =====================================
#============================================================================================

if ($_POST['action'] == 'D') { # D -->  ELIMINAR USUARIO

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	
	# VALIDACION ---> INTEGRIDAD DE VARIABLES
	if (!filter_var($_POST['use_id'],FILTER_VALIDATE_INT)){ $Msg = "Usuario NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
	

	# INCLUSIÓN--> PROCEDIMIENTO QUE ELIMINA LOS USUARIOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_del_user.php'; 
# ENVIAR ESTADO A LA TABLA 
echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg,'aym_push'=>$aym_push,'aym_title'=>$aym_title]);
	 
} # --> FIN SI ES ELIMINAR	

if ($_POST['action'] == 'US') { # US -->  ACTUALIZAR USUARIO

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['sta_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url =$_SERVER['HTTP_REFERER']; 

	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_update_user_status.php'; 

	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg,'aym_push'=>$aym_push,'aym_title'=>$aym_title]);
	 
} # --> FIN SI ES ELIMINAR	


#============================================================================================
#============================ RESTAURAR LA CONTRASEÑA DEL USUARIO =============================
#============================================================================================
if ($_POST['action'] ==  'R') { # R -->  RESTAURAR LA CONTRASEÑA DE USUARIO
	

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = "/admin/admuser/aym_restore_pass";

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd2'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (strlen($_POST['use_log']) > 0){ $Msg = "Cuenta de Usuario NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd'])< 8){ $Msg = "Contraseña NO nueva válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd2'])< 8){ $Msg = "Contraseña NO nueva válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if ($_POST['use_pwd'] <> $_POST['use_pwd2'] ){ $Msg = "Las Contraseñas nuevas NO coinciden"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['use_log']=aym_clean_string($_POST['use_log']);	
	$_POST['use_pwd']=aym_clean_string($_POST['use_pwd']);

	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_restore_user_pass.php'; 

	# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
	if ($ReturnStatus == '0') { # 0 --> PROCESADO SATISFACTORIAMENTE 
		# REDIRECCION --> LISTAR USUARIO
		$aym_url="/admin/admuser/aym_list_user";
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	}		
	if ($ReturnStatus == '1') { # 1 --> ERROR
		# REDIRECCION --> LISTAR USUARIO
		$aym_url="/admin/admuser/aym_restore_pass";
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	} 
} # --> FIN SI ES RESTAURAR LA CONTRASEÑA DE USUARIO



#============================================================================================ 
#============================== ASIGNAR PERFILES AL USUARIO  ================================
#============================================================================================


	if ($_POST['action'] == 'A') { # A -->  ASIGNAR PERFILES AL USUARIO 

		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['use_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# EJECUTO EL COMPONENTE QUE ELIMINA LOS PERFILES ASUGNADOS AL USUARIO
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_del_user_profile.php'; 

		# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
		if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE  
			
			# QUERY --> LISTA TODOS LOS PERFILES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_list_all_profile.php';
			
			$aym_array_pro_nam = '<ul>';
			$num_rows_affected=0;
				
			while ($row_list_profile=mysqli_fetch_array($aym_sql_list_profile)) {
						
				# VALIDACION --> QUE EL REGISTRO SEA EL QUE SE SELECCINÓ
				if (isset($_POST['aym_per_on_off'][$row_list_profile['pro_id']])) {
					
					$_POST['pro_id'] = $row_list_profile['pro_id'];
					
					# QUERY --> ASIGNAR PERFILES A LOS USUARIOS 
					include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_add_user_profile.php';
					
					if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE 
						# ARREGLO
						$aym_array_pro_nam .= '<li>'.$row_list_profile['pro_nam'].'</li>';
						$num_rows_affected++;
					} 
					
				} # FIN SI 	
						
			} # FIN WHILE 

			mysqli_free_result($aym_sql_list_profile);
			
			if($num_rows_affected > 0){
				$Msg = $Msg.'<br>Los perfiles asignados al usuario '.$_POST['use_log'].' fueron:<br>'.$aym_array_pro_nam.'</ul>';
			}else{
				$ReturnStatus=1;
				$Msg .= '<br>El usuario '.$_POST['use_log'].' no tiene perfiles asignados.';
			}
			# REDIRECCION --> LISTAR USUARIO
			$aym_url="/admin/admuser/aym_list_user";
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
			echo "entra";
		exit;
		} else { 
		
			# VARIABLE --> DETERMINAR LA REDIRECION 
			$aym_url = "/admin/admuser/aym_add_user_profile/".$_POST['use_id'];	
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		
		}
		
	} # --> FIN SI ES ASIGNAR PERFILES AL USUARIO 


#============================================================================================
#============================ CAMBIAR LA CONTRASEÑA DEL USUARIO =============================
#============================================================================================


if ($_POST['action'] == 'C') { # C -->  CAMBIAR LA CONTRASEÑA USUARIO 


	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VALIDACION --> DETERMINAR LA REDIRECION 
	if ($_POST['aym_rec'] > 0 ) {
		if (empty($_POST['use_pwd'])) {
			$Msg = "Su sesión ha caducado. <br /><br /> Usted debe solicitar nuevamente el envío de su contraseña"; 
			# VARIABLE --> DETERMINAR LA REDIRECION 
			$aym_url="/admin/forgot_password";
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_expire.php';
		}
		$_SESSION['use_pwd'] = $_POST['use_pwd']; 
		$aym_url = "/admin/recoverypass";
	} else {	
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = "/admin/reset-password";
	}

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd1'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd2'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (strlen($_POST['use_log'])< 3){ $Msg = "Usuario NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd'])< 8){ $Msg = "Contraseña actual NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd1'])< 8){ $Msg = "Contraseña nueva NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd2'])< 8){ $Msg = "Contraseña nueva NOválida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['use_log']=aym_clean_string($_POST['use_log']);	
	$_POST['use_pwd']=aym_clean_string($_POST['use_pwd']);
	$_POST['use_pwd1']=aym_clean_string($_POST['use_pwd1']);
	
	# VALIDACIÓN ---> SI VIENE DESDE RECUPERAR LA CONTRASEÑA
	if ($_POST['aym_rec'] > 0 ) {
		# VARIABLES 
		$_POST['use_pwd1']=md5($_POST['use_pwd1']);
		$_POST['use_pwd2']=md5($_POST['use_pwd2']);
		# VALIDACIÓN
		if ($_POST['use_pwd1'] <> $_POST['use_pwd2'] ){ $Msg = "Las Contraseñas nuevas NO coinciden"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	} else {
		# VARIABLES 
		$_POST['use_pwd']=md5($_POST['use_pwd']);
		$_POST['use_pwd1']=md5($_POST['use_pwd1']);
		$_POST['use_pwd2']=md5($_POST['use_pwd2']);
		# VALIDACIÓN
		if ($_POST['use_pwd'] == $_POST['use_pwd1'] ){ $Msg = "La contraseña nueva es igual a la anterior"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if ($_POST['use_pwd1'] <> $_POST['use_pwd2'] ){ $Msg = "Las Contraseñas nuevas NO coinciden"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	}
	
	
	# PROCEDIMIENTO QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_change_user_pass.php'; 	
	
	if ($ReturnStatus == '0' ){ 
		$_SESSION['user_log_in'] = md5(session_id());
		$_SESSION['aym_menu'] = md5(session_id());
		
		# VARIABLE --> REDIRECCIÓN
		$aym_url = "/admin/welcome";
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

	} 

	if ($ReturnStatus == '1'){ 
		
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
        include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		exit;
	} 

} # --> FIN SI ES CAMBIAR LA CONTRASEÑA DEL USUARIO  



if ($_POST['action'] == 'CL') { # CL -->  CAMBIAR LA CONTRASEÑA UUSARIO LOGUEADO


	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VALIDACION --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd1'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_pwd2'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (strlen($_POST['use_log'])< 3){ $Msg = "Usuario NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd'])< 8){ $Msg = "Contraseña actual NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd1'])< 8){ $Msg = "Contraseña nueva NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['use_pwd2'])< 8){ $Msg = "Contraseña nueva NOválida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['use_log']=aym_clean_string($_POST['use_log']);	
	$_POST['use_pwd']=aym_clean_string($_POST['use_pwd']);
	$_POST['use_pwd1']=aym_clean_string($_POST['use_pwd1']);
	
	# VALIDACIÓN ---> SI VIENE DESDE RECUPERAR LA CONTRASEÑA
	if ($_POST['aym_rec'] > 0 ) {
		# VARIABLES 
		$_POST['use_pwd1']=md5($_POST['use_pwd1']);
		$_POST['use_pwd2']=md5($_POST['use_pwd2']);
		# VALIDACIÓN
		if ($_POST['use_pwd1'] <> $_POST['use_pwd2'] ){ $Msg = "Las Contraseñas nuevas NO coinciden"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	} else {
		# VARIABLES 
		$_POST['use_pwd']=md5($_POST['use_pwd']);
		$_POST['use_pwd1']=md5($_POST['use_pwd1']);
		$_POST['use_pwd2']=md5($_POST['use_pwd2']);
		# VALIDACIÓN
		if ($_POST['use_pwd'] == $_POST['use_pwd1'] ){ $Msg = "La contraseña nueva es igual a la anterior"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if ($_POST['use_pwd1'] <> $_POST['use_pwd2'] ){ $Msg = "Las Contraseñas nuevas NO coinciden"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	}
	
	
	# PROCEDIMIENTO QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_change_user_pass.php'; 	
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

} # --> FIN SI ES CAMBIAR LA CONTRASEÑA DEL USUARIO  


#============================================================================================
#============================ INSERTAR IMAGEN CROP DEL USUARIO ==============================
#============================================================================================


if ($_POST['action'] == 'IIC') { # IIC -->  INSERTAR IMAGEN CROP
	


	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = "/admin/myaccount";
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	#if (!isset($_FILES["use_ima"]['name'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_ima'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_add_user_image.php'; 
	
	$ReturnStatus=0;
	$Msg="Registro procesado satisfactoriamente";
	
	# VARIABLES
	$_GET['use_id'] = $_POST['use_id'];
	
	# INCLUSIÓN --> COMPONENTE QUE OBTIENE LA IMAGEN
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php';
	
	$_SESSION["use_ava"] = $row_get_user['use_ima'];
	
	echo '<img src="data:image/png;base64,'.$row_get_user['use_ima'].'" alt="'.$row_get_user['use_nam'].'">';
	
	 		

} # --> FIN INSERTAR IMAGEN DEL USUARIO 


#============================================================================================
#=============================== ELIMINAR IMAGEN DEL USUARIO ================================
#============================================================================================


if ($_GET['action'] == 'DIC') { # DI -->  ELIMINAR IMAGEN
	

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];

	$_POST['use_ima'] = '';

	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_add_user_image.php'; 

	$_SESSION["use_ava"] = '';


} # --> FIN ELIMINAR IMAGEN DEL USUARIO 


#============================================================================================ 
#============================== ASIGNAR DASHBOARD AL USUARIO  ===============================
#============================================================================================


if ($_POST['action'] == 'AD') { # AD -->  ASIGNAR DASHBOARD AL USUARIO 

	#ECHO '<pre>';print_r($_POST);ECHO '</pre>';EXIT;

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER']; 
	
	# CAPTURAMOS LA IP DEL USUARIO
	$use_ip = aym_get_ip();
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if(!isset($_POST['das_on'])){$_POST['das_on'] = [];}
	if (!isset($_POST['use_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['use_log'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS DASH DE UN USUARIO
	$_GET['use_id'] = $_POST['use_id'];
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_user_dashboard.php';
	
	# declaro arrays para  existentes
	$existentes_dashboard = [];
	$eliminar_dashboard = [];
	$$insertar_dashboard = [];
	
	# recorro los registrados en bd y los pongo en un array ($existentes_dashboard)
	while($row_list_user_dash_list = mysqli_fetch_array($aym_sql_list_user_dashboard)){
		if($row_list_user_dash_list['das_chk'] != 0){
			array_push($existentes_dashboard, $row_list_user_dash_list['das_id']);
		} 
	} mysqli_free_result($aym_sql_list_user_dashboard);
	
	# creo un array con los elementos que SI estan en bd y NO llegan desde el formulario
	$eliminar_dashboard = array_slice(array_diff($existentes_dashboard, $_POST['das_on']),0);

	# creo un array con los elementos que NO estan en bd y SI llegan desde el formulario
	$insertar_dashboard = array_slice(array_diff($_POST['das_on'],$existentes_dashboard),0);
	
	if(count($_POST['das_on']) == '' || count($_POST['das_on']) == 0 && count($existentes_dashboard) > 0){
		$eliminar_dashboard = $existentes_dashboard;
	}

	#recorro y elimino las harinas de masa en bd
	for ($ed=0; $ed < count($eliminar_dashboard); $ed++) { 
		# variable id ingrediente
		$das_id = $eliminar_dashboard[$ed];  

		# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_del_user_dashboard.php'; 
	}

	#recorro e inserto las harinas de masa en bd
	for ($id=0; $id < count($insertar_dashboard); $id++) {
		
		#declaro variable id del ingrediente
		$das_id = $insertar_dashboard[$id]; 

		# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_add_user_dashboard.php';
	}

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
} # --> FIN SI ES ASIGNAR PERFILES AL USUARIO 

?> 