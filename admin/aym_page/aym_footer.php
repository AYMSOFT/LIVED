<?php # **************************** AYMCORE V: 14.0 ********************
# FOOTER 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
?>
<footer>
	<section id="aym_wrap_footer">
		<figure>
			<img src="/admin/aym_image/aym_logo_white.png" alt="Aymsoft SAS" longdesc="Aymsoft SAS">
		</figure>
		<div class="aym_copy">
			&copy; <?php echo date("Y"); ?>&nbsp; <a href="https://www.aymsoft.com" target="_blank">AyMsoft Desarrollo de Software</a> |
			<a url="/admin/about" class="aym_modal_info">Acerca de <?= $_SESSION['abo_nam']; ?></a> | <a <?php if(!isset($_SESSION['use_id'])){ echo 'class="aym_modal_info" url="/admin/login-help"'; } else { echo 'href="/admin/help"';} ?> >Ayuda</a> | <a url="/admin/terms" class="aym_modal_info">Términos y Condiciones</a>   
		</div>
	</section>
</footer>