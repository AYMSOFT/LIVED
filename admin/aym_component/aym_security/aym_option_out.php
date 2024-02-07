<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA DIRECIONAR LAS PAGINAS DEPENDIENDO DE LAS OPCIONES
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017

	session_start();

	date_default_timezone_set('America/Bogota');
	
	# VARIABLES 
	$_SESSION['alr'] = md5(session_id());
	
	# VALIDACION
	if (!isset($_GET['lan_id'])) { $_GET['lan_id']=1; }

	if (!isset($_SESSION['con_sit_nam'])){
 		
		# INCLUSIÓN --> PROCEDIMIENTO QUE TRAE LA CONFIGURACION	
		include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_config_site/aym_sql_config_site.php';
		
		$_SESSION['con_sit_nam']=$row_get_config_site['con_sit_nam'];
		$_SESSION['con_sit_ver']=$row_get_config_site['con_sit_ver'];
		$_SESSION['con_sit_tit']=$row_get_config_site['con_sit_tit'];
		$_SESSION['con_sit_url']=$row_get_config_site['con_sit_url'];
		$_SESSION['con_sit_ema']=$row_get_config_site['con_sit_ema'];
		$_SESSION['con_sit_des']=$row_get_config_site['con_sit_des'];
		
	}
	
	# INCLUSIÓN --> FUNCIÓN URL AMIGABLE QUE TRAE LA CONFIGURACION	
	include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_function/aym_url/aym_fun_url.php';	
	
	# INCLUSIÓN --> FUNCIÓN LISTA IMAGENES DE CARPETA
	include $_SERVER['DOCUMENT_ROOT']."/admin/aym_function/aym_files/aym_img_files.php";

	
	if (!isset($_GET['pag_id'])) { 
		$_GET['pag_cat_id'] = 1;
		include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_all_link.php';			
		$_GET['pag_id']=$row_get_page['pag_id'];
		$_GET['pag_tit']=$row_get_page['pag_tit'];
	}

	# VARIABLE --> GUARDAR ID ORIGINAL DE LA PAGINA
	$aym_pag_id = $_GET['pag_id'];

	# INCLUSIÓN --> PROCEDIMIENTO TRAE LOS DATOS DE UNA PÁGINA  
	require $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page_out.php'; 

	if ($num_rows < 1) {
		$row_get_pag['pag_cat_id'] = 0;
		$row_get_pag['pag_tem'] = 'aym_404.php';
	}


	
	# URL 
	$aym_url_pag = "/aymcms/aym_template/aym_tem_".$row_get_pag['pag_cat_id']."/".$row_get_pag['pag_tem']; 	
?>