<?php # **************************** AYMCMS V: 7.0 ********************
# COMPONENTE PARA LISTAR LOS PRODUCTOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	session_start();

	# VALIDACION  --> VARIABLES DE CONTROL
	if(!isset($_GET['aym_page_size'])){ $_GET['aym_page_size'] = 4;} # NUMERO DE PRODUCTOS A MOSTRAR 
	if(!isset($_GET['aym_page'])){$_GET['aym_page'] = 0;} # O --> PÁGINA EN LA QUE INICIA 

	#VARIABLES
	$aym_show_page = ($_GET['aym_page'] * $_GET['aym_page_size']);

		
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPANOL
	if (!isset($_GET['gal_cat_id'])) { $_GET['gal_cat_id'] = 1; } # INCLUSIÓN --> PROCEDIMIENTO OBTIENE LA PRIMERA CATEGORIA
	if (!isset($_GET['gal_sub_cat_id'])){ $_GET['gal_sub_cat_id'] = 1; }# INCLUSIÓN --> PROCEDIMIENTO OBTIENE LA PRIMERA SUBCATEGORIA
	if(!isset($_GET['action'])){$_GET['action'] = 'N';} # ACTION NORMAL 
	if(!isset($_GET['aym_row_count'])){$_GET['aym_row_count'] = 0;} # ACTION NORMAL 
	$row_count = $_GET['aym_row_count'];

	# INCLUSIÓN --> LISTA DE IMAGE
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_gallery/aym_sql_list_gallery_image_out.php';

	if($num_rows > 0){

		while ($row_list_gallery_image = mysqli_fetch_assoc($aym_sql_get_list_image)) { $row_count++ 
?>
			<a class='aym_item_gallery aym_slides' onclick="openModal();currentSlide(<?= $row_count?>)" data-count="<?= $row_count?>" onclick="openModal();currentSlide(4)">
				<img src="/aym_image/aym_gallery/<?= $row_list_gallery_image['gal_id']; ?>.jpg" alt="<?= $row_list_gallery_image['gal_tit']; ?>" title="<?php echo $row_list_gallery_image['gal_tit']; ?>"/>
			</a>
		<?php } mysqli_free_result($aym_sql_get_list_image);
	}else{
		if($_GET['action'] == 'F'){
?>  
	<section class="aym_no_gallery">
		<h2>En este momento no hay imagenes disponibles.</h2>
		<p>Por favor realize otra busqueda.</p>
		</section>
	<?php } 
	}
?>