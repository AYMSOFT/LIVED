<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA ADMINISTRAR LOS BANNERS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	# ZONA HORARIA
	date_default_timezone_set('America/Bogota');
	
	#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';
	
#===================================================================================================
#============================== CATEGORY BANNER ====================================================
#===================================================================================================

if ($_POST['action'] == 'IC') { # IC --> INSERTAR CATEGORY BANNER

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['ban_cat_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_cat_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_cat_wid'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_cat_hei'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['ban_cat_nam']=aym_clean_string($_POST['ban_cat_nam']);	
	$_POST['ban_cat_des']=aym_clean_string($_POST['ban_cat_des']);

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (mb_strlen($_POST['ban_cat_nam'])<3|| mb_strlen($_POST['ban_cat_nam'])>150){ $Msg = "Nombre NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['ban_cat_des'])<3|| mb_strlen($_POST['ban_cat_des'])>255){ $Msg = "Descripción NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['ban_cat_wid'])<1|| mb_strlen($_POST['ban_cat_wid'])>4){ $Msg = "Ancho NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['ban_cat_hei'])<1|| mb_strlen($_POST['ban_cat_hei'])>4){ $Msg = "Alto NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['lan_id'], FILTER_VALIDATE_INT)){ $Msg = "Idioma NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}	

	# INCLUSIÓN ----> PROCEDIMIENTO PARA INSERTAR LA CATEGORIA DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_add_banner_category.php';

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

} #FIN DE INSERTAR CATEGORIA DE BANNER

if($_POST['action'] == 'UCT'){ #UCT --> EDITAR CATEGORIA DE BANNERS DESDE LA (TABLA)
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';	
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# REDIRECCION --> EDITAR DE BANNERS
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['ban_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['ban_cat_id']=aym_clean_string($_POST['ban_cat_id']);
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['ban_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Banner NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	
	#VARIABLE
	$_GET['ban_cat_id'] = $_POST['ban_cat_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_get_banner_category.php';

		
	if(empty($_POST['ban_cat_nam'])){
		$_POST['ban_cat_nam']= $row_get_banner_category['ban_cat_nam'];
	}else{
		# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
		$_POST['ban_cat_nam'] = aym_clean_string($_POST['ban_cat_nam']);

		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['ban_cat_nam'])< 2|| mb_strlen($_POST['ban_cat_nam'])>155){$ReturnStatus=1; $Msg = "Nombre NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	if(empty($_POST['ban_cat_des'])){
		$_POST['ban_cat_des']= $row_get_banner_category['ban_cat_des'];
	}else{
		# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
		$_POST['ban_cat_des'] = aym_clean_string($_POST['ban_cat_des']);

		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['ban_cat_des'])< 3|| mb_strlen($_POST['ban_cat_des'])>255){$ReturnStatus=1; $Msg = "Descripción NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	if(empty($_POST['ban_cat_hei'])){
		$_POST['ban_cat_hei']= $row_get_banner_category['ban_cat_hei'];
	}else{
		# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
		$_POST['ban_cat_hei'] = aym_clean_string($_POST['ban_cat_hei']);

		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['ban_cat_hei'], FILTER_VALIDATE_INT)){ $Msg = "Alto NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	}

	
	if(empty($_POST['ban_cat_wid'])){
		$_POST['ban_cat_wid']= $row_get_banner_category['ban_cat_wid'];
	}else{
		# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
		$_POST['ban_cat_wid'] = aym_clean_string($_POST['ban_cat_wid']);

		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (!filter_var($_POST['ban_cat_wid'], FILTER_VALIDATE_INT)){ $Msg = "Ancho NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	}

	$_POST['lan_id'] = $row_get_banner_category['lan_id'];
	
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_update_banner_category.php'; 
	
	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
}# FIN SI ES EDITAR BANNER DESDE LA TABLA

if ($_POST['action'] =='DC') { # D -->  ELIMINAR CATEGORY BANNER

	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['ban_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VALIDACION ---> INTEGRIDAD DE VARIABLES
	if (!filter_var($_POST['ban_cat_id'],FILTER_VALIDATE_INT)){ $Msg = "Categoria banner NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
	# COMPONENTE --> PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_del_banner_category.php'; 
	
	# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 
} # --> FIN SI ES ELIMINAR	



#===============================================================================================
#==================================== BANNER ===================================================
#===============================================================================================

if ($_POST['action'] == 'I') { # I -->  INSERTAR BANNERS


	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['ban_dat_tim_ini'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_dat_tim_fin'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_cap'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_url'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_tar'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_pos'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['lan_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_FILES['doc_nom']['name'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_sta'])){$_POST['ban_sta']==0;}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['ban_des']=aym_clean_string($_POST['ban_des']);
	$_POST['ban_cat_id']=aym_clean_string($_POST['ban_cat_id']);
	$_POST['ban_pos']=aym_clean_string($_POST['ban_pos']);
	$_POST['lan_id']=aym_clean_string($_POST['lan_id']);
	if(!empty($_POST['ban_cap'])) {$_POST['ban_cap']=aym_clean_string($_POST['ban_cap']);}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (strlen($_POST['ban_dat_tim_ini'])< 7){ $Msg = "Fecha Inicial NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['ban_dat_tim_fin'])< 7){ $Msg = "Fecha Final NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['ban_des'])< 3||strlen($_POST['ban_des'])> 255){ $Msg = "Descripción NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['ban_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Categoría NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['ban_pos'], FILTER_VALIDATE_INT)){ $Msg = "Posición NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['lan_id'], FILTER_VALIDATE_INT)){ $Msg = "Lenguaje NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	# INCLUSIÓN ----> PROCEDIMIENTO QUE INSERTA UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_add_banner.php'; 



	if ($_FILES["doc_nom"]['name'] <> "") {	

		# INCLUSION ---> COMPONENTE PARA VALIDAR IMAGEN
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_upload_image.php'; 
	}


	# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
	if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE 

			# VARIABLE	
			$aym_nombre_archivo = $_POST['ban_id'];

			#INCLUSION --> COMPONENTE QUE PROCESA LA IMAGEN
			include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_banner/aym_upload_banner.php';

			if ($ReturnStatus > 0) { # ERROR EN LA CREACION DE LA IMAGEN

				# VARIABLE
				$_GET['ban_id'] = $_POST['ban_id'];

				# INCLUSION --> PROCEDIMIENTO QUE ELIMINA EL BANNER
				include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_del_banner.php'; 

			} 
	} 

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

}# FIN DE INSERTAR BANNER

if ($_POST['action'] == 'U') { # U -->  EDITAR BANNERS
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# REDIRECCION --> EDITAR DE BANNERS
	$aym_url = $_SERVER['HTTP_REFERER'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['ban_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_dat_tim_ini'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_dat_tim_fin'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_cap'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_url'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_tar'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_pos'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['lan_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_FILES['doc_nom']['name'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['ban_des']=aym_clean_string($_POST['ban_des']);
	$_POST['ban_cat_id']=aym_clean_string($_POST['ban_cat_id']);
	$_POST['ban_pos']=aym_clean_string($_POST['ban_pos']);
	$_POST['lan_id']=aym_clean_string($_POST['lan_id']);
	if(!empty($_POST['ban_cap'])) {$_POST['ban_cap']=aym_clean_string($_POST['ban_cap']);}
	
	if (!isset($_POST['ban_sta'])){$_POST['ban_sta']==0;}
	
	# VARIABLE --> LIMPIEZA DE URL

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['ban_id'], FILTER_VALIDATE_INT)){ $Msg = "Banner NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['ban_dat_tim_ini'])< 7){ $Msg = "Fecha Inicial NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['ban_dat_tim_fin'])< 7){ $Msg = "Fecha Final NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (strlen($_POST['ban_des'])< 3||strlen($_POST['ban_des'])> 255){ $Msg = "Descripción NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['ban_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Categoría NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['ban_pos'], FILTER_VALIDATE_INT)){ $Msg = "Posición NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_var($_POST['lan_id'], FILTER_VALIDATE_INT)){ $Msg = "Lenguaje NO valida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
		
	# VALIDACION --> QUE VENGA UNA IMAGEN EN LA CAJA 
	if ($_FILES["doc_nom"]['name'] <> "") {	
	
		# INCLUSION ---> COMPONENTE PARA VALIDAR IMAGEN
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_upload_image.php'; 

		# VARIABLE	
		$aym_nombre_archivo = $_POST['ban_id'];
		
        #INCLUSION --> COMPONENTE QUE PROCESA LA IMAGEN
        include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_banner/aym_upload_banner.php';
	
	}	
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_update_banner.php'; 
	
	# REDIRECCION --> EDITAR DE BANNERS
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
} # --> FIN SI ES EDITAR	

if ($_POST['action'] == 'UP') { # UP -->  ORDENAR PAGINA
		

	# VARIABLES
	$array = json_decode(str_replace('\"', '"', $_POST['data']));
	$num_rows_affected = 0;

	foreach ($array as $value) {
		# VARIABLES
		$_POST['ban_id'] = $value->id;
		$_POST['ban_pos'] = $value->position;

		# INCLUSIÓN --> COMPONENTE QUE ORDENA LOS BANNERS
		include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_update_banner_position.php';

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
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
}
	
if($_POST['action'] == 'UT'){ #UT --> EDITAR BANNER DESDE LA (TABLA)
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';	
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# REDIRECCION --> EDITAR DE BANNERS
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['ban_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['ban_id']=aym_clean_string($_POST['ban_id']);
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['ban_id'], FILTER_VALIDATE_INT)){ $Msg = "Banner NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	#VARIABLE
	$_GET['ban_id'] = $_POST['ban_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_get_banner.php';

	if(!isset($_POST['ban_url'])){
		$_POST['ban_url']= $row_get_banner['ban_url'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['ban_url']=aym_clean_string($_POST['ban_url']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['ban_url'])<4){$ReturnStatus=2; $Msg = "URL NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	if(!isset($_POST['ban_dat_tim_ini'])){
		$_POST['ban_dat_tim_ini'] = $row_get_banner['ban_dat_tim_ini'];
	}else{
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['ban_dat_tim_ini'])<7){$ReturnStatus=2; $Msg = "Fecha Inicial NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	if(!isset($_POST['ban_dat_tim_fin'])){
		$_POST['ban_dat_tim_fin'] = $row_get_banner['ban_dat_tim_fin'];
	}else{
		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['ban_dat_tim_fin'])<7){$ReturnStatus=2; $Msg = "Fecha Inicial NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	if(!isset($_POST['ban_des'])){
		$_POST['ban_des'] = $row_get_banner['ban_des'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['ban_des']=aym_clean_string($_POST['ban_des']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['ban_des'])<4 ||strlen($_POST['ban_des'])>255){$ReturnStatus=2; $Msg = "Descripción NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}

	$_POST['ban_cap']= $row_get_banner['ban_cap']; 
	$_POST['ban_tar']= $row_get_banner['ban_tar']; 
	$_POST['ban_pos']= $row_get_banner['ban_pos']; 
	$_POST['ban_sta']= $row_get_banner['ban_sta']; 
	$_POST['ban_cat_id']= $row_get_banner['ban_cat_id'];
	$_POST['lan_id']= $row_get_banner['lan_id']; 
	
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_update_banner.php'; 
	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
}# FIN SI ES EDITAR BANNER DESDE LA TABLA

if($_POST['action'] == 'US'){ #US --> ACTUALIZAR ESTADO DEL BANNER
		
	# FUNCION --> LIMPIA CADENASV
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER']; 

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['ban_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['ban_sta'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	#VALIDACION ---> LIMPIEZA DE VARIABLES
	$_POST['ban_id']=aym_clean_string($_POST['ban_id']);	
	$_POST['ban_sta']=aym_clean_string($_POST['ban_sta']);	

	#VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['ban_id'],FILTER_VALIDATE_INT)){ $Msg = "Banner NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	if ($_POST['ban_sta']!= '0' && $_POST['ban_sta']!= '1'){ $Msg = "Estado NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}

		
	#VARIABLE
	$_GET['ban_id'] = $_POST['ban_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_get_banner.php';

	$_POST['ban_des']= $row_get_banner['ban_des']; 
	$_POST['ban_dat_tim_ini']= $row_get_banner['ban_dat_ini']; 
	$_POST['ban_dat_tim_fin']= $row_get_banner['ban_dat_fin']; 
	$_POST['ban_cap']= $row_get_banner['ban_cap']; 
	$_POST['ban_url']= $row_get_banner['ban_url']; 
	$_POST['ban_tar']= $row_get_banner['ban_tar']; 
	$_POST['ban_pos']= $row_get_banner['ban_pos']; 
	$_POST['ban_cat_id']= $row_get_banner['ban_cat_id'];
	$_POST['lan_id']= $row_get_banner['lan_id']; 
	
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_update_banner.php'; 	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 

}# --> FIN ACTUALIZAR ESTADO DE LA CABINA
	
if ($_POST['action'] =='D') { # D -->  ELIMINAR BANNERS

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['ban_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	
	# VALIDACION ---> INTEGRIDAD DE VARIABLES
	if (!filter_var($_POST['ban_id'],FILTER_VALIDATE_INT)){ $Msg = "banner NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	
	
	# COMPONENTE --> PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_del_banner.php'; 
	
	# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
	if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE 
        #INCLUSION --> COMPONENTE QUE PROCESA LA IMAGEN
        include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_banner/aym_upload_banner.php';
	}
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 
		
} # --> FIN SI ES ELIMINAR	

?>