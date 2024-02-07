<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDULO PARA LISTAR LOS PERFILES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	session_start();
?>
<div class="aym_wrap_list">
	<div class="aym_wrap_filter">
		<form name="frm_list_profile" data-module="profile" data-file="list_profile" id="frm_list_profile" enctype="multipart/form-data">
			<div class="aym_toggle filter"><?php #INCLUSIÓN ---> FILTROS RESPONSIVE ?></div>
			<nav id="aym_show_filter">
				<div class="aym_frm_row">
					<div class="aym_search">
						<input name="aym_tex_sea" data-module="profile" id="aym_tex_sea" class="aym_frm_search" autocomplete="off" type="text" placeholder="Buscar">
						<div id="aym_search_results"></div>            
					</div>
				</div>
				<div>
					<label for="aym_page_size">Mostrar:</label>
					<select name="aym_page_size" id="aym_page_size">
						<option value="25" <?=$_GET['aym_page_size'] == '25'?'selected':'';?> >25 Registros</option>
						<option value="50" <?=$_GET['aym_page_size'] == '50'?'selected':'';?> >50 Registros</option>
						<option value="100" <?=$_GET['aym_page_size'] == '100'?'selected':'';?> >100 Registros</option>
					</select>
				</div>
			</nav>
			<input type="hidden" name="option"  id="option" value="<?= $_GET['option'];?>">
			<input type="hidden" name="aym_page" id="aym_page" value="<?= $_GET['aym_page'];?>">
			<input type="hidden" name="aym_order" id="aym_order"  value="<?= $_GET['aym_order']; ?>">
			<input type="hidden" name="aym_order_type" id="aym_order_type"  value="<?= $_GET['aym_order_type']; ?>">
		</form>
	</div>
	<div id="aym_list_profile"></div>
	<div id="aym_list_error"></div>
</div>