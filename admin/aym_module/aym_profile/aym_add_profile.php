<div class="aym_wrap_form">
	<form action="/admin/actionprofile" method="post" name="frm_add_profile" id="frm_add_profile" autocomplete="off" >
		<fieldset>
			<div>
				<label for="pro_nam">Nombre del Perfil:</label>
				<input name="pro_nam" type="text" id="pro_nam">
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="I">
				<input name="cli_id" type="hidden" id="cli_id" value="0">
			</div>
			<hr>
			<span class="aym_text_required">*Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>