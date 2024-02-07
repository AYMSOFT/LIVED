<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA AGREGAR CATEGORIAS DE BANNER
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
		
	# INCLUSIÓN -->PROCEDIMIENTO QUE LISTA LOS TIPOS DE LENGUAGE
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
	
?>
<div class="aym_wrap_form">
	<form action="/aymcms/actionbanner" method="post" name="frm_add_banner_category" id="frm_add_banner_category" autocomplete="off">
		<fieldset>
			<div>
				<label>Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php while ($row_list_all_language = mysqli_fetch_array($aym_sql_list_all_language)){ ?>
						<option value="<?=$row_list_all_language['lan_id']?>"><?=$row_list_all_language['lan_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_language); ?>
				</select>
			</div> 
			<div>
				<label>Nombre</label>
				<input name="ban_cat_nam" type="text" id="ban_cat_nam"  minlength="2" maxlength="150">
			</div>

			<div>
				<label>Descripción</label>
				<input name="ban_cat_des" type="text" id="ban_cat_des" minlength="3" maxlength="255">
			</div>
			<div class="aym_frm_date">
				<div>
					<label>Ancho</label>
					<input type="text" id="ban_cat_wid" name="ban_cat_wid" class="aym_clean_number" size="4" maxlength="4"> 
					<p>px</p>
				</div>
				<div>
					<label>Alto</label>
					<input type="text" id="ban_cat_hei" name="ban_cat_hei" class="aym_clean_number" size="4" maxlength="4">
					<p>px</p>
				</div>
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="IC">
			</div>
			<hr>
			<span class="aym_text_required">(*)Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
