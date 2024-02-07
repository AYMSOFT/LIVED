<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA AGREGAR NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023  

	
	# INCLUSIÓN --> PROCEDIEMINTO QUE LISTA LOS IDIOMAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';

?>
<div class="aym_wrap_form">
	<form action="/aymcms/actionnews" method="post" name="frm_add_news" id="frm_add_news" enctype="multipart/form-data">
		<fieldset>
			<div>
				<label>Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php while ($row_list_language = mysqli_fetch_array($aym_sql_list_all_language)) { ?>
						<option value="<?=$row_list_language['lan_id']?>"><?=$row_list_language['lan_nam']?></option>
					<?php } mysqli_free_result ($aym_sql_list_all_language); ?> 
				</select>
			</div> 
			<div>
				<label for="new_cat_id">Categoria</label>
				<select name="new_cat_id" id="new_cat_id"><option value="0">[ SELECCIONE ]</option></select>
			</div>
			<div>
				<label for="new_tit">Titulo</label>
				<input name="new_tit" type="text" id="new_tit"  minlength="2" maxlength="150">
			</div>

			<div>
				<label for="new_lea">Lead</label>
				<input name="new_lea" type="text" id="new_lea" minlength="2" maxlength="300">
			</div>
			<div id=""></div>
			<h3>Contenido</h3>
			<div class="aym_frm_full">

				<div class="aym_ckeditor_toolbar">
					<div class="document-editor__toolbar"></div>
				</div>

				<div class="aym_ckeditor_editor">
					<div name="content" id="editor" data-id="new_des">
						
					</div>
				</div>
			</div>
			<input type="hidden" name="new_des" id="new_des"  value=''>
			<div class="aym_medium">
				<label for="new_url">URL</label>
				<input name="new_url" type="text" id="new_url" minlength="3" maxlength="150">
			</div>
			<div class="aym_wrap_checkbox">			
				<div class="aym_frm_checkbox">
					<label class="new_sta">Publicar</label>
					<input name="new_sta" type="checkbox" id="new_sta" value="1" checked="checked">
				</div>
				<div class="aym_frm_checkbox">
					<label class="new_sta">Cover</label>
					<input name="new_cov" type="checkbox" id="new_cov" value="1" checked="checked"> 	
				</div> 	 
			</div>
			<h3>Imagen</h3>
			<div class="aym_frm_images">
				<div>
					<div class="aym_frm_image">
						<figure class="con_ima_thumb"><img src="/admin/aym_image/aym_icon/aym_add_image.png"></figure>		
						Agregar imagen
					</div>
					<input class="aym_hidden aym_file" name="doc_nom" type="file" id="con_ima">
				</div>
			</div>    	
			<div class="aym_frm_submit"> 
				<button type="submit">Aceptar</button>
				<input name="action" type="hidden" id="action" value="I" >
			</div>
			<hr>
			<span class="aym_text_required">(*)Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>

<!-- Espacio para agregar ckeditor con ventana gestor -->
<div id="aym_folder_modal"></div>
<script>aym_change();</script>
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
<script type="text/javascript" src="aym_js/aym_finder/aym_finder_initialize.js"></script>
