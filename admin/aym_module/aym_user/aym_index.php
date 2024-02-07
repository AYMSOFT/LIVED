<?php # **************************** AYMCORE V: 14.0 ********************
# CONTENEDOR PRINCIPAL DEL MODULO DE ADMINISTRACIÓN DE USUARIOS 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022


	# VALIDACION  --> VARIABLES DE CONTROL
	if (!isset($_GET['url_pag'])) { $_GET['url_pag'] = "aym_add_user"; }	
	if (!isset($_GET['option'])) { $_GET['option'] = "admuser"; } 
	if (!isset($_GET['aym_tex_sea'])) { $_GET['aym_tex_sea'] = ''; } # '' SIN FILTRO
	if (!isset($_GET['aym_page_size'])) { $_GET['aym_page_size'] = 25; } # 25 --> NUMERO DE REGISTROS
	if (!isset($_GET['aym_page'])) { $_GET['aym_page'] = 0; } # O --> PAGIA EN LA QUE INICIA
	if (!isset($_GET['aym_order'])) { $_GET['aym_order'] = 1; } # CAMPO POR DEFECTO PARA FILTRAR
	if (!isset($_GET['aym_order_type'])) { $_GET['aym_order_type'] = 0; } # ORDEN: 0=DESCENDENTE; 1=ASCENDETE
	if (!isset($_GET['use_typ_id'])) { $_GET['use_typ_id'] = 0; } # 
	if (!isset($_GET['sta_id'])) { $_GET['sta_id'] = 2; } # 2 TODOS
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
				<li><a href="/admin/<?=$_GET['option'];?>/aym_add_user" class="<?= $_GET['url_pag']=="aym_add_user" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add.png"></figure>Agregar</a></li>
				<li><a href="/admin/<?=$_GET['option'];?>/aym_list_user" class="<?= $_GET['url_pag']=="aym_list_user" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_list.png"></figure>Listar</a></li>
				<li><a href="/admin/<?=$_GET['option'];?>/aym_restore_pass" class="<?= $_GET['url_pag']=="aym_restore_pass" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_restore_pass.png"></figure>Restaurar Contraseña</a></li>
				<?php if ($_GET['url_pag']== "aym_edit_user"){ ?>
					<li><a href="/admin/<?= $_GET['option']?>/aym_edit_user/<?=$_GET['use_id'].'/'.$_GET['sta_id'].'/'.$_GET['use_typ_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>" class="<?= $_GET['url_pag']=="aym_edit_user" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_edit.png"></figure>Editar</a></li>
					<li><a href="/admin/<?=$_GET['option']?>/aym_list_user/<?=$_GET['sta_id'].'/'.$_GET['use_typ_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
				<? }?>
				<?php if ($_GET['url_pag']== "aym_add_profile_user"){ ?>
					<li><a href="/admin/<?=$_GET['option'];?>/aym_add_profile_user/<?=$_GET['use_id'].'/'.$_GET['sta_id'].'/'.$_GET['use_typ_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>" class="<?= $_GET['url_pag']=="aym_add_profile_user" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_add_profile.png"></figure>Asignar Perfiles</a></li>
					<li><a href="/admin/<?=$_GET['option']?>/aym_list_user/<?=$_GET['sta_id'].'/'.$_GET['use_typ_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
					<?php } ?>
					
					<?php if ($_GET['url_pag']== "aym_add_user_dashboard"){ ?>
						<li><a href="/admin/admuser/aym_add_user_dashboard/<?= $_GET['use_id']; ?>" class="<?= $_GET['url_pag']=="aym_add_user_dashboard" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_dashboard.png"></figure>Asignar Dashboard</a></li>
						<li><a href="/admin/<?=$_GET['option']?>/aym_list_user/<?=$_GET['sta_id'].'/'.$_GET['use_typ_id'].'/'.$_GET['aym_order'].'/'.$_GET['aym_order_type'].'/'.$_GET['aym_page_size'].'/'.$_GET['aym_page'];?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_back.png"></figure>Volver</a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>
	<h2>Administrador de Usuarios</h2>
    <?php 
		# PAGINA PARA MOSTRAR PAGINA
		require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_user/'.$_GET['url_pag'].'.php';
	?>
</section>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_component.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_pagination.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_search_list.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_user/aym_user_function.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_validate/aym_user/aym_validate_user.js"></script>