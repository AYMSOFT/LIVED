<?php # **************************** AYM EASY SITE V: 5.0 ********************
# FORMULARIO PARA EDITAR NOTICIAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUL/18/2013 

	
	# COMPONENTE QUE TRAE LOS DATOS DEL NOTICIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_get_news.php';
	
	# VARIABLES 	
	if(!isset($_GET['lan_id'])){$_GET['lan_id']=$row_get_news['lan_id'];}

?> 
<script type="text/javascript" src="/aymcms/aym_js/aym_news/aym_news_function.js"></script>
<div class="aym_wrap_form">
	<form action="/aymcms/actionnews" method="post" name="frm_edit_news" id="frm_edit_news" enctype="multipart/form-data">
		<fieldset>
			<div>
				<label>Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php 
					# INCLUSIÓN --> PROCEDIMIENTO LISTA LOS IDIOMAS
					include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
					while($row_list_all_language = mysqli_fetch_array($aym_sql_list_all_language)){?>
						<option value="<?=$row_list_all_language['lan_id']?>" <?=($row_list_all_language['lan_id']==$row_get_banner['lan_id'])? 'selected' : '' ;?>><?=$row_list_all_language['lan_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_language);?>
				</select>
			</div>
			<div>
				<label>Categoría</label>
				<select name="new_cat_id" id="new_cat_id">
					<?php 
					# INCLUSIÓN --> PROCEDIMIENTO LISTADO DE CATEGORIAS DE BANNER
					include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_news/aym_sql_list_all_news_category.php';
					while ($row_list_new_category = mysqli_fetch_array($aym_sql_list_all_news_category)) { ?>
							<option value="<?= $row_list_new_category['new_cat_id'] ?>" <?= $row_list_new_category['new_cat_id'] == $row_get_news['new_cat_id'] ? 'selected' : ''?>><?= $row_list_new_category['new_cat_nam'] ?></option>
					<?php } mysqli_free_result($aym_sql_list_all_news_category); ?>
				</select>  
			</div>
			<div>
				<label>Titulo</label>
				<input name="new_tit" type="text" id="new_tit" value="<?= $row_get_news['new_tit']; ?>">
			</div>
			<div>
				<label>Lead</label>
				<input name="new_lea" type="text" id="new_lea" value="<?= $row_get_news['new_lea']; ?>">
			</div>
			<h3>Contenido</h3>

			<div class="aym_frm_full">
				<div class="aym_ckeditor_toolbar">
					<div class="document-editor__toolbar"></div>
				</div>

				<div class="aym_ckeditor_editor">
					<div name="content" id="editor" data-id="new_des">
					<?= $row_get_news['new_des']; ?>
					</div>
				</div>
			</div>
			<input type="hidden" name="new_des" id="new_des"  value='	<?= $row_get_news['new_des']; ?>'>			
			<div>
				<label>URL</label>
				<input name="new_url" type="text" id="new_url" value="<?= $row_get_news['new_url']; ?>">
			</div>
			<h3>Imagen Actual:</h3>
			<div class="aym_frm_images">
				<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_news/'.$row_get_news['new_id'].'.png')) {?> 
					<span class="aym_help">No se encontro una Imagen</span>
				<?php }else{?>
					<a id="aym_load_image" url="/aym_image/aym_news/<?= $row_get_news['new_id']?>.png" style="cursor:pointer;">
						<img src="/aym_image/aym_news/<?= $row_get_news['new_id']?>.png" align="Ver Imágen" border="0">
					</a>
				<?php }?>           
			</div>
			<h3>Imagen</h3>
			<div class="aym_frm_images">
				<div>
					<div class="aym_frm_image">
						<figure class="con_ima_thumb"><img src="/admin/aym_image/aym_icon/aym_add_image.png"></figure>
					</div>
					<input class="aym_hidden aym_file" name="doc_nom" type="file" id="con_ima">				
				</div>
			</div>
			<div class="aym_wrap_checkbox">
				<div class="aym_frm_checkbox">
					<label class="new_sta">Publicar</label>
					<input name="new_sta" type="checkbox" id="new_sta" value="1" <?= $row_get_news['new_sta'] <> 0 ? 'checked' : ''?>> 
				</div>
				<div class="aym_frm_checkbox">
					<label class="new_cov">Cover</label>
					<input name="new_cov" type="checkbox" id="new_cov" value="1" <?= $row_get_news['new_cov'] <> 0 ? 'checked' : ''?>> 	
				</div>
			</div>
			<div class="aym_frm_submit"> 
				<button type="submit" class="val_add_user">Aceptar</button>
				<input name="action" type="hidden" id="action" value="U" >
				<input name="new_id" type="hidden" id="new_id" value="<?= $row_get_news['new_id'] ?>" >
				<input name="new_cat_id_aux" type="hidden"  id="new_cat_id_aux" value="<?= $row_get_news['new_cat_id']; ?>">
			</div>
			<hr>
			<span class="aym_text_required">(*)Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<script>$(function(){ aym_change();});</script>
<script src="/ckeditor5/build/ckeditor.js"></script>
<script src="/ckfinder8/ckfinder.js"></script>
<script src="/ckeditor5/config.js?<?= time();?>"></script>

