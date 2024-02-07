<?php # **************************** AYMCORE V: 14.0 ********************
# CONTENEDOR PRINCIPAL DEL MODULO DE AYUDA
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
?>
<section id="aym_wrap_page">
	<div class="aym_wrap_menu">
		<nav> 
			<ul>
				<li><a href="/admin/help" class="<?= $_GET['url_pag']=="aym_help" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_help_manual.png"/></figure>Ayuda</a></li>
				<li><a href="/admin/feedback" class="<?= $_GET['url_pag']=="aym_feedback" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_send_error.png"/></figure>Feedback</a></li>
			</ul>
		</nav>
	</div>
    <?php 
		# CARGAR LA EL MODULO CORRESPONDIENTE 
		require $_SERVER['DOCUMENT_ROOT']."/admin/aym_module/aym_help/".$_GET['url_pag'].".php";
	?>	
</section>