<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA BUSCAR LOS USUARIOS DE LA LISTA DE CORREOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VARIABLES
	unset($_SESSION['chk_lis_dat']); unset($_SESSION['lis_dat_ini']); unset($_SESSION['lis_dat_fin']);
	unset($_SESSION['chk_lis_nam']); unset($_SESSION['lis_nam']); 
	unset($_SESSION['chk_lis_ema']); unset($_SESSION['lis_ema']);
?>
<div class="aym_wrap_form aym_wrap_search">
	<form action="/aymcms/<?=$_GET['option'];?>/aym_list_mail" method="post" name="frm_find_list_mail" id="frm_find_list_mail">
		<fieldset>
			<div>
				<span class="aym_search_chk">
					<input name="chk_lis_nam" type="checkbox" id="chk_lis_nam" value="1">
				</span>
				<div>
					<label>Nombre:</label>
					<input name="lis_nam" type="text" id="lis_nam" size="45" onclick="document.frm_find_list_mail.chk_lis_nam.checked=true">
				</div>
			</div> 
			
			<div>
				<span class="aym_search_chk">
					<input name="chk_lis_ema" type="checkbox" id="chk_lis_ema" value="1">
				</span>
				<div>
					<label>Correo:</label>
					<input name="lis_ema" type="text" id="lis_ema" size="45" onclick="document.frm_find_list_mail.chk_lis_ema.checked=true">
				</div>
			</div> 
			
			<div>
				<span class="aym_search_chk">
					<input name="chk_lis_dat" type="checkbox" id="chk_lis_dat" value="1">
				</span>
				<div class="aym_frm_date">
					<div>
						<label>Desde</label>
						<input type="text" class="aym_input_date" id="lis_dat_ini" name="lis_dat_ini" value="<?= date("Y-m-d") ?>" onclick="document.frm_find_list_mail.chk_lis_dat.checked=true">
					</div>
					<div>
						<label>Hasta</label>
						<input type="text" class="aym_input_date" id="lis_dat_fin" name="lis_dat_fin" value="<?= date("Y-m-d", strtotime("+1 day")) ?>" onclick="document.frm_find_list_mail.chk_lis_dat.checked=true">
					</div>
				</div>
			</div> 
			<div class="aym_frm_submit"> 
				  <button type="submit">Aceptar</button>
				  <input name="action" type="hidden" id="action" value="F">
			</div>
			<hr>
			<span class="aym_text_required">Si no selecciona ningún filtro, el sistema mostrará todos los registros</span>
		</fieldset>
	</form>
</div>
