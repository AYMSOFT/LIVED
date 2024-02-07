<?php # **************************** AYMCORE V: 14.0 ********************
# PAGINA PRINCIPAL
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_security/aym_option.php'; 	

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?= $_SESSION['abo_bel'],' - ',$_SESSION['abo_nam'],' V ',$_SESSION['abo_ver']?></title>
	<meta name="description" content="<?= $_SESSION['abo_des']?>">
	<link rel="icon" href="/admin/aym_image/favicon.png">
	<link rel="stylesheet" href="/admin/aym_css/aym_common/aym_style_animation.css">
	<link rel="stylesheet" href="/admin/aym_css/aym_style_admin.css?<?=time()?>">
	<link rel="stylesheet" href="/admin/aym_css/aym_validate/aym_style_validate.css">
	<link rel="stylesheet" href="/admin/aym_css/aym_window/aym_window.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
	<link rel="stylesheet" href="/admin/aym_css/aym_common/aym_style_datepicker.css">
	<link rel="stylesheet" href="/admin/aym_css/aym_dropzone/dropzone.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script>
	<script src="/admin/aym_js/aym_datetimepicker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_window/aym_window.min.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_common/aym_common.js?<?=time()?>"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_color/aym_color_function.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_user/aym_user_image_function.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_dropzone/dropzone.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_security/aym_security_time_function.js?<?=time()?>"></script> <?php # VALIDACIÓN TIEMPO SESSION ?>

</head>
<body>
	<?php
		
		# PRELOAD 
		echo '<figure id="aym_loading"><img src="/admin/aym_image/aym_icon/aym_cohetin.gif"></figure>';
		
		# INCLUSIÓN -> HEADER
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_page/aym_header.php';	
		
		# VALIDO SI ESTÁ AUTENTICADO  
		if (isset($_SESSION['user_log_in'])){ 
			# PAGINA --> PRINCIPAL 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_page/aym_main.php';		
		} else {
			header('Location: '.'/login');
		}

		#  PAGINA --> FOOTER
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_page/aym_footer.php';
	?>
</body>
</html>