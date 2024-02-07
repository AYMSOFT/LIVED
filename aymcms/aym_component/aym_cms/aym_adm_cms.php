<?php # **************************** AYMSITE V: 5.7 ********************
# COMPONENTE PARA ADMINISTRAR LAS PAGINAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUL/26/2013
	
	session_start(); 
	date_default_timezone_set('America/Bogota');

	#VALIDACION --> PARA INGRESAR AL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

#=============================================================================================================
#============================================== INSERTAR PAGINA ==============================================
#=============================================================================================================
	
	if ($_POST['action'] == 'I') { # I -->  INSERTAR PAGINA
		
		# FUNCION --> LIMPIA URLS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';
		
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		 
		# FUNCION ---> OBTIENE LA IP DEL USUARIO
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = $_SERVER['HTTP_REFERER']; 
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['lan_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_sub_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_tem'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_tit'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_con'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_url'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_tar'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_ima_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_pos'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_FILES['aym_fil']['name'][0])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		 
		if (!isset($_POST['gal_ass'])){ $_POST['gal_ass']=0; $_POST['gal_sub_cat_id'] = 0; $_POST['gal_cat_id'] = 0; }
		if (!isset($_POST['ban_ass'])){ $_POST['ban_ass']=0; $_POST['ban_cat_id'] = 0; }
		if (!isset($_POST['pag_pub'])){ $_POST['pag_pub']=0; }
		if (!isset($_POST['pag_sho_map'])){ $_POST['pag_sho_map']=0; }
		if (!isset($_POST['pag_hol'])){ $_POST['pag_hol']=0; }
		
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['pag_tit']=aym_clean_string($_POST['pag_tit']);	
		$_POST['pag_des']=aym_clean_string($_POST['pag_des']);
		$_POST['pag_ima_cap']=aym_clean_string($_POST['pag_ima_cap']);
		
		# VARIABLE --> LIMPIEZA DE VARIABLES URL
		$use_ip = aym_get_ip();
		
		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['pag_tit'])< 3|| mb_strlen($_POST['pag_tit'])>100){ $Msg = " Titulo NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (mb_strlen($_POST['pag_des'])< 3|| mb_strlen($_POST['pag_des'])>255){ $Msg = "Descripción NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (mb_strlen($_POST['pag_con'])< 3|| mb_strlen($_POST['pag_con'])>4294967295){ $Msg = "Contenido NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (!filter_input(INPUT_POST, 'pag_cat_id', FILTER_VALIDATE_INT)){ $Msg = "Categoria NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (mb_strlen($_POST['pag_sub_id']) < 0){ $Msg = "Página NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (!filter_input(INPUT_POST, 'pag_pos', FILTER_VALIDATE_INT)){ $Msg = "Orden NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if(isset($_POST['ima_thu'])){$_POST['ima_thu']=1;}else{$_POST['ima_thu']=0;}

		#VALIDACION DE IMAGENES SI VIENE ALGUNA
		if(!empty($_FILES['aym_fil']['name'][0])){
			for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
				#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
				include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_validate_multiple_file.php';
			}
		}
		
		# INCLUSIÓN--> PROCEDIMIENTO PARA INSERTAR UN CONTENIDO
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_add_page.php';
				
		# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
		if ($ReturnStatus < 1) { # 1 --> NO PROCESADO
		
			/*=================================================================================== */
			/*======================================= AGREGAR MENUS ============================= */
			/*=================================================================================== */
			
			if (!isset($_POST['aym_pag_men_chk_'])) { $_POST['aym_pag_men_chk_'] = [];}
			
			if(count($_POST['aym_pag_men_chk_']) > 0){
				
				# FOREACH QUE RECORRE EL ARRAY DEL MENU
				foreach($_POST['aym_pag_men_chk_'] as $pag_men_id) {
					
					# INCLUSIÓN--> PROCEDIMIENTO PARA INSERTAR UN SUB MENU DE CONTENIDO
					include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_add_page_menu.php';
					
					
				}# - > FIN DEL FOREACH
			}

			/*=================================================================================== */
			/*====================================== AGREGAR IMAGEN ============================= */
			/*=================================================================================== */
			
			if(!empty($_FILES['aym_fil']['name'][0])){
				#DEFINICION---> Carpeta padre
				$aym_dir_parent = $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_cms/';
				#DEFINICION---> Carpeta que contendra archivos dentro de la carpeta padre
				$aym_dir = $aym_dir_parent.'/'.$pag_id;
				
				$_POST['pag_id'] = $pag_id;
				
				for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
					
					$extension = pathinfo($_FILES["aym_fil"]['name'][$i], PATHINFO_EXTENSION);
					
					# INCLUSIÓN--> PROCEDIMIENTO PARA INSERTAR UNA IMAGEN
					include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_add_page_image.php';
					
					#VARIABLES---> NOMBRE Y EXTENSION DEL ARCHIVO A SUBIR
					
					$nombre_archivo = $pag_ima_id.'.'.$extension;
					
					#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
					include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_cms/aym_move_image.php';
				}
			}
			
			/*=================================================================================== */
			/*=================================================================================== */
			/*=================================================================================== */
			$aym_url = $_SERVER['HTTP_REFERER']; 
			
		} 
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		
	} # --> FIN SI ES AGREGAR
	
#=============================================================================================================
#============================================= ACTUALIZAR PAGINA =============================================
#=============================================================================================================

	if ($_POST['action'] == 'U') { # U -->  ACTUALIZAR PAGINA
		// print_r($_POST);
		// EXIT;
		
		# FUNCION --> LIMPIA URLS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';
		
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		
		# FUNCION ---> OBTIENE LA IP DEL USUARIO
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = $_SERVER['HTTP_REFERER']; 
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pag_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['lan_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_sub_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_tem'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_tit'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_con'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_url'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_tar'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_pos'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_FILES['aym_fil']['name'][0])){ echo "14";exit;include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		if (!isset($_POST['gal_ass'])){ $_POST['gal_ass']=0; $_POST['gal_sub_cat_id'] = 0; }
		if (!isset($_POST['ban_ass'])){ $_POST['ban_ass']=0; $_POST['ban_cat_id'] = 0; }
		if (!isset($_POST['pag_pub'])){ $_POST['pag_pub']=0; }
		if (!isset($_POST['pag_sho_map'])){ $_POST['pag_sho_map']=0; }
		if (!isset($_POST['pag_hol'])){ $_POST['pag_hol']=0;}
		
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['pag_tit']=aym_clean_string($_POST['pag_tit']);	
		$_POST['pag_des']=aym_clean_string($_POST['pag_des']);
	
		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['pag_tit'])< 3|| mb_strlen($_POST['pag_tit'])>100){ $Msg = " Titulo NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (mb_strlen($_POST['pag_des'])< 3|| mb_strlen($_POST['pag_des'])>255){ $Msg = "Descripción NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (mb_strlen($_POST['pag_con'])< 3|| mb_strlen($_POST['pag_con'])>4294967295){ $Msg = "Contenido NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (!filter_input(INPUT_POST, 'pag_cat_id', FILTER_VALIDATE_INT)){ $Msg = "Categoria NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (mb_strlen($_POST['pag_sub_id']) < 0){ $Msg = "Página NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (!filter_input(INPUT_POST, 'pag_pos', FILTER_VALIDATE_INT)){ $Msg = "Orden NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if(isset($_POST['ima_thu'])){$_POST['ima_thu']=1;}else{$_POST['ima_thu']=0;}
		
		#VARIABLES NECESARIAS
		$use_ip = aym_get_ip();
		$pag_id = $_POST['pag_id'];
		
		#VALIDACION DE IMAGENES SI VIENE ALGUNA
		if(!empty($_FILES['aym_fil']['name'][0])){
			for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
				#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
				include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_validate_multiple_file.php';
			}
		}
		
		/*=================================================================================== */
		/*====================================== AGREGAR IMAGEN ============================= */
		/*=================================================================================== */

		if(!empty($_FILES['aym_fil']['name'][0])){
			#DEFINICION---> Carpeta padre
			$aym_dir_parent = $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_cms/';
			#DEFINICION---> Carpeta que contendra archivos dentro de la carpeta padre
			$aym_dir = $aym_dir_parent.'/'.$pag_id;

			$_POST['pag_id'] = $pag_id;

			for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
				$extension = pathinfo($_FILES["aym_fil"]['name'][$i], PATHINFO_EXTENSION);

				# INCLUSIÓN--> PROCEDIMIENTO PARA INSERTAR UNA IMAGEN
				include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_add_page_image.php';

				#VARIABLES---> NOMBRE Y EXTENSION DEL ARCHIVO A SUBIR


				$nombre_archivo = $pag_ima_id.'.'.$extension;

				#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
				include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_cms/aym_move_image.php';
			}
		}

		/*=================================================================================== */
		/*=================================================================================== */
		/*=================================================================================== */
		
		
		# INCLUSIÓN--> PROCEDIMIENTO PARA ACTUALIZAR UN CONTENIDO
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_update_page.php';
		
		# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
		if ($ReturnStatus < 1) { # 1 --> NO PROCESADO

			
			# INCLUSIÓN--> PROCEDIMIENTO PARA ELIMINAR EL MENU DE UNA PÁGINA
			include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_delete_page_menu.php';
			
			//if($ReturnStatus < 1){
			
				/*=================================================================================== */
				/*======================================= AGREGAR MENUS ============================= */
				/*=================================================================================== */
			
				if (!isset($_POST['aym_pag_men_chk_'])) { $_POST['aym_pag_men_chk_'] = [];}
	
				if(count($_POST['aym_pag_men_chk_']) > 0){
			
					# FOREACH QUE RECORRE EL ARRAY DEL MENU
					foreach($_POST['aym_pag_men_chk_'] as $pag_men_id) {
						
						# INCLUSIÓN--> PROCEDIMIENTO PARA INSERTAR EL MENU DE LA PÁGINA
						include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_add_page_menu.php';
						
						
					} # - > FIN DEL FOREACH
				} # - > FIN SI
				
				/*=================================================================================== */
				/*=================================================================================== */
				/*=================================================================================== */
				
			//}		
		} 

		$aym_url = $_SERVER['HTTP_REFERER']; 
		
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
		
	} # --> FIN SI ES ACTUALIZAR	

#=============================================================================================================
#======================================== ACTUALIZAR IMAGEN DE PAGINA ========================================
#=============================================================================================================

	if($_POST['action'] == 'UFB'){ # UFB --> ACTUALIZAR IMAGEN DE UNA PAGINA
		
		# FUNCION --> LIMPIA URLS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';
		
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		
		# FUNCION ---> OBTIENE LA IP DEL USUARIO
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# VARIABLE ---> CONTIENE LA IP
		$use_ip = aym_get_ip();
		
		if (!isset($_POST['pag_ima_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_ima_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_FILES['aym_fil']['name'][0])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['pag_ima_id']=aym_clean_string($_POST['pag_ima_id']);
		$_POST['pag_id']=aym_clean_string($_POST['pag_id']);
		
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (!filter_var($_POST['pag_ima_id'], FILTER_VALIDATE_INT)){ $Msg = "Banner NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
		if (!filter_var($_POST['pag_id'], FILTER_VALIDATE_INT)){ $Msg = "Pagina NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
		
		if(!empty($_FILES['aym_fil']['name'][0])){
			for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
				#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
				include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_validate_multiple_file.php';
			}
		}
		
		$pag_id = $_POST['pag_id'];
		$_GET['pag_ima_id'] = $_POST['pag_ima_id'];
		
		# INCLUSIÓN--> PROCEDIMIENTO PARA OBTENER LA IMAGEN
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page_image.php';
		
		# INCLUSIÓN--> PROCEDIMIENTO PARA ELIMINAR LA IMAGEN
		include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_sql/aym_cms/aym_sql_delete_page_image.php";
		
		if(!empty($_FILES['aym_fil']['name'][0])){
			$extension = pathinfo($_FILES["aym_fil"]['name'][0], PATHINFO_EXTENSION);
		}else{
			$extension = $row_get_page_image['pag_ima_ext'];
		}
		$i=0;
		# INCLUSIÓN--> PROCEDIMIENTO PARA INSETAR UNA IMAGEN
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_add_page_image.php';

		
		
		if(!empty($_FILES['aym_fil']['name'][0])){
			#DEFINICION---> Carpeta padre
			$aym_dir_parent = $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_cms/';
			#DEFINICION---> Carpeta que contendra archivos dentro de la carpeta padre
			$aym_dir = $aym_dir_parent.'/'.$pag_id;
		
			
			for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
				
				#VARIABLES---> NOMBRE Y EXTENSION DEL ARCHIVO A SUBIR
				
				$extension = pathinfo($_FILES["aym_fil"]['name'][$i], PATHINFO_EXTENSION);
				
				$nombre_archivo = $pag_ima_id.'.'.$extension;
				$old_archivo = $_POST['pag_ima_id'].'.'.$extension;
				
				unlink($aym_dir.'/'.$old_archivo);

				#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
				include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_cms/aym_move_image.php';
			}
		}else{
			
			$aym_dir_parent = $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_cms/';
			#DEFINICION---> Carpeta que contendra archivos dentro de la carpeta padre
			$aym_dir = $aym_dir_parent.'/'.$pag_id;
			
			$nombre_archivo = $pag_ima_id.'.'.$extension;
			$old_archivo = $_POST['pag_ima_id'].'.'.$extension;
			
			rename($aym_dir.'/'.$old_archivo, $aym_dir.'/'.$nombre_archivo);
		}
		
		
	}
	
#=============================================================================================================
#===================================== ACTUALIZAR PAGINA DESDE LA (TABLA) ====================================
#=============================================================================================================
	
	if($_POST['action'] == 'UT'){ #UT --> ACTUALIZAR PAGINA DESDE LA (TABLA)
		
		
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		
		# FUNCION ---> OBTIENE LA IP
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# FUNCION --> LIMPIA URL
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';	
		
		# VARIABLE ---> CONTIENE LA IP
		$use_ip = aym_get_ip();
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pag_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['pag_id'] = aym_clean_string($_POST['pag_id']);
		
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (!filter_var($_POST['pag_id'], FILTER_VALIDATE_INT)){$ReturnStatus=1; $Msg = "Pagina NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
		#VARIABLE
		$_GET['pag_id'] = $_POST['pag_id'];
	
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = "/aymcms/admcms/aym_list_cms/".$_POST['aym_page_size']."/".$_POST['aym_page'];
		
		# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN CONTENIDO
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page.php';
		
		if(empty($_POST['pag_tit'])){
			$_POST['pag_tit']= $row_get_page['pag_tit'];
		}else{
			# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
			$_POST['pag_tit'] = aym_clean_string($_POST['pag_tit']);
			
			# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
			if (mb_strlen($_POST['pag_tit'])< 3|| mb_strlen($_POST['pag_tit'])>100){$ReturnStatus=1; $Msg = "Titulo NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
		}
		if(empty($_POST['pag_des'])){
			$_POST['pag_des']= $row_get_page['pag_des'];
		}else{
			# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
			$_POST['pag_des'] = aym_clean_string($_POST['pag_des']);
			
			# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
			if (mb_strlen($_POST['pag_des'])< 3|| mb_strlen($_POST['pag_des'])>255){$ReturnStatus=1; $Msg = "Descripción NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
		}
		
		$_POST['pag_url']= $row_get_page['pag_url'];
		$_POST['pag_con']= $row_get_page['pag_con']; 
		$_POST['pag_tem']= $row_get_page['pag_tem']; 
		$_POST['pag_tar']= $row_get_page['pag_tar']; 
		$_POST['pag_ima_cap']= $row_get_page['pag_ima_cap']; 
		$_POST['pag_pos']= $row_get_page['pag_pos'];
		$_POST['pag_hol']= $row_get_page['pag_hol']; 
		$_POST['pag_pub']= $row_get_page['pag_pub']; 
		$_POST['pag_sho_map']= $row_get_page['pag_sho_map'];
		$_POST['pag_sub_id']= $row_get_page['pag_sub_id']; 
		$_POST['pag_cat_id']= $row_get_page['pag_cat_id']; 
		$_POST['gal_sub_cat_id']= $row_get_page['gal_sub_cat_id']; 
		$_POST['ban_cat_id']= $row_get_page['ban_cat_id'];
		$_POST['lan_id']= $row_get_page['lan_id']; 
		
		
		# INCLUSIÓN--> PROCEDIMIENTO PARA ACTUALIZAR LOS DATOS DE UN CONTENIDO
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_update_page.php'; 
		
		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	}# FIN SI ES EDITAR BANNER DESDE LA TABLA

#=============================================================================================================
#========================================= ELIMINAR IMAGEN DE PAGINA =========================================
#=============================================================================================================

	if ($_POST['action'] == 'DFB') { # DFB -->  ELIMINAR IMAGEN

		# EJECUCIÓN ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pag_ima_id'])){include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_security/aym_hacker_alert.php");}
		if (!isset($_POST['pag_id'])){include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_security/aym_hacker_alert.php");}
		
		# VALIDACION ---> INTEGRIDAD DE VARIABLES
		if (!filter_var($_POST['pag_ima_id'],FILTER_VALIDATE_INT)){$ReturnStatus=1;$Msg="Id Imagen NO válido";include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
		if (!filter_var($_POST['pag_id'],FILTER_VALIDATE_INT)){$ReturnStatus=1;$Msg="Id Página NO válido";include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
		
		# INCLUSIÓN--> PROCEDIMIENTO PARA ELIMINAR LA IMAGEN DE UN CONTENIDO
		include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_sql/aym_cms/aym_sql_delete_page_image.php"; 

		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';

	}# --> FIN SI ES ELIMINAR 	

#=============================================================================================================
#============================================ ACTUALIZAR POSICION ============================================
#=============================================================================================================
	
	if ($_POST['action'] == 'UP') { # UP -->  ORDENAR PAGINA
		

		# VARIABLES
		$array = json_decode(str_replace('\"', '"', $_POST['data']));
		$num_rows_affected = 0;

		foreach ($array as $value) {
			# VARIABLES
			$_POST['pag_id'] = $value->id;
			$_POST['pag_pos'] = $value->position;

			# INCLUSIÓN --> COMPONENTE QUE ORDENA LAS PAGINAS
			include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_update_page_position.php'; 

			if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE 
				$num_rows_affected++;
			} 
		}

		if($num_rows_affected === count($array)){
			$ReturnStatus = 0; # 0 --> PROCESADO SATISFACTORIAMENTE
			$Msg = 'El banner ha sido reordenado';
		} else {
			$ReturnStatus = 1; # 1 --> NO PROCESADO
			$Msg = 'El banner NO ha sido reordenado';
		}
	}


#=============================================================================================================
#============================================= ACTUALIZAR ESTADO =============================================
#=============================================================================================================
	
	if ($_POST['action'] == 'US') { # US -->  ACTUALIZAR ESTADO
		
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pag_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_pub'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VALIDACION ---> INTEGRIDAD DE VARIABLES
		if (!filter_var($_POST['pag_id'],FILTER_VALIDATE_INT)){$ReturnStatus=1;$Msg="Id Página NO válido";include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
		if ($_POST['pag_pub'] <> 1 && $_POST['pag_pub'] <> 0){$ReturnStatus=1;$Msg="Publicación NO válido";include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
		# INCLUSIÓN--> PROCEDIMIENTO PARA ACTUALIZAR EL ESTADO DE UN CONTENIDO
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_update_page_publish.php'; 

		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 
	}

#=============================================================================================================
#============================================= ACTUALIZAR BLOQUEO ============================================
#=============================================================================================================
	
	if ($_POST['action'] == 'UH') { # US -->  ACTUALIZAR BLOQUEO
		
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pag_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['pag_hol'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VALIDACION ---> INTEGRIDAD DE VARIABLES
		if (!filter_var($_POST['pag_id'],FILTER_VALIDATE_INT)){$ReturnStatus=1;$Msg="Id Página NO válido";include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
		if ($_POST['pag_hol'] <> 1 && $_POST['pag_hol'] <> 0){$ReturnStatus=1;$Msg="Bloqueo NO válido";include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
		# INCLUSIÓN--> PROCEDIMIENTO PARA EL BLOQUEO DE UN CONTENIDO
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_update_page_block.php'; 

		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 
	}

#=============================================================================================================
#============================================== ELIMINAR PAGINA ==============================================
#=============================================================================================================

	if ($_POST['action'] == 'D') { # D -->  ELIMINAR PAGINA
	
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['pag_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VALIDACION ---> INTEGRIDAD DE VARIABLES
		if (!filter_var($_POST['pag_id'],FILTER_VALIDATE_INT)){$ReturnStatus=1;$Msg="Id Página NO válido";include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
		# INCLUSIÓN--> PROCEDIMIENTO PARA ELIMINAR UN CONTENIDO
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_delete_page.php'; 

		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 
	
		
	} # --> FIN SI ES ELIMINAR 	

	
?>