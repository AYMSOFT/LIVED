<?php # **************************** AYMCORE V: 14.0 ********************
# CONTENEDOR PRINCIPAL DE MI CUENTA / CAMBIAR CONTRASEÑA
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
?>
<section id="aym_wrap_page">
	<div class="aym_wrap_menu">
		<nav> 
			<ul>
				<li><a href="/admin/myaccount" class="<?= $_GET['url_pag']=="aym_view_user" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_personal_info.png"></figure> Mi cuenta</a></li>
				<li><a href="/admin/changepass" class="<?= $_GET['url_pag']=="aym_change_pass" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_ico_restore_pass.png"></figure> Cambiar Mi Contraseña</a></li>
			</ul>
		</nav>
	</div>
   	<?php 	
		# CARGAR LA EL MODULO CORRESPONDIENTE 
		require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_user/'.$_GET['url_pag'].'.php';
	?>
</section>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_component.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_pagination.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_common/aym_search_list.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_user/aym_user_function.js"></script>
<script type="text/javascript" src="/admin/aym_js/aym_validate/aym_user/aym_validate_user.js"></script>