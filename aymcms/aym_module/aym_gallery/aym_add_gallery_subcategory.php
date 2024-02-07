<?php # ****************************  AYMCMS V: 7.0 ********************
# FORMULARIO PARA AGREGAR UN AMBUM / SUBCATEGORIA
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
	
?>
<div class="aym_wrap_form">
	<form action="/aymcms/actiongallery" method="post" name="frm_add_gallery_subcategory" id="frm_add_gallery_subcategory">
		<fieldset>
			<div>
				<label for="lan_id">Idioma:</label>
				<select name="lan_id" id="lan_id" >
					<?php 
						while ($row_list_all_language = mysqli_fetch_array($aym_sql_list_all_language)) {
							echo '<option value="'.$row_list_all_language['lan_id'].'">'.$row_list_all_language['lan_nam'].'</option>';
						}mysqli_free_result($aym_sql_list_all_language);
					?>
				</select>
			</div>
			<div>
				<label for="gal_cat_id">Galería:</label> 
				<select name="gal_cat_id" id="gal_cat_id"><option value="0">[ SELECCIONE ]</option></select>
			</div>
			<div>
				<label for="gal_sub_cat_nam">Nombre del Álbum:</label> 
				<input name="gal_sub_cat_nam" type="text" id="gal_sub_cat_nam"  minlength="2" maxlength="150">
			</div>

			<div>
				<label class="gal_sub_cat_des">Descripción del Álbum:</label> 
				<input name="gal_sub_cat_des" type="text" id="gal_sub_cat_des" minlength="3" maxlength="255">
			</div>
			<!--submit button-->
			<div class="aym_frm_submit"> 
				  <button type="submit" class="val_add_user">Aceptar</button>
				  <input name="action" type="hidden" id="action" value="IS" >
			</div>
			<hr>
			<span class="aym_text_required">Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
	
	
	