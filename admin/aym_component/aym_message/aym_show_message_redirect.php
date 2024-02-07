<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA MOSTAR LOS MENSAJES DE ERROR Y DE CONFIRMACIÓN 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	if(!isset($Msg)) { $Msg ='Error desconocido 2004 !';}
	if(!isset($aym_url)) { $aym_url="/";} 
	
	$aym_img='<img src="/admin/aym_image/aym_icon/aym_ico_alert.png">';

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
					title: '<?= $aym_img ?>'+'<span>!!! ATENCIÓN !!!</span>', 
					titleClass: 'anim warning', 
					buttons: [{id: 0, label: 'Aceptar', val: 'X'}],
					callback: function(val) { window.location.replace("<?= $aym_url; ?>"); }
				}); 
			});
			</script>
		</main>
	</body>
</html>
<?php exit; ?>