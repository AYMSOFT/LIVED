<?php # **************************** AYMCMS V: 7.0 ********************
# CONTENEDOR PRINCIPAL DE BANNERS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['url_pag'])) { $_GET['url_pag'] = "aym_list_banner"; }	
	if (!isset($_GET['option'])) { $_GET['option'] = "admbanner"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['ban_cat_id'])) { $_GET['ban_cat_id'] = 1; }
	if (!isset($_GET['lan_id'])) { $_GET['lan_id'] = 1;} # 1 --> IDIOMA ESPAÑOL 

?>
<section id="aym_wrap_page">
	<div class="aym_wrap_menu">
		<figure class="aym_toggle nine">
			<span></span>
			<span></span>
			<span></span>
		</figure>
		<nav>
			<ul>
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_add_banner_category" class="<?= $_GET['url_pag']=="aym_add_banner_category" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>Categoría</a></li>
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_list_banner_category" class="<?= $_GET['url_pag']=="aym_list_banner_category" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Categoría</a></li>
				<?php if ($_GET['url_pag']== "aym_edit_banner_category"){ ?>
					<li><a href="#" class="active"><figure><img src="/admin/aym_image/aym_icon/aym_ico_edit.png" ></figure>Editar Categoría</a></li>
					<li><a href="<?= $_SERVER["HTTP_REFERER"]; ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
				<?php } ?>
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_add_banner" class="<?= $_GET['url_pag']=="aym_add_banner" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>Banner</a></li>
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_list_banner" class="<?= $_GET['url_pag']=="aym_list_banner" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Banner</a></li>
				<?php if ($_GET['url_pag']== "aym_edit_banner"){ ?>
					<li><a href="/aymcms/<?=$_GET['option']?>/aym_edit_banner/<?=$_GET['ban_cat_id'].'/'.$_GET['lan_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>" class="active"><figure><img src="/admin/aym_image/aym_icon/aym_ico_edit.png" ></figure>Editar Banner</a></li>
					<li><a href="/aymcms/<?=$_GET['option']?>/aym_list_banner/<?=$_GET['ban_cat_id'].'/'.$_GET['lan_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
				<?php }?>
			</ul>
		</nav>
	</div>
   <h2>Administrador de Banner</h2>
    <?php 
		# PAGINA PARA MOSTRAR PAGINA
		require $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_banner/'.$_GET['url_pag'].'.php';
	?>
</section>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_component.js"></script>  
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_pagination.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_search_list.js"></script>
<!-- Script modulo-->
<script type="text/javascript" src="/aymcms/aym_js/aym_banner/aym_banner_function.js"></script>
<!-- Script validaciones -->
<script type="text/javascript" src="/aymcms/aym_js/aym_validate/aym_banner/aym_validate_banner.js"></script>

