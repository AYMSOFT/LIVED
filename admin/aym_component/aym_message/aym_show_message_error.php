<?php # **************************** AYMCORE V: 1.0 ********************
# COMPONENTE PARA CAPTURAR Y MOSTRAR ERRORES DE SINTAXIS
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017 

	//session_destroy();
	//session_unset ();
	
	$aym_class="anim error";
	$aym_title="<span>ATENCIÓN</span>";
	$aym_img='<img src="/admin/aym_image/aym_icon/aym_ico_ups.png">';
	


	# NOMBRE STORE PROCEDURE 
	if(!isset($aym_sp)){ $aym_sp = "N/D";  }

	if (mysqli_errno($link) > 9999 ){
		$Msg = 'No se pudo ejecutar la operación.<br><strong>Code:</strong> '.mysqli_errno($link).' <strong>SP:</strong> '.strtolower($aym_sp).'<br><strong>Error: </strong>'.mysqli_error($link).'<br><strong>Sugerencia: </strong>Verifque los datos introdicidos en el formulario.'; 
	} else {
		$Msg = 'No se pudo ejecutar la operación.<br>Ha ocurrido un error de integridad.<br><strong>Code:</strong> '.$XMsg = mysqli_errno($link).'<strong> SP:</strong> '.strtolower($aym_sp).'<br><strong>Error:</strong> '.mysqli_error($link).' <br><strong>Sugerencia:</strong>Contacte a servicio al cliente.'; 
	}


	
	if (!isset($aym_url)) { $aym_url="/admin/error";}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>AyMcore</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">	
	<link rel="icon" href="/admin/aym_image/favicon.png">
	<link rel="stylesheet" type="text/css" href="/admin/aym_css/aym_window/aym_window.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="/admin/aym_js/aym_window/aym_window.min.js"></script>
</head>
<body>
	<main>
		<script type="text/javascript">
			$(function() {

				new AyM_window("<?= $Msg; ?>", {
					title: '<?= $aym_img.$aym_title; ?>', 
					titleClass: '<?= $aym_class; ?>', 
					buttons: [{id: 0, label: 'Aceptar', val: 'X'}],
					callback: function(val) { window.location.replace("<?= $aym_url; ?>"); }
					
				}); 
				
			});
		</script>
		</main>
	</body>
</html>
<?php exit; ?>