<?php # **************************** AYMCMS V: 7.0 ********************
# CONTENEDOR PRINCIPAL DEL MODULO DE ADMINISTRACIÓN DE CONTENIDOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['url_pag'])) { $_GET['url_pag'] = "aym_add_cms"; }	
	if (!isset($_GET['option'])) { $_GET['option'] = "admcms"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['pag_cat_id'])) { $_GET['pag_cat_id'] = 1; }
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
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_add_cms" class="<?= $_GET['url_pag']=="aym_add_cms" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>Agregar</a></li>
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_list_cms" class="<?= $_GET['url_pag']=="aym_list_cms" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Listar</a></li>
				<?php if ($_GET['url_pag']== "aym_edit_cms"){ ?>
					<li><a href="/aymcms/<?=$_GET['option']?>/aym_edit_cms/<?=$_GET['pag_id'].'/'.$_GET['pag_cat_id'].'/'.$_GET['lan_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>" class="<?= $_GET['url_pag']=="aym_edit_cms" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_edit.png"></figure>Editar</a></li>
					<li><a href="/aymcms/<?=$_GET['option']?>/aym_list_cms/<?=$_GET['pag_cat_id'].'/'.$_GET['lan_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page']?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
				<? }?>
			</ul>
		</nav>
	</div>
	<h2>Administrador de Contenidos</h2>
    <?php 
		# PAGINA PARA MOSTRAR PAGINA
		require $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_cms/'.$_GET['url_pag'].'.php';
	?>
</section>

<script type="text/javascript" src="/admin/aym_js/aym_common/aym_component.js"></script>  
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_pagination.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_search_list.js"></script>
<!-- Script modulo-->
<script type="text/javascript" src="/aymcms/aym_js/aym_cms/aym_cms_function.js"></script>
<!-- Script validaciones -->
<script type="text/javascript" src="/aymcms/aym_js/aym_validate/aym_cms/aym_validate_cms.js"></script>

