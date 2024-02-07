<?php # **************************** AYMSITE V: 5.7 ********************
# COMPONENTE PARA ADMINISTRAR LAS NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	date_default_timezone_set('America/Bogota');
	
	#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	

#=============================================================================================================
#===========================================  INSERTAR NOTICIAS ==============================================
#=============================================================================================================

if ($_POST['action'] == 'I') { # I -->  INSERTAR NOTICIAS
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL NOTICIAS
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];
	
		
	# VARIABLE ---> CONTIENE LA IP
	$use_ip=aym_get_ip();	
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['lan_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['new_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['new_tit'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['new_lea'])){include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_security/aym_hacker_alert.php");}
	if (!isset($_POST['new_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_FILES['doc_nom']['name'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['new_tit']=aym_clean_string($_POST['new_tit']);	
	$_POST['new_lea']=aym_clean_string($_POST['new_lea']); 
	$_POST['new_des']=aym_clean_string($_POST['new_des']); 
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['lan_id'], FILTER_VALIDATE_INT)){ $Msg = "Idioma NO v&aacute;lida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['new_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Categoria NO v&aacute;lida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['new_tit'])< 3|| mb_strlen($_POST['new_tit'])>150){ $Msg = "Titulo NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_redirect.php";}
	if (mb_strlen($_POST['new_des'])< 3|| mb_strlen($_POST['new_des'])>4294967295){ $Msg = "Descripción NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_redirect.php";}
	if (mb_strlen($_POST['new_lea'])< 3|| mb_strlen($_POST['new_lea'])>300){ $Msg = "Subtitulo NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_redirect.php";}
	
	# VALIDACION --> QUE VENGA UNA IMAGEN EN LA CAJA 
	if ($_FILES["doc_nom"]['name'] <> "") {	
		# INCLUSION ---> COMPONENTE PARA VALIDAR IMAGEN
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_validate_image.php'; 
	}
	
	# INCLUSIÓN---> PROCEDIMIENTO QUE INSERTA UNA NOTICIA 
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_add_news.php'; 
	
	# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
	if ($ReturnStatus < 1){ # 0 --> PROCESADO SATISFACTORIAMENTE 
		# VALIDACION --> QUE VENGA UNA IMAGEN EN LA CAJA 
		if ($_FILES["doc_nom"]['name'] <> "") {	
			# VARIABLE	
			$aym_nombre_archivo = $new_id;
			
			#INCLUSION --> COMPONENTE QUE PROCESA LA IMAGEN
			include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_news/aym_upload_image.php';	
		}
	}
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
}  # FIN INSERTAR NOTICIAS	

#=============================================================================================================
#======================================  INSERTAR CATEGORIA NOTICIAS =========================================
#=============================================================================================================
	
	if ($_POST['action'] == 'IC') { # IC -->  INSERTAR CATEGORIA DE NOTICIAS
			
		# FUNCION --> LIMPIA CADENAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
		
		# FUNCION ---> OBTIENE LA IP DEL BANNERS
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
		
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = $_SERVER['HTTP_REFERER'];
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['new_cat_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['new_cat_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['new_cat_ord'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['new_cat_nam']=aym_clean_string($_POST['new_cat_nam']);	
		$_POST['new_cat_des']=aym_clean_string($_POST['new_cat_des']);
		$_POST['new_cat_ord']=aym_clean_string($_POST['new_cat_ord']);	
		

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (!filter_var($_POST['lan_id'], FILTER_VALIDATE_INT)){ $Msg = "Idioma NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (!filter_var($_POST['new_cat_ord'], FILTER_VALIDATE_INT)){ $Msg = "Orden NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
		if (mb_strlen($_POST['new_cat_nam'])< 3|| mb_strlen($_POST['new_cat_nam'])>50){ $Msg = "Nombre NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_redirect.php";}
		if (mb_strlen($_POST['new_cat_des'])< 3|| mb_strlen($_POST['new_cat_des'])>100){ $Msg = "Descripción NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_redirect.php";}
	
		# INCLUSIÓN--> PROCEDIMIENTO PARA INSERTAR CATEGORIA DE NOTICIAS
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_add_news_category.php';
		
			
		# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	} 


	
#=============================================================================================================
#============================================  ACTUALIZAR NOTICIAS ============================================
#=============================================================================================================

if ($_POST['action'] ==  'U') { # U -->  ACTUALIZAR NOTICIAS

	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP DEL NOTICIAS
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url =$_SERVER['HTTP_REFERER']; 
	$use_ip=aym_get_ip();	
		
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['new_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['lan_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['new_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['new_tit'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['new_lea'])){include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_security/aym_hacker_alert.php");}
	if (!isset($_POST['new_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['new_url'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_FILES['doc_nom']['name'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['new_tit']=aym_clean_string($_POST['new_tit']);	
	$_POST['new_lea']=aym_clean_string($_POST['new_lea']); 
	$_POST['new_url']=aym_clean_string_url($_POST['new_url']);
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['lan_id'], FILTER_VALIDATE_INT)){ $Msg = "Idioma NO v&aacute;lida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['new_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Categoria NO v&aacute;lida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['new_tit'])< 3|| mb_strlen($_POST['new_tit'])>150){ $Msg = "Titulo NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_redirect.php";}
	if (mb_strlen($_POST['new_des'])< 3|| mb_strlen($_POST['new_des'])>4294967295){ $Msg = "Descripción NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_redirect.php";}
	if (mb_strlen($_POST['new_lea'])< 3|| mb_strlen($_POST['new_lea'])>300){ $Msg = "Subtitulo NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_redirect.php";}
	
	
	# VALIDACION --> QUE VENGA UNA IMAGEN EN LA CAJA 
	if ($_FILES["doc_nom"]['name'] <> "") {	
	
		# INCLUSION ---> COMPONENTE PARA VALIDAR IMAGEN
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_validate_image.php'; 

		# VARIABLE	
		$aym_nombre_archivo = $_POST['new_id'];
		
        #INCLUSION --> COMPONENTE QUE PROCESA LA IMAGEN
        include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_news/aym_upload_image.php';
	
	}	

	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_update_news.php'; 
	
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
} # --> FIN SI ES EDITAR	

#=============================================================================================================
#=================================  EDITAR  NOTICIAS DESDE LA  (TABLA) =======================================
#=============================================================================================================

if($_POST['action'] == 'UCT'){ #UT --> EDITAR CATEGORIA NOTICIA DESDE LA TABLA
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['new_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['new_cat_id']=aym_clean_string($_POST['new_cat_id']);
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['new_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Categoría NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	#VARIABLE
	$_GET['new_cat_id'] = $_POST['new_cat_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_get_news_category.php';
	
	if(empty($_POST['new_cat_nam'])){
		$_POST['new_cat_nam']= $row_get_news_category['new_cat_nam'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['new_cat_nam']=aym_clean_string($_POST['new_cat_nam']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['new_cat_nam'])<4 && mb_strlen($_POST['new_cat_nam'])>50){ $ReturnStatus=2; $Msg = "Nombre NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	if(empty($_POST['new_cat_des'])){
		$_POST['new_cat_des']= $row_get_news_category['new_cat_des'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['new_cat_des']=aym_clean_string($_POST['new_cat_des']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['new_cat_des'])<4 && mb_strlen($_POST['new_cat_des'])>100){ $ReturnStatus=2; $Msg = "Nombre NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	$_POST['new_cat_ord'] = $row_get_news_category['new_cat_ord'];
	$_POST['lan_id'] = $row_get_news_category['lan_id'];
	$_POST['use_id'] = $row_get_news_category['use_id'];
	$_POST['use_ip'] = $row_get_news_category['use_ip'];
	
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_update_news_category.php';		
	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
}# FIN SI ES EDITAR CATEGORIA DE NOTICIA DESDE LA TABLA



#=============================================================================================================
#=================================  EDITAR  NOTICIAS DESDE LA  (TABLA) =======================================
#=============================================================================================================

if($_POST['action'] == 'UT'){ #UT --> EDITAR  NOTICIAS DESDE LA  (TABLA)

	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	
	if (!isset($_POST['new_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	 
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['new_id'], FILTER_VALIDATE_INT)){ $Msg = "Noticia NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
	#VARIABLE
	$_GET['new_id'] = $_POST['new_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_get_news.php';

	if(empty($_POST['new_tit'])){
		$_POST['new_tit']= $row_get_news['new_tit'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['new_tit']=aym_clean_string($_POST['new_tit']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['new_tit'])<4 && mb_strlen($_POST['new_tit'])>150){$ReturnStatus=2; $Msg = "SubTitulo NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	if(empty($_POST['new_lea'])){
		$_POST['new_lea']= $row_get_news['new_lea'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['new_lea']=aym_clean_string($_POST['new_lea']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['new_lea'])<4 && mb_strlen($_POST['new_lea'])>300){$ReturnStatus=2; $Msg = "SubTitulo NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	$_POST['new_url']= $row_get_news['new_url'];
	$_POST['new_des']= $row_get_news['new_des'];
	$_POST['new_sta']= $row_get_news['new_sta'];
	$_POST['new_cov']= $row_get_news['new_cov'];
	$_POST['lan_id']= $row_get_news['lan_id']; 
	$_POST['new_cat_id']= $row_get_news['new_cat_id']; 
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	

	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_update_news.php'; 
	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
	
}# FIN SI ES EDITAR BANNER DESDE LA TABLA



#==================================================================================================
#================================== ACTUALIZAR ESTADO DE NOTICIA ==================================
#==================================================================================================

	if($_POST['action'] == 'US'){ #US --> ACTUALIZAR ESTADO DE NOTICIA
	
		# FUNCION --> LIMPIA CADENASV
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

		# FUNCION ---> OBTIENE LA IP
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

		# VARIABLE ---> CONTIENE LA IP
		$use_ip = aym_get_ip();
		
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = $_SERVER['HTTP_REFERER']; 

		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['new_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['new_sta'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

		#VALIDACION ---> LIMPIEZA DE VARIABLES
		$_POST['new_id']=aym_clean_string($_POST['new_id']);	
		$_POST['new_sta']=aym_clean_string($_POST['new_sta']);	

			
		#VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (!filter_var($_POST['new_id'],FILTER_VALIDATE_INT)){ $Msg = "Noticia NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
		if ($_POST['new_sta']<> '0' && $_POST['new_sta']<> '1'){ $Msg = "Estado NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}

		# INCLUSION -> PROCEDIMIENTO PARA ACTUALIZAR ESTADO DE LA CABINA
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_update_news_status.php'; 
		
		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 

	}# --> FIN ACTUALIZAR ESTADO DE LA NOTICIA


#==================================================================================================
#================================= ACTUALIZAR DE COVER DE NOTICIA =================================
#==================================================================================================

	if($_POST['action'] == 'UC'){ #UC --> ACTUALIZAR DE COVER DE NOTICIA
	
		
		# FUNCION --> LIMPIA CADENASV
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

		# FUNCION ---> OBTIENE LA IP
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

		# VARIABLE ---> CONTIENE LA IP
		$use_ip = aym_get_ip();
		
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url = $_SERVER['HTTP_REFERER']; 

		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['new_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['new_cov'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		if (!isset($_POST['new_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

		#VALIDACION ---> LIMPIEZA DE VARIABLES
		$_POST['new_id']=aym_clean_string($_POST['new_id']);	
		$_POST['new_cov']=aym_clean_string($_POST['new_cov']);	
		$_POST['new_cat_id']=aym_clean_string($_POST['new_cat_id']);	

		#VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (!filter_var($_POST['new_id'],FILTER_VALIDATE_INT)){ $Msg = "Noticia NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
		if ($_POST['new_cov']<> '0' && $_POST['new_cov']<> '1'){ $Msg = "Estado NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
		if (!filter_var($_POST['new_cat_id'],FILTER_VALIDATE_INT)){ $Msg = "Categoria NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}

		# INCLUSION -> PROCEDIMIENTO PARA ACTUALIZAR ESTADO DE LA CABINA
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_update_news_cover.php'; 
		
		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 

	}# --> FIN ACTUALIZAR ESTADO DE LA CABINA
	
#=============================================================================================================
#===================================== ELIMINAR CATEGORIA NOTICIAS ==========================================
#=============================================================================================================
	
	
	if ($_POST['action'] == 'DC') { # DC -->  ELIMINAR CATEGORIA DE NOTICIAS
	
		# VARIABLE --> DETERMINAR LA REDIRECION 
		$aym_url =$_SERVER['HTTP_REFERER']; 
		
		# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
		if (!isset($_POST['new_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
		
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (!filter_input(INPUT_POST, 'new_cat_id', FILTER_VALIDATE_INT)){ $Msg = "Categoría de Noticia NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

		# PROCEDIMIENTO ---> ACTUALIZAR EL ESTADO
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_del_news_category.php';
		
		
		# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
		
	}#-----> FIN ELIMINAR CATEGORIA DE NOTICIAS

/*============================== ELIMINAR NOTICIAS ==============================*/

if ($_POST['action'] ==  'D') { # D -->  ELIMINAR NOTICIAS

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['new_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# COMPONENTE --> PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_del_news.php'; 

	# VALIDACION ---> INTEGRIDAD DE VARIABLES
	if (!filter_var($_POST['new_id'],FILTER_VALIDATE_INT)){ $Msg = "Noticias NO válida"; include_once 	$_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
	# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
	if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE 
	
		# VALIDACION --> SI HAY UNA IMAGEN PARA BORRAR
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_news/'.$_POST['new_id'].".png")) {
			#INCLUSION --> COMPONENTE QUE PROCESA LA IMAGEN
			include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_news/aym_upload_image.php';
		}	
	}
	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 
		
} # --> FIN SI ES ELIMINAR
	
?>