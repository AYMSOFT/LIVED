<?php # **************************** AYMCMS V: 7.0********************
# FORMULARIO PARA EDITAR UNA IMÁGEN 
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSIÓN --> COMPONENTE PARA TRAER DATOS DE LA IMAGEN
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_get_gallery_image.php';	
	
?>
<div class="aym_wrap_form">
	<form action="/aymcms/actiongallery" method="post" name="frm_edit_gallery_image" id="frm_edit_gallery_image"  enctype="multipart/form-data">
		<fieldset> 
			<div>
				<label>Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php 
						# INCLUSIÓN --> PROCEDIMIENTO LISTA LOS IDIOMAS
						include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
						while($row_list_all_language = mysqli_fetch_array($aym_sql_list_all_language)){
					?>
							<option value="<?=$row_list_all_language['lan_id']?>" <?=($row_list_all_language['lan_id']==$$row_get_gallery_image['lan_id'])? 'selected' : '' ;?>><?=$row_list_all_language['lan_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_language);?>
				</select>
			</div>
			<div>
				<label for="gal_cat_id">Galería:</label>
				<select name="gal_cat_id" id="gal_cat_id">
					<?php 
						# INCLUSIÓN --> PROCEDIMIENTO LISTA LAS CATEGORIAS
						$_GET['lan_id']=$row_get_gallery_image['lan_id'];
						include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_list_all_gallery_category.php';
						while($row_list_all_gallery_category = mysqli_fetch_array($aym_sql_list_all_gallery_category)){
					?>
							<option value="<?=$row_list_all_gallery_category['gal_cat_id']?>" <?=($row_list_all_gallery_category['gal_cat_id']==$row_get_gallery_image['gal_cat_id'])? 'selected' : '' ;?>><?=$row_list_all_gallery_category['gal_cat_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_gallery_category);?>
				</select>
			</div>
			<div>
				<label for="gal_sub_cat_id">Álbum:</label>
				<select name="gal_sub_cat_id" id="gal_sub_cat_id" >
					<option value="0"> [ SELECCIONE ] </option>
					<?php 
						# INCLUSIÓN --> PROCEDIMIENTO LISTA LAS SUB-CATEGORIAS
						$_GET['gal_cat_id']=$row_get_gallery_image['gal_cat_id'];
						include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_list_all_gallery_subcategory.php';
						while($row_get_gallery_subcategory = mysqli_fetch_array($aym_sql_list_all_gallery_subcategory)){
					?>
							<option value="<?=$row_get_gallery_subcategory['gal_sub_cat_id']?>" <?=($row_get_gallery_subcategory['gal_sub_cat_id']==$row_get_gallery_image['gal_sub_cat_id'])? 'selected' : '' ;?>><?=$row_get_gallery_subcategory['gal_sub_cat_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_gallery_subcategory);?>
				</select>
			</div>
			<div class="aym_frm_row">
				<label for="gal_nam">Nombre:</label>
				<input type="text" name="gal_nam" id="gal_nam" minlength="2" maxlength="150" value="<?=$row_get_gallery_image['gal_nam']; ?>">
				<p>imagen</p>
			</div>
			
			<h3>Imagen</h3>
			<div class="aym_frm_images">
				<div>
					<div class="aym_frm_row">
						<label>Descripción de imagen</label>
						<input type="text" name="gal_des" id="gal_des" minlength="3" maxlength="255" value="<?=$row_get_gallery_image['gal_des']; ?>">
					</div>
					<div class="aym_frm_image">
						<figure class="con_ima_thumb"><img src="/aym_image/aym_gallery/<?= $row_get_gallery_image['gal_id'] ?>.jpg" alt="Image"></figure>		
						Agregar imagen
					</div>
					<input class="aym_hidden aym_file" name="aym_fil[]" type="file" id="con_ima">
				</div>
			</div>
			<div class="aym_wrap_checkbox">
				<div class="aym_frm_checkbox">
					<label for="ban_sta">Estado</label>
					<input type="checkbox" name="gal_fea" id="gal_fea" value="1" <?= ($row_get_gallery_image['gal_fea'] == 1) ? 'checked' : '' ?> >
				</div>
			</div>       
			<div class="aym_frm_submit"> 
				<button type="submit" class="val_add_user">Aceptar</button>
				<input name="lan_id" type="hidden" id="lan_id" value="<?= $row_get_gallery_image['lan_id'] ?>" >
				<input name="gal_cat_id" type="hidden" id="gal_cat_id" value="<?= $row_get_gallery_image['gal_cat_id'] ?>" >
				<input name="gal_sub_cat_id" type="hidden" id="gal_sub_cat_id" value="<?= $row_get_gallery_image['gal_sub_cat_id'] ?>" >
				<input name="gal_id" type="hidden" id="gal_id" value="<?= $row_get_gallery_image['gal_id'];  ?>" >
				<input name="action" type="hidden" id="action" value="UI" >
			</div>
			<hr>
			<span class="aym_text_required">Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<script>aym_change();</script>
