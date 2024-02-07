<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA LISTAR LAS CATEGORIA DE BANNERS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS TIPOS DE LENGUAGE
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
	
?>
<div class="aym_wrap_list">
	<div class="aym_wrap_filter">
		<form name="frm_list_banner_category" data-module="banner" data-file="list_banner_category" id="frm_list_banner_category" enctype="multipart/form-data">
            <div class="aym_toggle filter"><?php #INCLUSIÓN ---> FILTROS RESPONSIVE ?></div>
			<nav id="aym_show_filter">
                <div>
					<label for="lan_id">Idioma</label>
					<select name="lan_id" id="lan_id">
						<?php while ($row_list_language = mysqli_fetch_array($aym_sql_list_all_language)) { ?>
							<option value="<?= $row_list_language['lan_id'] ?>" <?= $row_list_language['lan_id'] == $_GET['lan_id'] ? 'selected' : ''?>><?= $row_list_language['lan_nam'] ?></option>
						<?php }mysqli_free_result($aym_sql_list_all_language); ?>
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
			<input type="hidden" name="aym_tex_sea" id="aym_tex_sea" value="<?= $_GET['aym_tex_sea']; ?>">
			<input type="hidden" name="aym_page" id="aym_page"  value="<?= $_GET['aym_page']; ?>">
			<input type="hidden" name="aym_order" id="aym_order"  value="<?= $_GET['aym_order']; ?>" />
			<input type="hidden" name="aym_order_type" id="aym_order_type"  value="<?= $_GET['aym_order_type']; ?>" />
		</form>
	</div>
	<div id="aym_list_banner_category"></div>
	<div id="aym_list_error"></div>
</div>