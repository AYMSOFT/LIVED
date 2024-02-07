<div class="aym_wrap_form">
	<form action="/admin/actionuser" method="post" name="frm_restore_pass" id="frm_restore_pass" autocomplete="off">
		<fieldset>
			<div class="aym_search_user">
				<label>Cuenta de Usuario:</label>
				<input name="use_nam" id="use_nam" class="aym_frm_search" autocomplete="off" type="text">
				<div id="aym_search_results"></div>            
			</div>
			<div class="aym_hidden filled" id="aym_user_detail"></div>
			
			<div class="aym_hide">
				<label for="use_pwd">Contraseña:</label>
				<input name="use_pwd" type="password" id="use_pwd" placeholder="">
				<input type="checkbox" class="sho_pwd">
			</div>
			<div class="aym_hide">
				<label for="use_pwd2">Repita la Contraseña:</label>
				<input name="use_pwd2" type="password" id="use_pwd2" placeholder="">
				<input type="checkbox" class="sho_pwd">
			</div>
			<div class="aym_frm_submit aym_hide" >
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="R">
				<input name="cli_id" type="hidden" id="cli_id" value="0">
				<input name="use_id" type="hidden" id="use_id" value="0" />	
			</div>
			<hr>
			<span class="aym_text_required">*Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<script src="/admin/aym_js/aym_user/aym_user_search.js"></script>