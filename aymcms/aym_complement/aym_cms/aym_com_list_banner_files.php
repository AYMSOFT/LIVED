<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LOS ARCHIVOS EXISTENTES EN LA PAGINA
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 

	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page.php';
	
	if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_cms/'.$row_get_page['pag_id'])){ 
	
	}else if(count(scandir($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_cms/'.$row_get_page['pag_id'])) > 2){ ?>
		<?php $_GET['pag_id'] = $row_get_page['pag_id']; $con=0; ?>
		<?php include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_page_image.php';?>
		<?php while($row_list_page_image = mysqli_fetch_assoc($aym_sql_list_page_image)){ 
			if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_cms/'.$row_get_page['pag_id'].'/'.$row_list_page_image['pag_ima_id'].'.jpg')){
				$file = '/aym_image/aym_cms/'.$row_get_page['pag_id'].'/'.$row_list_page_image['pag_ima_id'].'.png';
			}else{
				$file = '/aym_image/aym_cms/'.$row_get_page['pag_id'].'/'.$row_list_page_image['pag_ima_id'].'.jpg';
			}
		?>
			<div class="aym_frm_images">
				<div>
					<div class="aym_frm_row filled">
						<label>Descripción</label>
						<input type="text" value="<?= $row_list_page_image['pag_ima_des']?>" disabled readonly>
					</div>
					<div>
						<figure class="con_ima_thumb">
							<img id="aym_load_image" title="<?=$row_list_page_image['pag_ima_des']?>" src="<?= $file ?>" url="<?= $file ?>" align="Ver Imágen" border="0">
						</figure>
					</div>
				</div>
				<span class="aym_delete_item" data-id="<?= $row_list_page_image['pag_ima_id']?>" data-pag="<?=$row_get_page['pag_id']?>"></span>
				<span class="aym_edit_item" data-id="<?= $row_list_page_image['pag_ima_id']?>" data-pag="<?=$row_get_page['pag_id']?>"></span>
			</div>
		<?php $con++;}mysqli_free_result($aym_sql_list_page_image); ?>
<?php }else{ ?>    
		<span class="aym_help">No se encontró un Banner</span>
<?php } ?>