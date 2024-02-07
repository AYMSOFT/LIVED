<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA ACTUALIZAR BANNERS
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
	
	# INCLUSIÓN --> PROCEDIMIENTO OBTENER LOS DATOS DE UN BANNER
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_get_banner.php';
	
	# VARIABLES 	
	if(!isset($_GET['lan_id'])){$_GET['lan_id']=$row_get_banner['lan_id'];}
	
?>
<div class="aym_wrap_form">
	<form action="/aymcms/actionbanner" method="post" name="frm_edit_banner" id="frm_edit_banner" enctype="multipart/form-data">
		<fieldset class="aym_frm_content">
			<div>
				<label>Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php 
						# INCLUSIÓN --> PROCEDIMIENTO LISTA LOS IDIOMAS
						include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';

						while($row_list_all_language = mysqli_fetch_array($aym_sql_list_all_language)){
					?>
						<option value="<?=$row_list_all_language['lan_id']?>" <?=($row_list_all_language['lan_id']==$row_get_banner['lan_id'])? 'selected' : '' ;?>><?=$row_list_all_language['lan_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_language);?>
				</select>
			</div>
			<div>
				<label>Categoría</label>
				<select name="ban_cat_id" id="ban_cat_id">
					<?php 
						# INCLUSIÓN --> PROCEDIMIENTO LISTADO DE CATEGORIAS DE BANNER
						include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_list_all_banner_category.php';
						while($row_list_banner_category = mysqli_fetch_array($aym_sql_list_banner_category)){
					?>
						<option value="<?=$row_list_banner_category['ban_cat_id']?>" <?=($row_list_banner_category['ban_cat_id']==$row_get_banner['ban_cat_id'])? 'selected' : '' ;?>><?=$row_list_banner_category['ban_cat_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_banner_category);?>
				</select>
			</div>
		
			<div class="aym_frm_date">
				<div>
					<label>Fec. Inicial</label>
					<input type="text" class="aym_input_date" id="ban_dat_tim_ini"  name="ban_dat_tim_ini" value="<?= $row_get_banner['ban_dat_ini'] ?>" readonly>
					<p>Fecha Inicial</p>
				</div>
				<div>
					<label>Fec. Final</label>
					<input type="text" class="aym_input_date" id="ban_dat_tim_fin" name="ban_dat_tim_fin" value="<?= $row_get_banner['ban_dat_fin'] ?>" readonly>
					<p>Fecha Final</p>	
				</div>
			</div>
			<div>
				<label>Descripción</label>
				<input name="ban_des" type="text" id="ban_des"   minlength="3" maxlength="255" value="<?= $row_get_banner['ban_des'] ?>" >
			</div>
			<div>
				<label>Pie de foto</label>
				<input name="ban_cap" type="text" id="ban_cap" minlength="2"  maxlength="150" value="<?= $row_get_banner['ban_cap'] ?>" >
			</div>
			<div class="aym_frm_date">
				<div>
					<label>URL</label>
					<input name="ban_url" type="text" id="ban_url"  minlength="2" maxlength="255" value="<?= $row_get_banner['ban_url'] ?>" >
				</div>
				<div>
					<label>Target</label>
					<select name="ban_tar" id="ban_tar"><option value="_self" <?php if ($row_get_banner['ban_tar'] == "_self") { echo 'selected="selected"'; }?>>Misma Ventana</option><option value="_blank" <?php if ($row_get_banner['ban_tar'] == "_blank") { echo 'selected="selected"'; }?>>Nueva Ventana</option></select>
				</div>
			</div>
			<div class="aym_small">
				<label>Orden</label>
				<input name="ban_pos" type="text" class="aym_clean_number" id="ban_pos" value="<?= $row_get_banner['ban_pos'] ?>" size="3" maxlength="3" >
			</div>
			<h3>Imágen:</h3>
			<div class="aym_frm_images">
				<div>
					<div class="aym_frm_image">
						<figure class="con_ima_thumb">
							<img  src="/admin/aym_image/aym_icon/aym_add_image.png">
						</figure>					       		
					</div>
					<input class="aym_hidden aym_file" name="doc_nom" type="file" id="con_ima">				
				</div>
			</div>
			<h3>Imagen Actual:</h3>
			<div class="aym_frm_images">
				<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_banner/'.$row_get_banner['ban_id'].'.jpg')) {?> 
					<span class="aym_col_2 aym_help">No se encontro una Imagen</span>
				<?php }else{?>
					<a id="aym_load_image" url="/aym_image/aym_banner/<?= $row_get_banner['ban_id']?>.jpg?<?=time()?>" style="cursor:pointer;">
						<img src="/aym_image/aym_banner/<?= $row_get_banner['ban_id']?>.jpg?<?=time()?>" align="Ver Imágen" border="0">
					</a>
				<?php }?>           
			</div>

			<div class="aym_wrap_checkbox">
				<div class="aym_frm_checkbox">
					<label for="ban_sta">Estado</label>
					<input type="checkbox" name="ban_sta" id="ban_sta" value="1" <?= ($row_get_banner['ban_sta'] == 1) ? 'checked' : '' ?> >
				</div>
			</div>        
		
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="U" >
				<input name="ban_id" type="hidden" id="ban_id" value="<?= $row_get_banner['ban_id'] ?>" >
			</div>
			<hr>
			<span class="aym_text_required">*Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<script>aym_change();</script>