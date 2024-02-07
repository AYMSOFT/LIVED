<?php # **************************** AYMCORE V: 1.0 ********************
# CONTENEDOR PRINCIPAL DEL MODULO DE USUARIOS 
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017 

	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['url_pag'])) { $_GET['url_pag'] = "aym_add_gallery_category"; }	
	if (!isset($_GET['option'])) { $_GET['option'] = "admgallery"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['gal_cat_id'])) { $_GET['gal_cat_id'] = 1; }
	if (!isset($_GET['gal_sub_cat_id'])) { $_GET['gal_sub_cat_id'] = 1; }
	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPAÑOL 
?>
<section id="aym_wrap_page">
	<div class="aym_wrap_menu">
		<figure class="aym_toggle nine">
			<span></span>
			<span></span>
			<span></span>
		</figure>
		<nav class="aym_effects aym_fadein_down"> 				
			<ul>
				<li><a href="/aymcms/<?=$_GET['option']?>/aym_add_gallery_category" class="<?= $_GET['url_pag']=="aym_add_gallery_category" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>Galería</a></li>
				<li><a href="/aymcms/<?=$_GET['option']?>/aym_list_gallery_category" class="<?= $_GET['url_pag']=="aym_list_gallery_category" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Galería</a></li>
				<li><a href="/aymcms/<?=$_GET['option']?>/aym_add_gallery_subcategory" class="<?= $_GET['url_pag']=="aym_add_gallery_subcategory" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>Álbum</a></li>
				<li><a href="/aymcms/<?=$_GET['option']?>/aym_list_gallery_subcategory" class="<?= $_GET['url_pag']=="aym_list_gallery_subcategory" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Álbum</a></li>
				<li><a href="/aymcms/<?=$_GET['option']?>/aym_add_gallery_image" class="<?= $_GET['url_pag']=="aym_add_gallery_image" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>Fotos</a></li>
				<li><a href="/aymcms/<?=$_GET['option']?>/aym_list_gallery_image" class="<?= $_GET['url_pag']=="aym_list_gallery_image" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Fotos</a></li>
				<?php if ($_GET['url_pag']== "aym_edit_gallery_image"){ ?>
					<li><a href="/aymcms/<?=$_GET['option']?>/aym_edit_gallery_image/<?=$_GET['gal_id'].'/'.$_GET['lan_id'].'/'.$_GET['gal_cat_id'].'/'.$_GET['gal_sub_cat_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>" class="active"><figure><img src="/admin/aym_image/aym_icon/aym_ico_edit.png" /></figure>Editar</a></li>
					<li><a href="/aymcms/<?=$_GET['option']?>/aym_list_gallery_image/<?=$_GET['lan_id'].'/'.$_GET['gal_cat_id'].'/'.$_GET['gal_sub_cat_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png" /></figure>Volver</a></li>
				<?php } ?>
			</ul>
		</nav>					
	</div>
	<h2>Administrador de Galería</h2>
	<?php 
		# PAGINA PARA MOSTRAR PAGINA
		require $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_gallery/'.$_GET['url_pag'].'.php';
	?>
</section>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_component.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_pagination.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_search_list.js"></script>
<!-- Script modulo-->
<script type="text/javascript" src="/aymcms/aym_js/aym_gallery/aym_gallery_function.js"></script>
<!-- Script validaciones -->
<script type="text/javascript" src="/aymcms/aym_js/aym_validate/aym_gallery/aym_validate_gallery.js"></script>
