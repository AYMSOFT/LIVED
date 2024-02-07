<?php
	# COMPONENTE QUE TRAE LOS DATOS DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_profile/aym_sql_get_profile.php';
?>
<div class="aym_wrap_form">
	<form action="/admin/actionprofile" method="post" name="frm_edit_profile" id="frm_edit_profile" autocomplete="off" >
		<fieldset>
			<div>
				<label for="use_nam">Nombre del Perfil:</label>
				<input name="pro_nam" type="text" id="pro_nam" value="<?= $row_get_profile['pro_nam']; ?>">
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="U">
				<input name="pro_id" type="hidden" id="pro_id" value="<?= $row_get_profile['pro_id']; ?>">
			</div>
			<hr>
			<span class="aym_text_required">*Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>