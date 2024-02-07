<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDULO PARA LISTAR EL REGISTRO DE ENTRADAS DE UN USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

	session_start();
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 50; } # 50 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGINA EN LA QUE INICIA
?>
<form name="frm_list_user_log" id="frm_list_user_log" enctype="multipart/form-data">
    <input name="aym_page_size" type="hidden" id="aym_page_size" value="<?= $_GET['aym_page_size']; ?>">
    <input name="aym_page" type="hidden" id="aym_page" value="<?= $_GET['aym_page']; ?>">
    <input name="use_id" type="hidden" id="use_id" value="<?= $_GET['use_id'];?>">
	<div id="aym_list_user_log">
		<?php
			# INCLUSIÓN ---> COMPLEMENTO QUE LISTA EL LOG DE USUAIROS 
			include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_complement/aym_user/aym_com_list_user_log.php';
		?>
	</div>
	<div id="aym_list_error"></div>
</form>