<?php # **************************** AYMCORE V: 14.0 ********************
# MODULO PARA RESTABLECER LA CONTRASEÑA
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
?>
<main>
	<figure>
		<img src="/admin/aym_image/aym_logo_white.png" alt="Aymsoft SAS" longdesc="Aymsoft SAS">
	</figure>
	<section>
		<h1>Restaurar Contraseña</h1>				
		<form action="/admin/actionuser" name="frm_cha_pas" id="frm_cha_pas" method="post" enctype="multipart/form-data">		
			<fieldset>
				<div class="aym_frm_row" id="aym_use_log">
					<label for="use_log">E-mail:</label>
					<input type="email" name="use_log" id="use_log" value="<?= $_SESSION['use_log']?>" readonly>
				</div>
				<div class="aym_frm_row" id="aym_use_pwd">
					<label for="use_pwd">Contraseña actual:</label>
					<input type="password" name="use_pwd" id="use_pwd" placeholder="Digite su contraseña actual">
					<input type="checkbox" class="sho_pwd">
				</div>
				<div class="aym_frm_row" id="aym_use_pwd">
					<label for="use_pwd1">Contraseña nueva:</label>
					<input type="password" name="use_pwd1" id="use_pwd1" placeholder="Digite su nueva contraseña">
					<input type="checkbox" class="sho_pwd">
				</div>
				<div class="aym_frm_row" id="aym_use_pwd">
					<label for="use_pwd2">Repita la contraseña:</label>
					<input type="password" name="use_pwd2" id="use_pwd2" placeholder="Digite nuevamente la contraseña">
					<input type="checkbox" class="sho_pwd">
				</div>
				<div class="aym_frm_row">
					<button type="submit">Aceptar</button>
					<input type="hidden" name="aym_rec" id="aym_rec" value="0" />
					<input name="action" type="hidden" id="action" value="C" />
				</div>
			</fieldset>		
		</form>																														
	</section>
</main>