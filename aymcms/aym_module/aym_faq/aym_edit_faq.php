<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA AGREGAR PREGUNTAS FRECUENTES
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSIÓN --> COMPONENTE QUE CARGA CATEGORIAS DE LOS CONTENIDOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_get_faq.php'; 

	# INCLUSION --->  LISTA LAS CATEGORIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_faq/aym_sql_list_all_faq_category.php';

?>
<div class="aym_wrap_form">
	<form action="/aymcms/actionfaq" method="post" name="frm_edit_faq" id="frm_edit_faq" autocomplete="off" enctype="multipart/form-data" >
		<fieldset>
			<div>
				<label for="faq_cat_id" >Categoria:</label>
				<select name="faq_cat_id" id="faq_cat_id">
					<?php while($row_list_faq_category = mysqli_fetch_assoc($aym_sql_list_faq_category)){?>
							<option value="<?= $row_list_faq_category['faq_cat_id']?>" <?= $row_get_faq['faq_cat_id']==$row_list_faq_category['faq_cat_id'] ? 'selected' : ''?> ><?= $row_list_faq_category['faq_cat_nam'];?></option>
					 <?php }mysqli_free_result($aym_sql_list_faq_category); ?>
				</select>
			</div>
			<div>
				<label for="faq_que" >Pregunta:</label> 
				<input type="text" id="faq_que" name="faq_que" value="<?=$row_get_faq['faq_que'];?>"/>
			</div>

			<h3>Respuesta</h3>
			<div class="aym_frm_full medium">
				<div class="aym_ckeditor_toolbar"><div class="document-editor__toolbar"></div></div>
				<div class="aym_ckeditor_editor"><div name="content" id="editor" data-id="faq_ans"><?=$row_get_faq['faq_ans'];?></div></div>
			</div>
			<input type="hidden" name="faq_ans" id="faq_ans"  value='<?=$row_get_faq['faq_ans'];?>'>

			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="U">
				<input name="faq_id" type="hidden" id="faq_id" value="<?= $row_get_faq['faq_id']?>">
			</div>
			<hr>
			<span class="aym_text_required">(*)Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>
<script src="/ckeditor5/build/ckeditor.js"></script>
<script src="/ckfinder8/ckfinder.js"></script>
<script src="/ckeditor5/config.js?<?= time();?>"></script>

