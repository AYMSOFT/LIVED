<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA AGREGAR UNA IMÁGEN 
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSIÓN --> PROCEDIMIENTO LISTA LOS IDIOMAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
	
	$_GET['gal_cat_id']=$row_get_gallery_image['gal_cat_id'];
	
?>
<div class="aym_wrap_form">
	<form action="/aymcms/actiongallery" method="post" name="frm_add_gallery_image" id="frm_add_gallery_image" enctype="multipart/form-data">
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
				<select name="gal_cat_id" id="gal_cat_id"></select>
			</div>
			<div>
				<label for="gal_sub_cat_id">Álbum:</label>
				<select name="gal_sub_cat_id" id="gal_sub_cat_id"></select>
			</div>
			<div class="aym_frm_row">
				<label for="gal_nam">Nombre:</label>
				<input type="text" name="gal_nam" id="gal_nam"  minlength="2" maxlength="150">
				<p>imagen</p>
			</div>
			<h3>Imagen</h3>
			<div class="aym_frm_images">
				<div>
					<div class="aym_frm_row">
						<label>Descripción de imagen</label>
						<input type="text" name="gal_des[]" id="gal_des"  minlength="3" maxlength="255">
					</div>
					<div class="aym_frm_image">
						<figure class="con_ima_thumb"><img src="/admin/aym_image/aym_icon/aym_add_image.png"></figure>		
						Agregar imagen
					</div>
					<input class="aym_hidden aym_file" name="aym_fil[]" type="file" id="con_ima">
				</div>
				<span class="aym_add_item"></span>
			</div>
			<!--submit button-->
			<div class="aym_frm_submit"> 
				<button type="submit" class="val_add_user">Aceptar</button>
				<input name="action" type="hidden" id="action" value="II" >
			</div>
			<hr>
			<span class="aym_text_required">Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<script>aym_change();</script>
