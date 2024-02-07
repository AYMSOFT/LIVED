<?php # **************************** AYMCMS V: 7.0 ********************
# CONTENEDOR PRINCIPAL DEL SITIO
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSION --> CONFIGURACION INICIAL
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_option_out.php'; 
?>
<!DOCTYPE html>
<html lang="es"> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="description" content="<?= $_SESSION['con_sit_des'];?>">  
	<meta name="Generator" content="AyMsite 6.0 (https://www.aymsoft.com)">
	<meta property="og:description" content="<?= $_SESSION['con_sit_des'];?>">
	<meta property="og:url" content="https://<?=$_SERVER['SERVER_NAME'];?>/">
	<meta property="og:locale" content="es_CO">
	<meta property="og:type" content="website">
	<meta property="og:image" content="https://<?=$_SERVER['SERVER_NAME'];?>/aym_image/aym_logo/aym_open_graph_logo.jpg">
	<meta property="og:site_name" content="<?=$_SESSION['con_sit_nam'] ?>" />
	<title><?= $_SESSION['con_sit_nam'], ' - ',  $_SESSION['con_sit_tit'];?></title>
	<link rel="canonical" href="https://<?=$_SERVER['SERVER_NAME'];?>/">
	<link rel="alternate" href="https://<?=$_SERVER['SERVER_NAME'];?>/" hreflang="es-CO">
	<link rel="icon" type="image/png" href="/aym_image/favicon.png">
	
	<link async rel="stylesheet" type="text/css" media="all" href="/aym_css/aym_style_page.css">
	<link rel="preload" href="/aym_css/aym_window_out/aym_window.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<noscript><link rel="stylesheet" href="/aym_css/aym_window_out/aym_window.css"></noscript>

	<link rel="preload" href="/aym_css/aym_owl_carousel/owl.carousel.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<noscript><link rel="stylesheet" href="/aym_css/aym_owl_carousel/owl.carousel.min.css"></noscript>
</head>
<body>

	<script async rel="preload" as="script" src="/aym_js/aym_fontawesome/aym_fontawesome.js" crossorigin="anonymous" ></script>
	<script type="text/javascript" src="/aym_js/aym_jquery/3.4.0/jquery.min.js"></script>
	<script async type="text/javascript" src="/aym_js/aym_owl_carousel/owl.carousel.min.js"></script>
	<script async type="text/javascript" src="/aym_js/aym_validate/jquery.validate.min.js" onload="init()"></script>
	<script async type="text/javascript" src="/aym_js/aym_window_out/aym_window.js"></script>
	<script async type="text/javascript" src="/aym_js/aym_script_page.js"></script>
	<?php

		# INCLUSIÓN --> HEADER
		include $_SERVER['DOCUMENT_ROOT'].'/aym_view/aym_header.php';
	
		# INCLUSIÓN --> HOME
		include $_SERVER['DOCUMENT_ROOT'].$aym_url_pag;
		
		# INCLUSIÓN --> FOOTER
		include $_SERVER['DOCUMENT_ROOT'].'/aym_view/aym_footer.php';

	?>
</body>
</html>