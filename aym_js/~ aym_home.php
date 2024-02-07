<main >
	<section id="aym_wrap_banner">
		<section id="aym_wrap_banner_carousel" class="owl-carousel">
			<?php # VARIABLE
				$_GET['ban_cat_id'] = 1; # CATEGORIA DEL HOME
				# INCLUSION -> QUE OBTIENE LOS BANNERS DEL HOME
				include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_banner/aym_show_banner.php';
			?>
		</section>
		
		<?php if($aym_num_rows > 1){?>
			<div class="aym_wrap_nav">
				<div class="aym_nav aym_prev"><i class="fa-solid fa-chevron-left"></i></div>
				<div class="aym_nav aym_next"><i class="fa-solid fa-chevron-right"></i></div>
			</div>
		<?php } ?>
	</section>
		
	<section id="aym_about_us">
		<?php
		#VARIABLES
		$_GET['pag_id'] = 8; 
		# INCLUSIÓN --> PROCEDIMIENTO TRAE LOS DATOS DE UNA PÁGINA  
		include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page_out.php'; 
		?>
		<?php
		# INCLUSIÓN --> PROCEDIMIENTO TRAE LAS IMÁGENES DE LA PAGINA
		include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_list_page_image.php';
		$row_get_pag_ima = mysqli_fetch_array($aym_sql_list_page_image);mysqli_free_result($aym_sql_list_page_image);
		?>
		<?php 
		# INCLUSIÓN --> PROCEDIMIENTO VALIDA SI EXISTE EN JPG O PNG
		if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/aym_image/aym_cms/'.$row_get_pag['pag_id'].'/'.$row_get_pag_ima['pag_ima_id'].'.jpg')){
				$file = '/aym_image/aym_cms/'.$row_get_pag['pag_id'].'/'.$row_get_pag_ima['pag_ima_id'].'.png';
			}else{
				$file = '/aym_image/aym_cms/'.$row_get_pag['pag_id'].'/'.$row_get_pag_ima['pag_ima_id'].'.jpg';
			}
		?>
		<figure class="aym_about_us_image">
			<!-- MUESTRA LA IMAGEN CON LA URL EN PNG O JPG -->
			<img title="<?=$row_get_pag['pag_tit']?>" src="<?=$file.'?'.time()?>">
		</figure>
		<section class="aym_about_us_text">
			<article class="aym_about_us_title">
				<h2><?=$row_get_pag['pag_tit']?></h2>
			</article>
			<article class="aym_about_us_description">
				<p><?=$row_get_pag['pag_con'];?></p>
			</article>
		</section>
	</section>

	<section id="aym_treatment">
		<article class="aym_treatment_title">
			<h2>Tratamientos Live•D &rarr;</h2>
		</article>
		<section id="aym_carousel_treatment" class="owl-carousel">
			<?php # VARIABLE
				$_GET['pag_cat_id'] = 4; # CATEGORÍA DE LA PAGINA
				# INCLUSION -> QUE OBTIENE LAS PAGINAS DE UNA CATEGORÍA
				include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_cms/aym_show_page_category.php';
			?>
		</section>
		<article class="aym_more_services">
			<a href="#" >
				<span>Ver más servicios</span>
				<button>&rarr;</button>
			</a>
		</article>
	</section> 
	
	<section id="aym_experiences">
		<?php
			# INCLUSIÓN --> TEMPLATE DE EXPERIENCIAS
			include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_template/aym_tem_4/aym_ experiences.php';
		?>
	</section>

	<section id="aym_partners">
		<article class="aym_partners_text">
			<?php
			#VARIABLES
			$_GET['pag_id'] = 13; 
			# INCLUSIÓN --> PROCEDIMIENTO TRAE LOS DATOS DE UNA PÁGINA  
			include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page_out.php'; 
			?>
			<article class="aym_partners_title">
				<h2><?=$row_get_pag['pag_tit']?></h2>
			</article>
			<article class="aym_partners_description">
				<p><?=$row_get_pag['pag_con'];?></p>
			</article>
		</article>
		<section id="aym_carousel_partners" class="owl-carousel">
			<div class="aym_item"><p> Conoce más ↗</p></div>
			<div class="aym_item"><p> Conoce más ↗</p></div>
			<div class="aym_item"><p> Conoce más ↗</p></div>
			<div class="aym_item"><p> Conoce más ↗</p></div>
			<div class="aym_item"><p> LOGO</p></div>
			<div class="aym_item" style="border-right: 2px solid black ;"><p> LOGO</p></div>
		</section>
		<article class="aym_more_partners">
			<a href="#" >
				<span>Ver más aliados</span>
				<button>&rarr;</button>
			</a>
		</article>
	</section>
	
	<section id="aym_find_us">
		<h2>Dónde puedes encontrarnos</h2>
		<table>
			<tr>
				<td>Edificio C13</td>
				<td>Cra. #13-49</td>
			</tr>
			<tr>
				<td>Consultorio 208</td>
				<td>El Poblado, Medellín</td> 
			</tr>
		</table>
		<div class="aym_buttons">
			<a href="#"><button>VER EN GOOGLE MAPS</button></a>
			
			<a href="#"><button>VER EN WAZE</button></a>
			
		</div>
	</section>

	<section id="aym_contact">
		<section class="aym_contact_text">
			<?php
			#VARIABLES
			$_GET['pag_id'] = 2; 
			# INCLUSIÓN --> PROCEDIMIENTO TRAE LOS DATOS DE UNA PÁGINA  
			include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_cms/aym_sql_get_page_out.php'; 
			?>
			<article><?=$row_get_pag['pag_con'];?></article>
		</section>
		<section class="aym_wrap_contact">
			<?php
				# INCLUSIÓN --> MODULO DE CONTACTO
				include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_contact/aym_contact_home.php';
			?>
			<?php if($aym_num_rows > 1){?>
				<div class="aym_wrap_nav">
					<div class="aym_nav aym_next">
						<button type="submit">Siguiente</button>
					</div>
				</div>
			<?php } ?>
		</section>
	</section>


	
</main>