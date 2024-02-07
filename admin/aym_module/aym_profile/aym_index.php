<?php # **************************** AYMCORE V: 14.0 ********************
# CONTENEDOR PRINCIPAL DEL MODULO DE ADMINISTRACIÓN DE PERFILES 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022


	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['url_pag'])) { $_GET['url_pag'] = "aym_add_profile"; }	
	if (!isset($_GET['option'])) { $_GET['option'] = "admprofile"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' SIN FILTRO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 1; } # CAMPO POR DEFECTO PARA FILTRAR
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 0; } # ORDEN: 0=DESCENDENTE; 1=ASCENDETE

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
				<li><a href="/admin/<?=$_GET['option'];?>/aym_add_profile" class="<?= $_GET['url_pag']=="aym_add_profile" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png" /></figure>Agregar</a></li>
				<li><a href="/admin/<?=$_GET['option'];?>/aym_list_profile" class="<?= $_GET['url_pag']=="aym_list_profile" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Listar</a></li>
				<?php if ($_GET['url_pag']== "aym_edit_profile"){ ?>
					<li><a href="/admin/<?=$_GET['option'];?>/aym_edit_profile/<?=$_GET['pro_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>" class="<?= $_GET['url_pag']=="aym_edit_profile" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_edit.png"></figure>Editar</a></li>
					<li><a href="/admin/<?=$_GET['option'];?>/aym_list_profile/<?=$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
				<?php } ?>
				<?php if ($_GET['url_pag']== "aym_add_function_profile"){ ?>
					<li><a href="/admin/admprofilefunction/aym_add_function_profile/<?= $_GET['pro_id']; ?>" class="<?= $_GET['url_pag']=="aym_add_function_profile" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_add_function.png"></figure>Asignar Funciones</a></li>
					<li><a href="/admin/<?=$_GET['option'];?>/aym_list_profile/<?=$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
      			<?php } ?>
			</ul>
		</nav>
	</div>
	<h2>Administrador de Perfiles</h2>
    <?php
		# PAGINA PARA MOSTRAR PAGINA
		require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_profile/'.$_GET['url_pag'].'.php';
	?>
</section>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_component.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_pagination.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_search_list.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_profile/aym_profile_function.js"></script>
<script src="/admin/aym_js/aym_validate/aym_profile/aym_validate_profile.js"></script>