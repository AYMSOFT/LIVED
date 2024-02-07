<?php # **************************** AYMCMS V: 7.0 ********************
# CONTENEDOR PRINCIPAL DE CORREOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
	
	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['url_pag'])) { $_GET['url_pag'] = "aym_find_list_mail"; }	
	if (!isset($_GET['option'])) { $_GET['option'] = "admlistmail"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' --> FILTRO LIMPIO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 0; } # 0 --> CAMPO ORDEN
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 1; } # 1 --> TIPO ORDER

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
				<li><a href="/aymcms/<?=$_GET['option']?>/aym_find_list_mail" class="<?= $_GET['url_pag']=="aym_find_list_mail" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_search.png"></figure>Buscar</a></li>
				<?php if ($_GET['url_pag']== "aym_list_mail"){ ?>
					<li><a class="<?= $_GET['url_pag']=="aym_list_mail" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Listado de correos</a></li>
					<li><a href="/aymcms/exportlistmail"><figure><img src="/admin/aym_image/aym_icon/aym_ico_export.png"></figure>Exportar</a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>
   	<h2>Administrador de Correos</h2>
    <?php 
		# PAGINA PARA MOSTRAR PAGINA
		require $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_list_mail/'.$_GET['url_pag'].'.php';
	?>
</section>

<script type="text/javascript" src="/admin/aym_js/aym_common/aym_component.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_pagination.js"></script>
<script type="text/javascript" src="/aymcms/aym_js/aym_common/aym_search_list.js"></script>
<!-- Script modulo-->
<script type="text/javascript" src="/aymcms/aym_js/aym_list_mail/aym_list_mail_function.js"></script>
