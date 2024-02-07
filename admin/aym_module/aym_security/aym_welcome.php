<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDULO DE BIENVENIDA
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
?>
<section id="aym_wrap_welcome">
	<article>
		<h1>Bienvenido <?= $_SESSION['use_nam']; ?></h1>
		<figure class="aym_logo_inicio">
			<img src="/admin/aym_image/aym_icon/aym_cohete_logo.png" title="aymsoft"/>
		</figure>

		<p class="aym_subtitle">Gracias por utilizar <?= $_SESSION['abo_nam'] ?> <?= date('Y')?>.</p>
		<p>En el menú de la izquierda podrás encontrar todas las opciones de administración del portal.</p>
	</article>
</section>