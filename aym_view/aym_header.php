<header id="aym_wrap_header">
	<span class="aym_toggle"><span></span></span>
	<figure id="aym_logo">
	<a href="/inicio"><img src="/aym_image/aym_logo/aym_logo.svg" alt="Logo de <?= $_SESSION['con_sit_nam']?>"/></a>
	</figure>
	<div id="aym_wrap_menu">
		<ul class="aym_principal_ul">
			<li class="aym_home_page"><a href="/inicio">Inicio</a></li>
			<li><a href="#aym_about_us_home">Nosotros</a></li>
			<li><a href="#aym_treatment">Tratamientos</a></li>
			<li><a href="#aym_contact_home">Contacto</a></li>
			<!-- <?php 
				# INCLUSION -> DEL MENU DE LA CABECERA
				include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_template/aym_menu/aym_menu_header.php'; 
			?> -->
		</ul>
		<ul class="aym_agenda_ul">
			<li><a href="">Agenda tu cita</a></li>
		</ul>
		<section class="aym_language">
			<select disabled>
				<?php 
					# INCLUSION --> QUE LISTA TODOS LOS LENGUAJES
					include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_common/aym_sql_list_all_language.php';
					while($row_list_language=mysqli_fetch_array($aym_sql_list_all_language)){
				?>
				<option value="<?=$row_list_language['lan_id'];?>"><?=$row_list_language['lan_des'];?></option>
				<?php }mysqli_free_result($aym_sql_list_all_language);			
				?>
			</select>
		</section>
	</div>
</header>