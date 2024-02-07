<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA MOSTRAR LOS MENUS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 
	
	# INCLUSIÓN --> PROCEDIMIENTO QUE LISTA LAS CATEGORIAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_page_menu.php';

	if ($aym_num_rows < 1) {
		echo '<span class="aym_help">No se encontraron opciones para este idioma</span> ';
	}else{
		while($row_get_list_all_page_menu = mysqli_fetch_assoc($aym_sql_list_all_page_menu)){ 
?>

			<div class="aym_frm_checkbox">
				<label for="aym_pag_men_chk_[<?= $row_get_list_all_page_menu['pag_men_id']?>]"><?= $row_get_list_all_page_menu['pag_men_nam']?></label>
				<input type="checkbox" name="aym_pag_men_chk_[<?= $row_get_list_all_page_menu['pag_men_id']?>]" id="aym_pag_men_chk_[<?= $row_get_list_all_page_menu['pag_men_id']?>]" value="<?= $row_get_list_all_page_menu['pag_men_id']?>" > 
			</div>

<?php 
		}mysqli_free_result($aym_sql_list_all_page_menu); 
	} 
?>