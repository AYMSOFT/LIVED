<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA ADMINISTRAR LA GALERIA DE FOTOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start(); 
		
	# VALIDACION --> QUE ENTRE POR LA APLICACION
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_security/aym_validate_security.php';


/*==================================================================================================
====================================================================================================
======================================= CATEGORIA DE GALERIA =======================================
====================================================================================================
==================================================================================================*/

if ($_POST['action'] == 'I') { # I -->  INSERTAR CATEGORY / GALERIA

	#ECHO'<pre>';print_r($_POST);ECHO'</pre>';EXIT;

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_cat_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['gal_cat_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['gal_cat_nam']=aym_clean_string($_POST['gal_cat_nam']);	
	$_POST['gal_cat_des']=aym_clean_string($_POST['gal_cat_des']);	

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (mb_strlen($_POST['gal_cat_nam'])<2|| mb_strlen($_POST['gal_cat_nam'])>150){ $Msg = "Nombre NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['gal_cat_des'])<3|| mb_strlen($_POST['gal_cat_des'])>255){ $Msg = "Descripción NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_input(INPUT_POST, 'lan_id', FILTER_VALIDATE_INT)){ $aym_msg = "Idioma NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE INSERTAR LAS CATEGORIA DE LA GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_add_gallery_category.php';
	
	# INCLUSIÓN---> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';

} 

if($_POST['action'] == 'UT'){ #UT --> EDITAR GALERIA DESDE LA (TABLA)

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_string/aym_fun_clean_url.php';	
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# REDIRECCION --> EDITAR DE GALERÍAS
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['gal_cat_id']=aym_clean_string($_POST['gal_cat_id']);
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['gal_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Categoria NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	#VARIABLE
	$_GET['gal_cat_id'] = $_POST['gal_cat_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE LA CATEGORIA DE LA GARIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_get_gallery_category.php';

	
	if(!isset($_POST['gal_cat_nam'])){
		$_POST['gal_cat_nam'] = $row_get_gallery_category['gal_cat_nam'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['gal_cat_nam']=aym_clean_string($_POST['gal_cat_nam']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['gal_cat_nam'])<2 ||strlen($_POST['gal_cat_nam'])>150){$ReturnStatus=2; $Msg = "Nombre NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	if(!isset($_POST['gal_cat_des'])){
		$_POST['gal_cat_des'] = $row_get_gallery_category['gal_cat_des'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['gal_cat_des']=aym_clean_string($_POST['gal_cat_des']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['gal_cat_des'])<3 ||strlen($_POST['gal_cat_des'])>255){$ReturnStatus=2; $Msg = "Descripción NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	$_POST['gal_cat_id']= $row_get_gallery_category['gal_cat_id'];
	$_POST['lan_id']= $row_get_gallery_category['lan_id']; 

	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_update_gallery_category.php'; 
	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
}# FIN SI ES EDITAR GALERÍA DESDE LA TABLA

if ($_POST['action']=='DC') { # D -->  ELIMINAR CATEGORIA / GALERIA
		
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_cat_id'])) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	
	# VALIDACION ---> INTEGRIDAD DE VARIABLES
	if (!filter_var($_POST['gal_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Categoria NO valido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php";}

	
	# INCLUSIÓN --> PROCEDIMIENTO PARA ELIMINAR UNA CATEGORIA DE GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_del_gallery_category.php';

	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);

}#FIN DE ELIMINAR CATEGORIA


/*=================================================================================================
===================================================================================================
======================================== SUBCATEGORIA DE GALERIA ==================================
===================================================================================================
=================================================================================================*/

if ($_POST['action'] == 'IS') { # IS -->  INSERTAR SUBCATEGORIA 
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# FUNCION ---> OBTIENE LA IP
	$use_ip = aym_get_ip();

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_sub_cat_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['gal_sub_cat_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['gal_sub_cat_nam']=aym_clean_string($_POST['gal_sub_cat_nam']);	
	$_POST['gal_sub_cat_des']=aym_clean_string($_POST['gal_sub_cat_des']);	

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_input(INPUT_POST, 'gal_cat_id', FILTER_VALIDATE_INT)){ $aym_msg = "Galería NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['gal_sub_cat_nam'])<2|| mb_strlen($_POST['gal_sub_cat_nam'])>150){ $Msg = "Nombre NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['gal_sub_cat_des'])<3|| mb_strlen($_POST['gal_sub_cat_des'])>255){ $Msg = "Descripción NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	if (!filter_input(INPUT_POST, 'lan_id', FILTER_VALIDATE_INT)){ $aym_msg = "Idioma NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	
	# INCLUSIÓN---> PROCEDIMIENTO QUE INSERTAR LOS DATOS DEL AUMBUL DE GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_add_gallery_subcategory.php';
	
	# INCLUSIÓN---> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';


}# FIN INSERTAR SUBCATEGORIA DE ALBUM
	
if($_POST['action'] == 'UTS'){ #UT --> EDITAR SUBCATEGORIA DE ALBUM DESDE LA (TABLA)

	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_string/aym_fun_clean_url.php';	
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# REDIRECCION --> EDITAR DE GALERÍAS
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_sub_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['gal_sub_cat_id']=aym_clean_string($_POST['gal_sub_cat_id']);
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['gal_sub_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Subcategoria NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	#VARIABLE
	$_GET['gal_sub_cat_id'] = $_POST['gal_sub_cat_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE LA CATEGORIA DE LA GARIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_get_gallery_subcategory.php';

	
	if(!isset($_POST['gal_cat_nam'])){
		$_POST['gal_cat_nam'] = $row_get_gallery_subcategory['gal_cat_nam'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['gal_cat_nam']=aym_clean_string($_POST['gal_cat_nam']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['gal_cat_nam'])<4 ||strlen($_POST['gal_cat_nam'])>150){$ReturnStatus=2; $Msg = "Nombre NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	
	if(!isset($_POST['gal_cat_des'])){
		$_POST['gal_cat_des'] = $row_get_gallery_subcategory['gal_cat_des'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['gal_cat_des']=aym_clean_string($_POST['gal_cat_des']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['gal_cat_des'])<4 ||strlen($_POST['gal_cat_des'])>255){$ReturnStatus=2; $Msg = "Descripción NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
	$_POST['gal_cat_id']= $row_get_gallery_subcategory['gal_cat_id'];
	$_POST['lan_id']= $row_get_gallery_subcategory['lan_id']; 
	$_POST['use_ip']= $row_get_gallery_subcategory['use_ip']; 
	$_POST['use_id']= $row_get_gallery_subcategory['use_id']; 
	
	//ECHO "AQQUIO"; EXIT;
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_update_gallery_subcategory.php'; 
	
	# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
}# FIN SI ES EDITAR GALERÍA DESDE LA TABLA

if ($_POST['action']=='DS') { # D -->  ELIMINAR CATEGORIA / GALERIA
		
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_sub_cat_id'])) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	

	# VALIDACION ---> INTEGRIDAD DE VARIABLES
	if (!filter_var($_POST['gal_sub_cat_id'], FILTER_VALIDATE_INT)){ $Msg = "Subcategoria NO valido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php";}

	
	# INCLUSIÓN --> PROCEDIMIENTO PARA ELIMINAR UNA CATEGORIA DE GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_del_gallery_subcategory.php';

	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
}#FIN

/*==================================================================================================
===================================================================================================
========================================== IMAGEN / GALERIA ========================================
===================================================================================================
==================================================================================================*/

if ($_POST['action'] == 'II') { # II -->  INSERTAR IMAGEN
		
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# FUNCION ---> OBTIENE LA IP
	$use_ip = aym_get_ip();
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['lan_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['gal_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['gal_sub_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_input(INPUT_POST, 'lan_id', FILTER_VALIDATE_INT)){ $aym_msg = "Idioma NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_input(INPUT_POST, 'gal_cat_id', FILTER_VALIDATE_INT)){ $aym_msg = "Galería NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_input(INPUT_POST, 'gal_sub_cat_id', FILTER_VALIDATE_INT)){ $aym_msg = "Album NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}		
	
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
		$aym_dir_parent = $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_gallery/';
		#DEFINICION---> Carpeta que contendra archivos dentro de la carpeta padre
		$aym_dir = $aym_dir_parent;

		$gal_nam = $_POST['gal_nam'];
		for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
			
			$extension = pathinfo($_FILES["aym_fil"]['name'][$i], PATHINFO_EXTENSION);
			
			$_POST['gal_nam'] = $gal_nam.' '.$i;
			
			# COMPONENTE QUE POCESA LOS DATOS 
			include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_add_gallery_image.php';

			#VARIABLES---> NOMBRE Y EXTENSION DEL ARCHIVO A SUBIR
			$nombre_archivo = $gal_id.'.'.$extension;
			
			#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
			include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_gallery/aym_move_image.php';
		}
	}
		
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
}#FIN SI ES AGREGAR
	
if ($_POST['action'] == 'UI') { # II -->  EDITAR IMAGEN
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# REDIRECCION --> EDITAR DE GALERÍAS
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['lan_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['gal_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['gal_sub_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['gal_fea'])){$_POST['gal_fea']==0;}	
	
	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_input(INPUT_POST, 'gal_id', FILTER_VALIDATE_INT)){ $aym_msg = "Foto NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_input(INPUT_POST, 'lan_id', FILTER_VALIDATE_INT)){ $aym_msg = "Idioma NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_input(INPUT_POST, 'gal_cat_id', FILTER_VALIDATE_INT)){ $aym_msg = "Galería NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (!filter_input(INPUT_POST, 'gal_sub_cat_id', FILTER_VALIDATE_INT)){ $aym_msg = "Album NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	
	$gal_des = $_POST['gal_des'];
	
	# INCLUSIÓN----> PROCEDIMIENTO PARA ACTUALIZAR UNA FOTO EN LA GALERIA
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_update_gallery_image.php';
	
	# VARIABLE	
	$aym_nombre_archivo = $_POST['gal_id'];
	if(!empty($_FILES['aym_fil']['name'][0])){
		for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
			#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
			include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_validate_multiple_file.php';
		}
	}
	
	/*=================================================================================== */
	/*====================================== AGREGAR IMAGEN ============================= */
	/*=================================================================================== */
	
	# COMENTARIO -> INICIALIZAR VARIABLE
	$gal_id = $_POST['gal_id'];
	
	if(!empty($_FILES['aym_fil']['name'][0])){
		#DEFINICION---> Carpeta padre
		$aym_dir_parent = $_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_gallery/';
		#DEFINICION---> Carpeta que contendra archivos dentro de la carpeta padre
		$aym_dir = $aym_dir_parent;
				
		for($i=0;$i<count($_FILES['aym_fil']['name']);$i++){
			
			$extension = pathinfo($_FILES["aym_fil"]['name'][$i], PATHINFO_EXTENSION);

			#VARIABLES---> NOMBRE Y EXTENSION DEL ARCHIVO A SUBIR
			$nombre_archivo = $gal_id.'.'.$extension;
			
			#INCLUSION---> COMPONENTE QUE VALIDA LAS IMAGENES
			include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_gallery/aym_move_image.php';
		}
	}	
	
	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
	
}
	
if($_POST['action'] == 'UTI'){ #UTI --> ACTUALIZAR FOTOS DESDE LA TABLA / GALERIA
	
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';
	
	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';
	
	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_string/aym_fun_clean_url.php';	
	
	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();
	
	# REDIRECCIÓN
	$aym_url = $_SERVER['HTTP_REFERER'];
	
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['gal_id']=aym_clean_string($_POST['gal_id']);

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['gal_id'], FILTER_VALIDATE_INT)){ $Msg = "Subcategoria NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	#VARIABLE
	$_GET['gal_id'] = $_POST['gal_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE LA CATEGORIA DE LA GARIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_get_gallery_image.php';


	if(empty($_POST['gal_nam'])){
		$_POST['gal_nam'] = $row_get_gallery_image['gal_nam'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['gal_nam']=aym_clean_string($_POST['gal_nam']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['gal_nam'])<2 ||strlen($_POST['gal_nam'])>150){$ReturnStatus=2; $Msg = "Nombre NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}

	if(empty($_POST['gal_des'])){
		$_POST['gal_des'] = $row_get_gallery_image['gal_des'];
	}else{
		# VARIABLE --> LIMPIEZA DE VARIABLES
		$_POST['gal_des']=aym_clean_string($_POST['gal_des']);

		# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
		if (strlen($_POST['gal_des'])<3 ||strlen($_POST['gal_des'])>255){$ReturnStatus=2; $Msg = "Descripción NO valido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	}
		$_POST['gal_fea']= $row_get_gallery_image['gal_fea'];
		$_POST['gal_sub_cat_id']= $row_get_gallery_image['gal_sub_cat_id'];
		$_POST['lan_id']= $row_get_gallery_image['lan_id']; 
		$_POST['use_ip']= $row_get_gallery_image['use_ip']; 
		$_POST['use_id']= $row_get_gallery_image['use_id']; 
		$_POST['pag_id']= $row_get_gallery_image['pag_id']; 

	
	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_update_gallery_image.php'; 

	# ENVIAR ESTADO A LA TABLA 
		echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);

}# FIN SI ES EDITAR GALERÍA DESDE LA TABLA
		
if($_POST['action'] == 'US'){ #US --> ACTUALIZAR ESTADO DEL GALERÍA
		
	# FUNCION --> LIMPIA CADENASV
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_string/aym_fun_clean_url.php';	

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['gal_fea'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	#VALIDACION ---> LIMPIEZA DE VARIABLES
	$_POST['gal_id']=aym_clean_string($_POST['gal_id']);	
	$_POST['gal_fea']=aym_clean_string($_POST['gal_fea']);	

	#VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['gal_id'],FILTER_VALIDATE_INT)){ $Msg = "Galeria NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}
	if ($_POST['gal_fea']!= '0' && $_POST['gal_fea']!= '1'){ $Msg = "Estado NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php';}

	#VARIABLE
	$_GET['gal_id'] = $_POST['gal_id'];
	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE LA CATEGORIA DE LA GARIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_get_gallery_image.php';

	$_POST['gal_nam']= $row_get_gallery_image['gal_nam'];
	$_POST['gal_des']= $row_get_gallery_image['gal_des'];
	$_POST['gal_sub_cat_id']= $row_get_gallery_image['gal_sub_cat_id'];
	$_POST['lan_id']= $row_get_gallery_image['lan_id']; 
	$_POST['use_ip']= $row_get_gallery_image['use_ip']; 
	$_POST['use_id']= $row_get_gallery_image['use_id']; 
	$_POST['pag_id']= $row_get_gallery_image['pag_id']; 

	# INCLUSION -> PROCEDIMIENTO PARA ACTUALIZAR ESTADO DE LA GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_update_gallery_image.php'; 
	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]); 

}# --> FIN ACTUALIZAR ESTADO DE LA GALERÍA

if ($_POST['action'] == 'DI') { # DI -->   ELIMINAR IMAGEN / GALERIA
		
	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['gal_id'])) {include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	

	# VALIDACION ---> INTEGRIDAD DE VARIABLES
	if (!filter_var($_POST['gal_id'], FILTER_VALIDATE_INT)){ $Msg = "Subcategoria NO valido"; include_once $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_component/aym_message/aym_show_message_no_redirect.php";}
	
	# INCLUSIÓN --> PROCEDIMIENTO PARA ELIMINAR UNA FOTO DE GALERIA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_del_gallery_image.php'; 
	
	# VALIDACION --> HIZO O NO EL PROCESO EL PROCESO
	if ($ReturnStatus < 1) { # 0 --> PROCESADO SATISFACTORIAMENTE 
		#INCLUSION --> COMPONENTE QUE PROCESA LA IMAGEN
		include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_component/aym_gallery/aym_move_image.php';
	}
	
	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);

}#FIN

	
?>