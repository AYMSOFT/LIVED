<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA AGREGAR CATEGORIAS DE PREGUNTAS FRECUENTES
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

?>
<div class="aym_wrap_form">
	<form action="/aymcms/actionfaq" method="post" name="frm_add_faq_category" id="frm_add_faq_category" autocomplete="off" enctype="multipart/form-data">
		<fieldset>
			<div>
				<label for="faq_cat_nam" >Nombre:</label>
				<input type="text" id="faq_cat_nam" name="faq_cat_nam"  minlength="2" maxlength="150">
			</div>
			<h3>Descripción</h3>
			<div class="aym_frm_textarea">
				<textarea name="faq_cat_des" id="faq_cat_des" minlength="3" maxlength="255"></textarea>
			</div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input name="action" type="hidden" id="action" value="IC">
			</div>
			<hr>
			<span class="aym_text_required">(*)Todos los campos son obligatorios</span>
		</fieldset>
	</form>
</div>

