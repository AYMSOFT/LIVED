<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA ADMINISTRAR PERFIL
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	session_start(); 
	
	# ZONA HORARA
	date_default_timezone_set('America/Bogota');
		
	# CODIFICACIÓN --> UTF-8
	//echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
		
	#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	

#============================================================================================ 
#======================================== PERFIL ============================================
#============================================================================================

	#============================= AGREGAR PERFIL ==============================
	if ($_POST['action'] == 'I') { # I -->  INSERTAR PERFIL
	
	
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		
		# FUNCION ---> OBTIENE LA IP DEL PERFIL
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = "/admin/admprofile/aym_add_profile";
	
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pro_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['pro_nam']=aym_clean_string($_POST['pro_nam']);
	
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['pro_nam'])< 3){ $Msg = "Perfil NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
		$use_ip=aym_get_ip();	
		
		# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_add_profile.php'; 
		
		# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
		if ($ReturnStatus == '0') { # 0 --> PROCESADO SATISFACTORIAMENTE 
			# REDIRECCION --> LISTADO DE PERFILES
			$aym_url="/admin/admprofile/aym_list_profile";
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		} else { # 1 --> NO PROCESADO
			# REDIRECCION --> AGREGAR PERFIL
			$aym_url="/admin/admprofile/aym_add_profile";	
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		} 
		
	}  # FIN AGREGAR PERFIL	
	
	
	#============================= EDITAR PERFIL ==============================
	
	if ($_POST['action'] ==  'U') { # U -->  EDITAR PERFIL
		
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		
		# FUNCION ---> OBTIENE LA IP DEL PERFIL
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = "/admin/admprofile/aym_edit_profile/".$_POST['pro_id'];
	
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pro_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['pro_nam'])< 3){ $Msg = "Perfil NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['pro_nam']=aym_clean_string($_POST['pro_nam']);
	
		# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_update_profile.php'; 
		
		# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
		if ($ReturnStatus == '0') { # 0 --> PROCESADO SATISFACTORIAMENTE 
		
			#VARIABLE --> REDIRECION
			$aym_url="/admin/admprofile/aym_list_profile";
	
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		}		
		if ($ReturnStatus == '1') { # 1 --> NO PROCESADO
			
			#VARIABLE --> REDIRECION
			$aym_url="/admin/admprofile/aym_edit_profile/".$_POST['pro_id']."";
		
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		
		}
		
	} # --> FIN SI ES EDITAR	


	#============================= EDITAR PERFIL ==============================

	if($_POST['action'] == 'UT'){ #UB --> EDITAR PERFIL DESDE LA TABLA

		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		
		# FUNCION ---> OBTIENE LA IP
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# FUNCION --> LIMPIA URL
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_url/aym_fun_clean_url.php';	
		
		# VARIABLE ---> CONTIENE LA IP
		$use_ip = aym_get_ip();
		
		# REDIRECCION --> EDITAR DE BANNERS
		$aym_url = $_SERVER['HTTP_REFERER'];
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pro_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (!filter_var($_POST['pro_id'], FILTER_VALIDATE_INT)){ $Msg = "Perfil NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		
		#VARIABLE
		$_GET['pro_id'] = $_POST['pro_id'];

		# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN PERFIL
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_get_profile.php';

		if(isset($_POST['pro_nam'])){$_POST['pro_nam']=$_POST['pro_nam'];}else{$_POST['pro_nam']=$row_get_profile['pro_nam']; }
		
		
		# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_update_profile.php'; 
			
		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
		
	}# FIN SI ES EDITAR BANNER DESDE LA TABLA


#============================================================================================
#================================== ELIMINAR UN PERFIL ======================================
#============================================================================================
		
	if ($_POST['action']=='D') { # D -->  ELIMINAR PERFIL
			
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pro_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VALIDACION ---> INTEGRIDAD DE VARIABLES
		if (!filter_var($_POST['pro_id'],FILTER_VALIDATE_INT)){ $Msg = "Perfil NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
	

		# COMPONENTE --> PROCESA LOS DATOS EN LA BD
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_del_profile.php'; 
	
		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 
			
	} # --> FIN SI ES ELIMINAR	

#============================================================================================ 
#============================== ASIGNAR FUCIONES AL PERFIL  =================================
#============================================================================================

	
	if ($_POST['action'] == 'A') { # A -->  ASIGNAR FUCIONES AL PERFIL 
		
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pro_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pro_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['pro_nam']=aym_clean_string($_POST['pro_nam']);
		
		# EJECUTO EL COMPONENTE QUE ELIMINA LOS PERFILES ASUGNADOS AL USUARIO
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_del_profile_function.php'; 
		
		# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
		if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE  
		
			# QUERY --> LISTA TODAS LAS FUNCIONES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_list_all_function.php';
			
			$aym_array_fun_nam = '<ul>';
			$num_rows_affected=0;
			
			
			while ($row_list_function=mysqli_fetch_array($aym_sql_list_function)) {
						
				# VALIDACION --> QUE EL REGISTRO SEA EL QUE SE SELECCINÓ
				if (isset($_POST['aym_fun_on_off'][$row_list_function['fun_id']])) {
					
					$_POST['fun_id'] = $row_list_function['fun_id'];
					
					# QUERY --> ASIGNAR PERFILES A LOS USUARIOS 
					include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_add_profile_function.php';
					
					if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE 
						# ARREGLO
						$aym_array_fun_nam .= '<li>'.$row_list_function['fun_nam'].'</li>';
						$num_rows_affected++;

						// VERIFICAMOS TENGA MODULOS HIJOS
						if($row_list_function['num_sub_fun'] > 0){


							# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA SUB MODULOS DE MODULO PRINCIPAL
							include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_function/aym_sql_list_function_sub_function.php';

							while($row_list_sub_function = mysqli_fetch_array($aym_sql_list_function_sub_function)){
								# VALIDACION --> QUE EL REGISTRO SEA EL QUE SE SELECCINÓ
								if (isset($_POST['aym_fun_on_off'][$row_list_sub_function['fun_id']])) {
									
									$_POST['fun_id'] = $row_list_sub_function['fun_id'];
									
									# QUERY --> ASIGNAR PERFILES A LOS USUARIOS 
									include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_add_profile_function.php';
									
									if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE 
										# ARREGLO
										$aym_array_fun_nam .= '<li>---'.$row_list_sub_function['fun_nam'].'</li>';
										$num_rows_affected++;
	
									} 
									
								} # FIN SI 

							} mysqli_free_result($aym_sql_list_function_sub_function);
						

						}
					} 
					
				} # FIN SI 	
						
			} # FIN WHILE 
			
			mysqli_free_result($aym_sql_list_function);
			$Msg = $Msg.'<br>Las funciones asignadas al perfil fueron:<br>'.$aym_array_fun_nam.'</ul>';
			# REDIRECCION --> LISTAR PERFILES
			$aym_url="/admin/admprofile/aym_list_profile";
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		
		} else { 
		
			# VARIABLE --> DETERMINAR LA REDIRECION 
			$aym_url = "/admin/admprofilefunction/aym_add_function_profile/".$_POST['pro_id'];	
			# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		
		}
		
	} # --> FIN SI ES ASIGNAR PERFILES AL USUARIO 

?>