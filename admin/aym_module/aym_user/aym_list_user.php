<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDULO PARA LISTAR LOS USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	session_start();
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LOS TIPOS DE USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_list_all_user_type.php';
?>
<div class="aym_wrap_list">
	<div class="aym_wrap_filter">
		<form name="frm_list_user" data-module="user" data-file="list_user" id="frm_list_user" enctype="multipart/form-data">
			<div class="aym_toggle filter"><?php #INCLUSIÓN ---> FILTROS RESPONSIVE ?></div>
			<nav id="aym_show_filter">
				<div class="aym_frm_row">
					<div class="aym_search">
						<input name="aym_tex_sea" data-module="user" id="aym_tex_sea" class="aym_frm_search" value="<?=$_GET['aym_tex_sea']?>" autocomplete="off" type="text" placeholder="Buscar">
						<div id="aym_search_results"></div>            
					</div>
				</div>
				<div>
					<label for="use_typ">Estado:</label>
					<select name="sta_id" id="sta_id">
						<option value="2" <?=$_GET['sta_id'] == '2'?'selected':'';?> >[--TODO--]</option>
						<option value="1" <?=$_GET['sta_id'] == '1'?'selected':'';?> >ACTIVO</option>
						<option value="0" <?=$_GET['sta_id'] == '0'?'selected':'';?> >INACTIVO</option>
					</select>
				</div>
				<div>
					<label for="use_typ_id">Tipo:</label>
					<select name="use_typ_id" id="use_typ_id">
						<option value="0">[--TODO--]</option>
						<?php while($row_list_user_type = mysqli_fetch_array($aym_sql_list_user_type)){?>
							<option value="<?= $row_list_user_type['use_typ_id']?>" <?=($row_list_user_type['use_typ_id']==$_GET['use_typ_id'])? 'selected' : '' ; ?>><?= $row_list_user_type['use_typ_nam']?></option>
						<?php } mysqli_free_result($aym_sql_list_user_type);?>
					</select>
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
	<div id="aym_list_user"></div>
	<div id="aym_list_error"></div>
</div>