<?php # **************************** AYMCMS V: 7.0 ********************
# CONTENEDOR PRINCIPAL DEL FOOTER
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023
?>

<?php /* Boton whatsapp */ ?>
<!-- <a href="https://wa.me/573042589350" target="_blank" class="aym_button_whatsapp"><i class="fa-brands fa-whatsapp"></i></a> -->

<?php /* Boton hacia arriba */ ?>
<div class="scroll-to-top">
    <button>
        <span class="govco-icon"><i class="fa-solid fa-angle-up"></i></span>
    </button>
</div>




<footer id="aym_wrap_footer">
	<div class="aym_footer_info">
		<article id="aym_logo_footer_section">
			<figure id="aym_logo_footer">
				<a href="/inicio">
					<img alt="<?= $_SESSION['con_sit_nam']?>" src="/aym_image/aym_logo/aym_logo.png" id="aym_footer_logo_img">
				</a>
			</figure>
		</article>
		<article class="aym_social_media_">
			<p>Síguenos</p>
			<a class="aym_social_media_ig" href="https://www.instagram.com/prosciencelab/" target="_blank"><img src="/aym_image/aym_social_media/aym_logo_instagram.png" alt="Instagram Logo"></a>
		</article>
		<article class="aym_doctor_name">
			<p>Maria Zuluaga<br>Jose Roldan<br>MDE, CO.</p>
		</article>
		<article class="aym_ubication">
			<p>+304 258 93 50<br>Edificio C13<br>Consultorio 208</p>
		</article>
		<article class="aym_schedules">
			<p>Horarios de atención<br>Lunes a viernes:<br>8:00 A.M. - 12:30 P.M.<br>1:30-6:00P.M.</p>
		</article>
		<article class="aym_subscribe">
			<p>Subscribete<br>a nuestro boletín</p>
			<?php
				# INCLUSIÓN --> FORMULARIO PARA AGREGAR CORREOS AL LISTADO DE BOLETÍN
				include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_list_mail/aym_add_list_mail.php';
			?>
			<a class="aym_social_media" href="https://www.instagram.com/prosciencelab/" target="_blank"><img src="/aym_image/aym_social_media/aym_logo_instagram.png" alt="Instagram Logo"></a>
		</article>
	</div>	
	<summary>
		<p>DIGITAL DENTAL CENTER</p>
		<p>ALL RIGHTS RESERVED <?= date('Y') ?>. DESIGNED AND DEVELOPED BY <a class="aym_principal_color" href="http://www.aymsoft.com" target="_blank">AyMSoft</a></p>
	</summary>
</footer>
