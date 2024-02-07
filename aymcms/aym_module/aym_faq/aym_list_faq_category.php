<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA LISTAR LAS CATEGORIA DE FAQ
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

?>
<div class="aym_wrap_list">
	<div class="aym_wrap_filter">
		<form name="frm_list_faq_category" data-module="faq" data-file="list_faq_category" id="frm_list_faq_category" enctype="multipart/form-data">
			<nav id="aym_show_filter">
				<nav id="aym_show_filter">
				<div>
					<label for="aym_page_size">Mostrar:</label>
					<select name="aym_page_size" id="aym_page_size">
						<option value="25" <?= $_GET['aym_page_size'] == '25'?'selected':'';?> >25 Registros</option>
						<option value="50" <?= $_GET['aym_page_size'] == '50'?'selected':'';?> >50 Registros</option>
						<option value="100" <?= $_GET['aym_page_size'] == '100'?'selected':'';?> >100 Registros</option>
					</select>
				</div>
				</nav>
			<input type="hidden" name="aym_page" id="aym_page" value="<?= $_GET['aym_page']; ?>">
			<input type="hidden" name="aym_order" id="aym_order" value="<?= $_GET['aym_order']; ?>">
			<input type="hidden" name="aym_order_type" id="aym_order_type" value="<?= $_GET['aym_order_type']; ?>">
		</form>
	</div>
	<div id="aym_list_faq_category"></div>
	<div id="aym_list_error"></div>
</div>