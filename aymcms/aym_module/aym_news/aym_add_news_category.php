<?php # **************************** AYMSITE V: 5.7 ********************
# FORMULARIO PARA AGREGAR CATEGORIAS DE NOTICAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUL/18/2013

	# INCLUSIÓN --> PROCEDIEMINTO QUE LISTA LOS IDIOMAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';

?>
<div class="aym_wrap_form">
	<form action="/aymcms/actionnews" method="post" name="frm_add_news_category" id="frm_add_news_category" enctype="multipart/form-data">
		<fieldset>
			<div>
				<label>Idioma</label>
				<select name="lan_id" id="lan_id">
					<?php while ($row_list_all_language = mysqli_fetch_array($aym_sql_list_all_language)){ ?>
						<option value="<?=$row_list_all_language['lan_id']?>"><?=$row_list_all_language['lan_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_all_language); ?>
				</select>
			</div> 
			<div class="aym_frm_date">
				<div>
					<label class="new_cat_nam">Nombre</label> 
					<input name="new_cat_nam" type="text" id="new_cat_nam" minlength="2"  maxlength="50">
				</div>

				<div>
					<label for="new_cat_des">Descripción</label> 
					<input name="new_cat_des" type="text" id="new_cat_des" minlength="3"  maxlength="100">
				</div>
			</div>
			<div class="aym_small">
				<label for="new_cat_ord">Orden</label>
				<input name="new_cat_ord" type="text" class="aym_clean_number" id="new_cat_ord" value="1" size="4" maxlength="4">
			</div>
			<div class="aym_frm_submit"> 
				  <button type="submit" class="val_add_user">Aceptar</button>
				  <input name="action" type="hidden" id="action" value="IC">
			</div> 
			<hr>
			<span class="aym_text_required">(*)Todos los campos son obligatorios</span>
		</fieldset>
	</form>
<div>