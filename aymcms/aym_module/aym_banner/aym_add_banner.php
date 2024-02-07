<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA AGREGAR BANNERS
# � 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSIÓN --> COMPONENTE LISTA LOS IDIOMAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
	
?>
<div class="aym_wrap_form">
	<form action="/aymcms/actionbanner" method="post" name="frm_add_banner" id="frm_add_banner" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
			<div>
				<label>Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php while ($row_list_all_language = mysqli_fetch_array($aym_sql_list_all_language)){ ?>
						<option value="<?=$row_list_all_language['lan_id']?>"><?=$row_list_all_language['lan_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_language); ?>
				</select>
			</div> 
			<div class="filled">
				<label>Categoría</label>
				<select name="ban_cat_id" id="ban_cat_id"><option value=""> </option></select>
			</div>
			<div class="aym_frm_date">
				<div>
					<label>Fecha inicial</label>
					<input type="text" class="aym_input_date" id="ban_dat_tim_ini"  name="ban_dat_tim_ini" value="<?= date("Y-m-d", strtotime("+1 day"))?> 00:00:00" readonly>
				</div>
				<div>
					<label>Fecha final</label>
					<input type="text" class="aym_input_date" id="ban_dat_tim_fin" name="ban_dat_tim_fin" value="<?= date("Y-m-d", strtotime("+2 day"))?> 23:59:59" readonly>
				</div>
			</div>
			<div>
				<label>Descripción</label>
				<input name="ban_des" type="text" id="ban_des"  minlength="3" maxlength="255">
			</div>
			<div>
				<label>Pie de foto</label>
				<input name="ban_cap" type="text" id="ban_cap" minlength="2"  maxlength="150">
			</div>
			<div class="aym_frm_date"> 
				<div>
					<label>URL</label>
					<input type="text" id="ban_url" name="ban_url"  minlength="2" maxlength="255">
				</div>
				<div>
					<label>Target</label>
					<select name="ban_tar" id="ban_tar"><option value="_self">Misma Ventana</option><option value="_blank">Nueva Ventana</option></select>
				</div>
			</div>
			<div class="aym_small">
				<label>Orden</label>
				<input name="ban_pos" type="text" id="ban_pos" class="aym_clean_number" size="3" maxlength="3">
			</div>
			<h3>Imágen</h3>
			<div class="aym_frm_images">
				<div class="aym_frm_image">
					<figure class="con_ima_thumb"><img src="/admin/aym_image/aym_icon/aym_add_image.png"></figure>		
					Agregar imagen
				</div>
				<input class="aym_hidden aym_file" name="doc_nom" type="file" id="con_ima">			
			</div>
			<div class="aym_wrap_checkbox">
				<div class="aym_frm_checkbox">
					<label>Estado</label>
					<input type="checkbox" name="ban_sta" id="ban_sta" value="1" checked>
				</div>      
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="I">
			</div>
			<hr>
			<span class="aym_text_required">*Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<script>aym_change();</script>