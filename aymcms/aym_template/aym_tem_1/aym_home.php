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
		<a href="https://wa.me/573042589350" target="_blank"><img class="aym_ico_whatsapp" src="/aym_image/aym_social_media/aym_wa.png" alt="Ícono de WhatsApp"></a>
	</section>
		
	<section id="aym_about_us_home">
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
		<figure class="aym_about_us_home_image">
			<!-- MUESTRA LA IMAGEN CON LA URL EN PNG O JPG -->
			<img title="<?=$row_get_pag['pag_tit']?>" src="<?=$file.'?'.time()?>">
		</figure>
		<section class="aym_about_us_home_text">
			<article class="aym_about_us_home_title">
				<h2><?=$row_get_pag['pag_tit']?></h2>
			</article>
			<div class="aym_line"></div>
			<article class="aym_about_us_home_description">
				<p><?=$row_get_pag['pag_con'];?></p>
			</article>
		</section>
	</section>

	<section id="aym_treatment">
		<article class="aym_treatment_title">
			<h2>Tratamientos Live•D &rarr;</h2>
			<h2 class="aym_hidden_h2">Tratamientos Live•D</h2>
		</article>
		<section class="aym_wrap">
			<section id="aym_carousel_treatment" class="owl-carousel">
				<?php # VARIABLE
					$_GET['pag_cat_id'] = 4; # CATEGORÍA DE LA PAGINA
					# INCLUSION -> QUE OBTIENE LAS PAGINAS DE UNA CATEGORÍA
					include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_cms/aym_show_page_category.php';
				?>
			</section>
			<?php if($aym_num_rows > 1){?>
				<div class="aym_wrap_nav">
					<div class="aym_nav aym_prev"><img src="/aym_image/aym_images/aym_left_arrow.png" alt=""></div>
					<div class="aym_nav aym_next"><img src="/aym_image/aym_images/aym_right_arrow.png" alt=""></div>
				</div>
			<?php } ?>
		</section>
	</section> 
	
	<section id="aym_experiences">
		<section class="aym_carousel_experiences">
			<div class="aym_line"></div>
			<p class="aym_text">Reviews</p>	
			<p id="aym_count"></p>
			<div id="aym_carousel_experiences" class="owl-carousel">
				<?php # VARIABLE
					$_GET['ban_cat_id'] = 2; # CATEGORÍA DEL HOME
					# INCLUSION -> QUE OBTIENE LOS BANNERS DEL HOME
					include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_module/aym_banner/aym_show_banner_internal.php';
				?>
			</div>
		</section>
		<section class="aym_wrap_text">
			<div class="aym_line"></div>
			<p class="aym_text">DIGITAL DENTAL CENTER</p>	
			<article>
				<h2>People are saying</h2>
			</article>
			<section class="aym_text_experiences">
				<img class="aym_quotes" src="/aym_image/aym_images/aym_quotes.png" alt="Comillas">
				<p class="aym_text_1">Texto 1 predeterminado</p>
				<p class="aym_text_2">Texto 2 predeterminado</p>
			</section>
		</section>
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
			<div class="aym_line"></div>
			<article class="aym_partners_description">
				<p><?=$row_get_pag['pag_con'];?></p>
			</article>
		</article>
		<section id="aym_carousel_partners" class="owl-carousel">
			<div class="aym_item"> 
				<figure>
					<img src="/aym_image/aym_images/aym_img_invisaling.png" alt="" class="aym_img_original">
        			<img src="/aym_image/aym_images/aym_img_invisaling_white.png" alt="" class="aym_img_hover">
				</figure>
				<article>
					<p>Conoce más ↗</p>
				</article> 
			</div>
			<div class="aym_item"> 
				<figure>
					<img src="/aym_image/aym_images/aym_img_gnatus.png" alt="" class="aym_img_original">
        			<img src="/aym_image/aym_images/aym_img_gnatus_white.png" alt="" class="aym_img_hover">
				</figure>
				<article>
					<p>Conoce más ↗</p>
				</article> 
			</div>
			<div class="aym_item"> 
				<figure>
					<img src="/aym_image/aym_images/aym_img_durr_dental.png" alt="" class="aym_img_original">
        			<img src="/aym_image/aym_images/aym_img_durr_dental_white.png" alt="" class="aym_img_hover">
				</figure>
				<article>
					<p>Conoce más ↗</p>
				</article> 
			</div>
			<div class="aym_item"> 
                <figure>
                    <img src="/aym_image/aym_images/aym_img_straumann.png" alt="" class="aym_img_original">
        			<img src="/aym_image/aym_images/aym_img_straumann_white.png" alt="" class="aym_img_hover">
				</figure>
				<article>
                    <p>Conoce más ↗</p>
				</article> 
			</div>
			<div class="aym_item" style="border-right: 2px solid black;"> 
				<figure>
                    <img src="/aym_image/aym_images/aym_img_curaprox.png" alt="" class="aym_img_original">
        			<img src="/aym_image/aym_images/aym_img_curaprox_white.png" alt="" class="aym_img_hover">
				</figure>
				<article>
					<p>Conoce más ↗</p>
				</article> 
			</div>
			<div class="aym_item" style="border-right: 2px solid black;"> 
				<figure>
                    <img src="/aym_image/aym_images/aym_img_ivoclar.png" alt="" class="aym_img_original">
        			<img src="/aym_image/aym_images/aym_img_ivoclar_white.png" alt="" class="aym_img_hover">
				</figure>
				<article>
					<p>Conoce más ↗</p>
				</article> 
			</div>
            <div class="aym_item"> 
                <figure class="aym_d">
                    <img src="/aym_image/aym_images/aym_img_asiga.png" alt="" class="aym_img_original">
                    <img src="/aym_image/aym_images/aym_img_asiga_white.png" alt="" class="aym_img_hover">
                </figure>
                <article>
                    <p>Conoce más ↗</p>
                </article> 
            </div>
		</section>
		<?php if($aym_num_rows > 1){?>
			<div class="aym_wrap_nav">
				<div class="aym_nav aym_prev"><img src="/aym_image/aym_images/aym_left_arrow.png" alt=""></div>
				<div class="aym_nav aym_next"><img src="/aym_image/aym_images/aym_right_arrow.png" alt=""></div>
			</div>
		<?php } ?>
	</section>
	
	<section id="aym_find_us">
		<h2>Dónde puedes encontrarnos</h2>
		<table>
			<tr>
				<td>Edificio C13</td>
				<td>Cra.32 #13-49</td>
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

	<section id="aym_contact_home">
		<section class="aym_contact_home_text">
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
		</section>
	</section>
</main>