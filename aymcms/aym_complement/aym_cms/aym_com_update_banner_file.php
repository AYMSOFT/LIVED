<?php # **************************** AYMCMS V: 7.0 ********************
# MÓDULO PARA ACTUALIZAR LOS ARCHIVOS DE BANNERS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start();

	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page_image.php';
	$type = ["pdf"=>1, "png"=>2, "jpg"=>2, "jpeg"=>2, "gif"=>2, "doc"=>3, "docx"=>3, "xls"=>3, "xlsx"=>3, "ppt"=>3, "pptx"=>3]; 

	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_url/aym_fun_url.php';

?>
<link rel="stylesheet" href="/admin/aym_css/aym_common/aym_style_edit_file.css">
<div class="aym_layer">
	<div class="aym_wrap_form aym_shadow aym_w_box">
		<h3 class="aym_popup_title">EDITAR BANNER</h3>
		<form type="post" enctype="multipart/form-data" id="aym_send_banner_file">
			<fieldset>
				<div class="filled">
					<label class="pag_ima_des">Descripción de Banner</label>			
					<input type="text" class="pag_ima_des" id="pag_ima_des" value="<?=$row_get_page_image['pag_ima_des']?>" name="pag_ima_des[]" placeholder="">
				</div>
				<div class="aym_frm_row">
					<input type="file" name="aym_fil[]">
					<?php 
						$typ = $row_get_page_image['pag_ima_ext'];
						$ext = ".".$typ;
						$link = '/aymcms/showfiledocument/'.$type[$typ].'/'.$row_get_page_image['pag_ima_id'];
						$on_click = 'onclick="window.open(\''.$link.'\',\'_blank\')\"';					
						$icon = $file_icon[$row_get_page_image['pag_ima_ext']];	
					?>
					<input type="hidden" name="pag_ima_id[]" value="<?=$row_get_page_image['pag_ima_id']?>">
					<?/*<p class="aym_file_element">
						<a href="<?=stripslashes($link)?>" target="_blank">
							<?= urls_amigable($row_list_exhibitor_file_type['pag_ima_typ_des']).$ext ?>
						</a>
					</p>*/?>
				</div>
				<div id="aym_popup_msg"></div>
				<div id="aym_popup_progress">
					<progress id="aym_popup_progress" value="0" max="100" data-value="0"></progress>
				</div>
				<div class="aym_frm_submit">
					<input type="hidden" name="action" value="UFB">
					<input type="hidden" name="pag_id" value="<?=$_GET['pag_id']?>">
					<input type="hidden" name="pag_ima_id" value="<?=$row_get_page_image['pag_ima_id']?>">
					<button id="aym_pop_accept" type="submit" class="aym_blue_button">Aceptar</button>
					<button type="button" id="aym_cancel_update_policy">Cancelar</button>
				</div>			
			</fieldset>
		</form>
	</div>
</div>	