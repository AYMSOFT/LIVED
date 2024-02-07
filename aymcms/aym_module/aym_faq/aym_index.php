<?php # **************************** AYMCMS V: 7.0  ********************
# CONTENEDOR PRINCIPAL DE PREGUNTAS FRECUENTES
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['url_pag'])) { $_GET['url_pag'] = "aym_add_faq"; }	
	if (!isset($_GET['option'])) { $_GET['option'] = "admfaq"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER
	if (!isset($_GET['faq_cat_id'])) { $_GET['faq_cat_id'] = 0; } # 0 --> TIPO ORDER

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
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_add_faq_category" class="<?= $_GET['url_pag']=="aym_add_faq_category" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>Categoria</a></li>
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_list_faq_category" class="<?= $_GET['url_pag']=="aym_list_faq_category" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Categoria</a></li>
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_add_faq" class="<?= $_GET['url_pag']=="aym_add_faq" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>FAQ</a></li>
				<li><a href="/aymcms/<?=$_GET['option'];?>/aym_list_faq" class="<?= $_GET['url_pag']=="aym_list_faq" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>FAQ</a></li>
				<?php if($_GET['url_pag']=="aym_edit_faq"){?>
					<li><a href="/aymcms/<?=$_GET['option'];?>/aym_edit_faq/<?=$_GET['faq_id'].'/'.$_GET['faq_cat_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>" class="active"><figure><img src="/admin/aym_image/aym_icon/aym_ico_edit.png"></figure>Editar</a></li>
					<li><a href="/aymcms/<?=$_GET['option'];?>/aym_list_faq/<?=$_GET['faq_cat_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
				<?php }?>
			</ul>
		</nav>
	</div>
   	<h2>Administrador de Preguntas Frecuentes</h2>
    <?php 
		# PAGINA PARA MOSTRAR PAGINA
		require $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_faq/'.$_GET['url_pag'].'.php';
	?>
</section>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_component.js"></script>  
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_pagination.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_search_list.js"></script>
<!-- Script modulo-->
<script type="text/javascript" src="/aymcms/aym_js/aym_faq/aym_faq_function.js"></script>
<!-- Script validaciones -->
<script type="text/javascript" src="/aymcms/aym_js/aym_validate/aym_faq/aym_validate_faq.js"></script>