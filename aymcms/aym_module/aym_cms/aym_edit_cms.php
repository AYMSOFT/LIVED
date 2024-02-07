<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA EDITAR UNA PAGINA
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSIÓN --> COMPONENTE QUE LISTA LOS DETALLES DE L PAGINA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page.php';
	
	$_GET['lan_id']= $row_get_page['lan_id'];
	$_GET['pag_cat_id']= $row_get_page['pag_cat_id'];
	
	# INCLUSIÓN --> COMPONENTE QUE LISTA LOS IDIOMAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
	
	# INCLUSIÓN --> COMPONENTE QUE CARGA CATEGORIAS DE LAS PAGINAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_all_page_category.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS PAGINAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_subpage.php';
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_page_menu.php';
	
?>
<div class="aym_wrap_form">
	<form action="/aymcms/actioncms" method="post" name="frm_edit_page" id="frm_edit_page" autocomplete="off" enctype="multipart/form-data" >
		<fieldset class="aym_frm_content">
			<div>
				<label for="lan_id">Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php while ($row_list_language = mysqli_fetch_assoc($aym_sql_list_all_language)) { ?>
						<option value="<?= $row_list_language['lan_id']?>" <?= $row_list_language['lan_id'] == $row_get_page['lan_id'] ? 'selected' : ''?> ><?= $row_list_language['lan_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_language); ?>
				</select>
			</div>

			<div>
				<label for="pag_cat_id">Categoría</label>
				<select name="pag_cat_id" id="pag_cat_id">					
					<?php while ($row_list_all_page_category = mysqli_fetch_assoc($aym_sql_list_all_page_category)) { ?>
						<option value="<?= $row_list_all_page_category['pag_cat_id']?>" <?= $row_list_all_page_category['pag_cat_id'] == $row_get_page['pag_cat_id'] ? 'selected' : ''?> ><?= $row_list_all_page_category['pag_cat_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_page_category); ?>
				</select>
			</div>

			<div>
				<label for="pag_sub_id">Página</label>
				<select name="pag_sub_id" id="pag_sub_id">
					<option value="0">[ PÁGINA PRINCIPAL ]</option>
					<?php while ($row_list_subpage = mysqli_fetch_assoc($aym_sql_list_subpage)) { ?>
						<option value="<?= $row_list_subpage['pag_id']?>" <?= $row_list_subpage['pag_id'] == $row_get_page['pag_sub_id'] ? 'selected' : ''?> ><?= $row_list_subpage['pag_tit']?></option>
					<?php } mysqli_free_result($aym_sql_list_subpage); ?>
				</select>
			</div>

			<div>
				<label for="pag_tem">Plantilla</label>
				<select name="pag_tem" id="pag_tem">
					<?php
						$_GET['pag_tem'] = $row_get_page['pag_tem'];
						# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS
						include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_complement/aym_cms/aym_com_list_page_templates.php';
					?>
				</select>  
			</div>
			<h3>Mostrar en:</h3>
			<div id="aym_men_wrp" class="aym_wrap_checkbox">
				<?php 
					if ($aym_num_rows < 1) {echo '<span class="aym_help">No se encontraron opciones para este idioma</span> ';}else{

						# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS
						include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_page_page_menu.php';

						$array = array();
						
						while($aym_row_page_menu = mysqli_fetch_assoc($aym_sql_list_page_menu)){
							if($aym_row_page_menu['aym_check'] > 0){
								array_push($array, $aym_row_page_menu['pag_men_id']);
							}
						}mysqli_free_result($aym_sql_list_page_menu);

						while($row_get_list_all_page_menu = mysqli_fetch_assoc($aym_sql_list_all_page_menu)){ ?>
							<div class="aym_frm_checkbox">
								<label for="aym_pag_men_chk_[<?= $row_get_list_all_page_menu['pag_men_id']?>]"><?= $row_get_list_all_page_menu['pag_men_nam']?></label>
								<input <?php if(in_array($row_get_list_all_page_menu['pag_men_id'], $array)){ echo 'checked'; }?> type="checkbox" name="aym_pag_men_chk_[<?= $row_get_list_all_page_menu['pag_men_id']?>]" id="aym_pag_men_chk_[<?= $row_get_list_all_page_menu['pag_men_id']?>]" value="<?= $row_get_list_all_page_menu['pag_men_id']?>" > 
							</div>
						<?php } mysqli_free_result($aym_sql_list_all_page_menu);
					}
				?>
			</div>

			<div>
			   <label for="pag_tit">Título</label>
			  <input name="pag_tit" type="text" id="pag_tit" value="<?= $row_get_page['pag_tit'] ?>">
			</div>

			<div>
				<label for="pag_des">Descripción</label>
				<input name="pag_des" type="text" id="pag_des" value="<?= $row_get_page['pag_des'] ?>">   
			</div>
			<h3 for="pag_des">Contenido:</h3>
			<div class="aym_frm_full">

				<div class="aym_ckeditor_toolbar">
					<div class="document-editor__toolbar"></div>
				</div>

				<div class="aym_ckeditor_editor">
					<textarea name="pag_con" id="editor" data-id="pag_con">
							<?= $row_get_page['pag_con']  ?>
					</textarea>
				</div>

			</div>

			<div class="aym_frm_date">
				<div>
					<label for="pag_url">URL</label>
					<input type="text" id="pag_url" name="pag_url" value="<?= $row_get_page['pag_url'] ?>">
				</div>

				<div>
					<label for="pag_tar">Target</label>
					<select name="pag_tar" id="pag_tar">
						<option value="_self" <?php if($row_get_page['pag_tar'] == "_self"){ echo 'selected'; }?>>Misma Ventana</option>
						<option value="_blank" <?php if($row_get_page['pag_tar'] == "_blank"){ echo 'selected'; }?>>Nueva Ventana</option>
					</select>
				</div>
			</div>
			<div id="aym_table_files" class="aym_hidden"></div>
			<h3>Banners:</h3>
			<div class="aym_frm_images">
				<div> 
					<div class="aym_frm_row">
						<label>Descripción de imagen</label>
						<input type="text" name="pag_ima_des[]" id="pag_ima_des">
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
					<input name="pag_pub" type="checkbox" id="pag_pub" value="1" <?php if($row_get_page['pag_pub'] > 0){ echo 'checked'; } ?>>  
				</div>

				<div class="aym_frm_checkbox">
					<label for="pag_sho_map">Mostrar en el Mapa</label>
					<input name="pag_sho_map" type="checkbox" id="pag_sho_map" value="1" <?php if($row_get_page['pag_sho_map'] > 0){ echo 'checked'; } ?>>
				</div>

				<div class="aym_frm_checkbox">
					<label for="pag_hol">Bloquear (No permite que la página sea borrada)</label>
					<input name="pag_hol" type="checkbox" id="pag_hol" value="1" <?php if($row_get_page['pag_hol'] > 0){ echo 'checked'; } ?>>
				</div>
			</div>
			<div class="aym_small">
				<label for="pag_pos">Orden</label>
				<input name="pag_pos" type="text"  id="pag_pos" value="<?= $row_get_page['pag_pos'] ?>" onkeypress="return teclado(event)" size="3" maxlength="3"> 
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar" class="val_edit_page"> 
				<input name="action" type="hidden" id="action" value="U" > 
				<input name="aym_return_files" type="hidden" id="aym_return_files"> 
				<input name="pag_id" type="hidden" id="pag_id" value="<?= $_GET['pag_id']; ?>" >
			</div>
			<hr>
			<span class="aym_text_required">(*)Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<div id="aym_response"></div>
<script type="text/javascript" src="/aymcms/aym_js/aym_cms/aym_cms_update_file.js"></script>
<script>$(function(){$('#aym_return_files').change();aym_change();});</script>
<!-- Recordar que para que funcione el editor llamar scripts y en vez de un div como es en lo originales se debe usar un texarea con el nombre con el que se envia a los controladores -->
<!-- Espacio para agregar ckeditor con ventana gestor Importante debe existir aym_folder_modal para que funcione -->
<div id="aym_folder_modal"></div>
<script>aym_change();</script>
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_finder/aym_finder_initialize.js"></script>





