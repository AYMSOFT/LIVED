<?php # **************************** AYMSITE V: 5.0 ********************
# FORMULARIO PARA LISTAR LAS CATEGORIAS DE NOTICIAS 
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	# INCLUSIÓN --> PROCEDIEMINTO QUE LISTA LOS IDIOMAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';

?>
<div class="aym_wrap_list">
	<div class="aym_wrap_filter">
		<form name="frm_list_page" data-module="news" data-file="list_news_category" id="frm_list_news_category" enctype="multipart/form-data">
			<div class="aym_toggle filter"><?php #INCLUSIÓN ---> FILTROS RESPONSIVE ?></div>
			<nav id="aym_show_filter">
				<div>
					<label for="lan_id">Idioma</label><select name="lan_id" id="lan_id" class="aym_select"><?php while ($row_list_all_language = mysqli_fetch_array($aym_sql_list_all_language)) {if ($row_list_all_language['lan_id'] == $_GET['lan_id']) {echo '<option value="'.$row_list_all_language['lan_id'].'" selected="selected">'.$row_list_all_language['lan_nam'].'</option>';} else {echo '<option value="'.$row_list_all_language['lan_id'].'">'.$row_list_all_language['lan_nam'].'</option>';}} ?></select>
				</div>
				<div>
					<label for="aym_page_size">Mostrar:</label>
					<select name="aym_page_size" id="aym_page_size">
						<option value="25" <?php if ($_GET['aym_page_size'] == '25') { echo 'selected="selected"'; } ?>>25 Registros</option>
						<option value="50" <?php if ($_GET['aym_page_size'] == '50') { echo 'selected="selected"'; } ?>>50 Registros</option>
						<option value="100" <?php if ($_GET['aym_page_size'] == '100') { echo 'selected="selected"'; } ?>>100 Registros</option>
					</select>
				</div>
			</nav>
			<input type="hidden" name="aym_page" id="aym_page" value="<?= $_GET['aym_page']; ?>">
			<input type="hidden" name="aym_order" id="aym_order" value="<?= $_GET['aym_order']; ?>">
			<input type="hidden" name="aym_order_type" id="aym_order_type" value="<?= $_GET['aym_order_type']; ?>">
		</form>
	</div>
	<div id="aym_list_news_category"></div>
	<div id="aym_list_error"></div>
</div>