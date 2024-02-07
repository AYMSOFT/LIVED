<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA ADMINISTRAR FAQ
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	#VALIDACIÓN --> PARA INGRESAR AL APLICATIVO
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_validate_security.php';

#====================================================================================================
#====================================================================================================
#=============================================== FAQ ================================================
#====================================================================================================
#====================================================================================================

if ($_POST['action'] == 'I') { # I -->  INSERTAR FAQ

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['faq_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['faq_que'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['faq_ans'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['faq_cat_id']=aym_clean_string($_POST['faq_cat_id']);	
	$_POST['faq_que']=aym_clean_string($_POST['faq_que']);	

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['faq_cat_id'], FILTER_VALIDATE_INT)){ $aym_msg = "ID NO válido"; include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_redirect.php");}
	if (mb_strlen($_POST['faq_que'])<3|| mb_strlen($_POST['faq_que'])>255){ $Msg = "Pregunta NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['faq_ans'])<3|| mb_strlen($_POST['faq_ans'])>65535){ $Msg = "Respuesta NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}


	# INCLUSIÓN ----> PROCEDIMIENTO PARA INSERTAR LAS PREGUNTAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_add_faq.php';

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
} 

if ($_POST['action'] == 'U') { # I -->  ACTUALIZAR FAQ

			
	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['faq_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['faq_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['faq_que'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['faq_ans'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['faq_id']=aym_clean_string($_POST['faq_id']);	
	$_POST['faq_cat_id']=aym_clean_string($_POST['faq_cat_id']);	
	$_POST['faq_que']=aym_clean_string($_POST['faq_que']);	

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['faq_id'], FILTER_VALIDATE_INT)){ $aym_msg = "ID NO válido"; include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_redirect.php");}
	if (!filter_var($_POST['faq_cat_id'], FILTER_VALIDATE_INT)){ $aym_msg = "ID NO válido"; include_once ($_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_redirect.php");}
	if (mb_strlen($_POST['faq_que'])<3|| mb_strlen($_POST['faq_que'])>255){ $Msg = "Pregunta NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['faq_ans'])<3|| mb_strlen($_POST['faq_ans'])>65535){ $Msg = "Respuesta NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	
	# INCLUSIÓN ----> PROCEDIMIENTO PARA INSERTAR LAS PREGUNTAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_update_faq.php';

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
} 

if($_POST['action'] == 'UT'){ #UT --> EDITAR FAQ DESDE LA TABLA


	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';	

	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['faq_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['faq_id'] = aym_clean_string($_POST['faq_id']);

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['faq_id'], FILTER_VALIDATE_INT)){$ReturnStatus=1; $Msg = "FAQ NO válida"; include_once $_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_no_redirect.php";}

	#VARIABLE
	$_GET['faq_id'] = $_POST['faq_id'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_get_faq.php';

	if(empty($_POST['faq_que'])){
		$_POST['faq_que']= $row_get_faq['faq_que'];
	}else{
		# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
		$_POST['faq_que'] = aym_clean_string($_POST['faq_que']);

		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['faq_que'])< 3|| mb_strlen($_POST['faq_que'])>255){$ReturnStatus=1; $Msg = "Pregunta NO válida"; include_once $_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_no_redirect.php";}
	}

	$_POST['faq_ans'] = $row_get_faq['faq_ans'];
	$_POST['faq_cat_id'] = $row_get_faq['faq_cat_id'];

	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_update_faq.php'; 

	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
}# FIN SI ES EDITAR CATEGORIA DE FAQ DESDE LA TABLA

if ($_POST['action'] == 'D') { # D -->  ELIMINAR FAQ

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url =$_SERVER['HTTP_REFERER']; 

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['faq_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_input(INPUT_POST, 'faq_id', FILTER_VALIDATE_INT)){ $Msg = "FAQ NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	# PROCEDIMIENTO ---> ACTUALIZAR EL ESTADO
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_delete_faq.php';

	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);

}#-----> FIN ELIMINAR FAQ


#=============================================================================================================
#=============================================================================================================
#======================================== CATEGORIA FAQ ======================================================
#=============================================================================================================
#=============================================================================================================

if ($_POST['action'] == 'IC') { # I -->  INSERTAR CATEGORIA FAQ

	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = $_SERVER['HTTP_REFERER'];

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['faq_cat_nam'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}
	if (!isset($_POST['faq_cat_des'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['faq_cat_nam']=aym_clean_string($_POST['faq_cat_nam']);	
	$_POST['faq_cat_des']=aym_clean_string($_POST['faq_cat_des']);	

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (mb_strlen($_POST['faq_cat_nam'])<3|| mb_strlen($_POST['faq_cat_nam'])>150){ $Msg = "Nombre NO válido"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}
	if (mb_strlen($_POST['faq_cat_des'])<3|| mb_strlen($_POST['faq_cat_des'])>255){ $Msg = "Descripción NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}


	# INCLUSIÓN ----> PROCEDIMIENTO PARA INSERTAR  CATEGORIA DE PREGUNTAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_add_faq_category.php';

	# INCLUSIÓN --> COMPONENTE QUE MUESTRA LOS MENSAJES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message.php';
} 

if($_POST['action'] == 'UTC'){ #UT --> EDITAR CATEGORIA DESDE LA TABLA


	# FUNCION --> LIMPIA CADENAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_string.php';

	# FUNCION ---> OBTIENE LA IP
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_ip/aym_fun_get_ip.php';

	# FUNCION --> LIMPIA URL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_string/aym_fun_clean_url.php';	

	# VARIABLE ---> CONTIENE LA IP
	$use_ip = aym_get_ip();

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['faq_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VARIABLE --> LIMPIEZA DE VARIABLES
	$_POST['faq_cat_id'] = aym_clean_string($_POST['faq_cat_id']);

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_var($_POST['faq_cat_id'], FILTER_VALIDATE_INT)){$ReturnStatus=1; $Msg = "Categoria FAQ NO válida"; include_once $_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_no_redirect.php";}

	#VARIABLE
	$_GET['faq_cat_id'] = $_POST['faq_cat_id'];

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url = "/admin/admfaq/aym_list_faq_category/".$_POST['aym_page_size']."/".$_POST['aym_page'];

	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_get_faq_category.php';

	if(empty($_POST['faq_cat_nam'])){
		$_POST['faq_cat_nam']= $row_get_faq_category['faq_cat_nam'];
	}else{
		# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
		$_POST['faq_cat_nam'] = aym_clean_string($_POST['faq_cat_nam']);

		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['faq_cat_nam'])< 3|| mb_strlen($_POST['faq_cat_nam'])>150){$ReturnStatus=1; $Msg = "Nombre NO válido"; include_once $_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_no_redirect.php";}
	}
	if(empty($_POST['faq_cat_des'])){
		$_POST['faq_cat_des']= $row_get_faq_category['faq_cat_des'];
	}else{
		# VALIDACION ---> LIMPIEZA DE LAS VARIABLES
		$_POST['faq_cat_des'] = aym_clean_string($_POST['faq_cat_des']);

		# VALIDACION ---> INTEGRIDAD DE LAS VARIABLES
		if (mb_strlen($_POST['faq_cat_des'])< 3|| mb_strlen($_POST['faq_cat_des'])>255){$ReturnStatus=1; $Msg = "Descripción NO válida"; include_once $_SERVER['DOCUMENT_ROOT']."/admin/aym_component/aym_message/aym_show_message_no_redirect.php";}
	}

	# VARIABLE
	$use_ip = aym_get_ip();

	# EJECUTO EL COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_update_faq_category.php'; 

	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);
	
}# FIN SI ES EDITAR CATEGORIA DE FAQ DESDE LA TABLA

if ($_POST['action'] == 'DC') { # DC -->  ELIMINAR CATEGORIA DE FAQ

	# VARIABLE --> DETERMINAR LA REDIRECION 
	$aym_url =$_SERVER['HTTP_REFERER']; 

	# VALIDACION ---> EXISTENCIA DE LAS VARIABLES
	if (!isset($_POST['faq_cat_id'])){include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_hacker_alert.php';}

	# VALIDACIÓN ---> INTEGRIDAD DE LAS VARIABLES
	if (!filter_input(INPUT_POST, 'faq_cat_id', FILTER_VALIDATE_INT)){ $Msg = "Categoría de FAQ NO válida"; include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_message/aym_show_message_redirect.php';}

	# PROCEDIMIENTO ---> ACTUALIZAR EL ESTADO
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_delete_faq_category.php';

	# ENVIAR ESTADO A LA TABLA 
	echo json_encode(['ReturnStatus'=>$ReturnStatus, 'Msg'=>$Msg]);

}#-----> FIN ELIMINAR CATEGORIA DE FAQ

?>