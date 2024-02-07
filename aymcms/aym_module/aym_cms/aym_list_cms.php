<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA LISTAR LAS PAGINAS DE CONTENIDOS 
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	# INCLUSIÓN --> PROCEDIEMINTO QUE LISTA LOS IDIOMAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';

	# INCLUSIÓN --> COMPONENTE QUE CARGA CATEGORIAS DE LOS CONTENIDOS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_all_page_category.php';
	
?>
<div class="aym_wrap_list">
	<div class="aym_wrap_filter">
		<form name="frm_list_page" data-module="cms" data-file="list_page" id="frm_list_page" enctype="multipart/form-data">
			<div class="aym_toggle filter"><?php #INCLUSIÓN ---> FILTROS RESPONSIVE ?></div>
			<nav id="aym_show_filter">
				<div class="aym_frm_row">
					<div class="aym_search">
						<input name="aym_tex_sea" data-module="cms" id="aym_tex_sea" class="aym_frm_search" autocomplete="off" type="text" placeholder="Buscar">
						<div id="aym_search_results"></div>            
					</div>
				</div>
				<div>
					<label for="lan_id">Idioma</label>
					<select name="lan_id" id="lan_id" class="aym_select">
						<?php while ($row_list_language = mysqli_fetch_array($aym_sql_list_all_language)) { ?>
							<option value="<?= $row_list_language['lan_id'] ?>" <?= $row_list_language['lan_id'] == $_GET['lan_id'] ? 'selected' : ''?>><?= $row_list_language['lan_nam'] ?></option>
						<?php }mysqli_free_result($aym_sql_list_all_language); ?>
					</select>
				</div>
				<div>
					<label for="pag_cat_id">Categoría</label>
					<select name="pag_cat_id" id="pag_cat_id" class="aym_select">
						<?php while ($row_list_all_page_category = mysqli_fetch_assoc($aym_sql_list_all_page_category)) { ?>
							<option value="<?= $row_list_all_page_category['pag_cat_id'] ?>" <?= $row_list_all_page_category['pag_cat_id'] == $_GET['pag_cat_id'] ? 'selected' : ''?> ><?= $row_list_all_page_category['pag_cat_nam'] ?></option>
						<?php }mysqli_free_result($aym_sql_list_all_page_category); ?>
					</select>
				</div>
				<div>
					<label for="aym_page_size">Mostrar</label>
					<select name="aym_page_size" id="aym_page_size" class="aym_select">
						<option value="25" <?=$_GET['aym_page_size'] == '25' ? 'selected="selected"' : ''?>>25 Registros</option>
						<option value="50" <?= $_GET['aym_page_size'] == '50' ? 'selected="selected"' : ''?>>50 Registros</option>
						<option value="100" <?=$_GET['aym_page_size'] == '100' ? 'selected="selected"' : ''?>>100 Registros</option>
					</select>
				</div>
			</nav>
			<input type="hidden" name="option" id="option" value="<?= $_GET['option'];?>" />
			<input type="hidden" name="aym_page" id="aym_page" value="<?= $_GET['aym_page']; ?>">
			<input type="hidden" name="aym_order" id="aym_order" value="<?= $_GET['aym_order']; ?>">
			<input type="hidden" name="aym_order_type" id="aym_order_type" value="<?= $_GET['aym_order_type']; ?>">
		</form>
	</div>
	<div id="aym_list_page"></div>
	<div id="aym_list_error"></div>
</div>