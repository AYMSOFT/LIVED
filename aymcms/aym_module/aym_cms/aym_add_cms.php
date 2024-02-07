<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA AGREGAR PAGINA DE CONTENIDOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1; } # 1 --> ESPANOL 
	
	# INCLUSIÓN --> PROCEDIEMINTO QUE LISTA LOS IDIOMAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
?>

<div class="aym_wrap_form">
	<form action="/aymcms/actioncms" method="post" name="frm_add_page" id="frm_add_page" autocomplete="off" enctype="multipart/form-data">
		<fieldset>
			<div>
				<label for="lan_id">Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php while ($row_list_language = mysqli_fetch_array($aym_sql_list_all_language)) { ?>
						<option value="<?=$row_list_language['lan_id']?>"><?=$row_list_language['lan_nam']?></option>
					<?php } mysqli_free_result ($aym_sql_list_all_language); ?> 
				</select>
			</div>
			<div>
			   <label for="pag_cat_id">Categoría</label>
			   <select name="pag_cat_id" id="pag_cat_id"><option value="">[ SELECCIONE ]</option></select>
			</div>

			<div>
			  	<label for="pag_sub_id">Página</label>
				<select name="pag_sub_id" id="pag_sub_id"></select>    
			</div>

			<div>
				<label for="pag_tem">Plantilla</label>
				<select name="pag_tem" id="pag_tem"></select> 
			</div>
		   
			<h3>Mostrar en</h3>
			<div class="aym_wrap_checkbox" id="aym_men_wrp"></div>
			<div>
				<label for="pag_tit">Título</label>
				<input name="pag_tit" type="text" id="pag_tit" maxlength="100">    
			</div>

			<div>
				<label for="pag_des">Descripción</label>
				<input name="pag_des" type="text" id="pag_des" maxlength="255"> 
			</div>
			<h3>Contenido</h3>
			<!-- This container will become the editable. -->
			<div class="aym_frm_full">

				<div class="aym_ckeditor_toolbar">
					<div class="document-editor__toolbar"></div>
				</div>

				<div class="aym_ckeditor_editor">
					<textarea name="pag_con" id="editor" data-id="pag_con"></textarea>
				</div>

			</div>
							
			<div class="aym_frm_date">
				<div>
					<label for="pag_url">URL</label>
					<input type="text" id="pag_url" name="pag_url" maxlength="150">
				</div>
				<div>
					<label for="pag_tar">Target</label>
					<select name="pag_tar" id="pag_tar">
						<option value="_self">Misma Ventana</option>
						<option value="_blank">Nueva Ventana</option>
					</select>
				</div>		
			</div>
			<h3>Banners</h3>
			<div class="aym_frm_images">
				<div>
					<div class="aym_frm_row">
						<label>Descripción de imagen</label>
						<input type="text" name="pag_ima_des[]" id="pag_ima_des" maxlength="200">
					</div>
					<div class="aym_frm_image">
						<figure class="con_ima_thumb"><img src="/admin/aym_image/aym_icon/aym_add_image.png"></figure>		
						Agregar imagen
					</div>
					<input class="aym_hidden aym_file" name="aym_fil[]" type="file" id="con_ima">
				</div>
				<span class="aym_add_item"></span>
			</div>
			<hr>
		   	<div class="aym_wrap_checkbox">
				<div class="aym_frm_checkbox">
					<label for="pag_pub">Publicar</label>
					<input name="pag_pub" type="checkbox" id="pag_pub" value="1" checked="checked"> 
				</div>
				<div class="aym_frm_checkbox">
					<label for="pag_sho_map">Mostrar en el Mapa</label>
					<input name="pag_sho_map" type="checkbox" id="pag_sho_map" class="aym_check" value="1" checked="checked"> 
				</div>
				<div class="aym_frm_checkbox">
					<label for="pag_hol">Bloquear (No permite que la página sea borrada)</label>
					<input name="pag_hol" type="checkbox" id="pag_hol" class="aym_check" value="1">
				</div>
			</div>
			<div class="aym_small">
				<label for="pag_pos">Orden</label>
				<input class="aym_clean_number" name="pag_pos" type="text" id="pag_pos" size="3" maxlength="3">    
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="I">
			</div>
			<hr>
			<span class="aym_text_required">(*)Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<!-- Recordar que para que funcione el editor llamar scripts y en vez de un div como es en lo originales se debe usar un texarea con el nombre con el que se envia a los controladores -->
<div id="aym_response"></div>
<!-- Espacio para agregar ckeditor con ventana gestor Importante debe existir aym_folder_modal para que funcione -->
<div id="aym_folder_modal"></div>
<script>aym_change();</script>
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_finder/aym_finder_initialize.js"></script>
