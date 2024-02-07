<?php # **************************** AYMCMS V: 7.0 ********************
# MODULO LISTA SITE MAP DE LA PAGINA EN FOOTER
# © 2023, AYMSOFT SAS
# DIEGO SUAZA MAR/10/2023


	$_GET['lan_id'] = 1;

	# FUNCION ---> RECURSIVA PARA LAS SUBPAGINAS
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_function/aym_sitemap/aym_fun_sitemap.php';

	# PROCEDIMIENTO ---> LISTA LAS CATEGORIAS DE LA PAGINA
	include_once $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_sitemap/aym_sql_list_sitemap_category.php';

	while ($row_sitemap_category=mysqli_fetch_array($aym_sql_list_sitemap_category)){ 
?>
		<article>
			<strong><?=$row_sitemap_category['pag_cat_nam'];?></strong>
			<ul>
				<?php 
					# PROCEDIMIENTO ---> LISTA LAS PAGINAS 
					include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_sitemap/aym_sql_list_sitemap_page.php';

					while ($row_sitemap_page=mysqli_fetch_array($aym_sql_list_sitemap_page)){	
						
						$aym_url = $row_sitemap_page['pag_url'] ? $row_sitemap_page['pag_url'] : '/'.aym_friendly_url($row_sitemap_category['pag_cat_nam']).'/'.aym_friendly_url($row_sitemap_page['pag_tit']).'/'.$row_sitemap_page['pag_id']; 
?>
						<li class="<?=$_GET['pag_id'] == $row_sitemap_page['pag_id'] ? 'active' : ' ';?>" id="<?=$row_sitemap_page['pag_id']?>" title="<?=$row_sitemap_page['pag_des']?>">
							<?php if($row_sitemap_page['aym_num_sub_pag'] > 0){ ?>
								<span><?=$row_sitemap_page['pag_tit']?></span>
								<?php aym_sitemap_subpage($row_sitemap_page['pag_id'],$row_sitemap_category['pag_cat_nam']);?>
							<?php }else{ ?>
								<a href="<?=$aym_url;?>" target="<?=$row_sitemap_page['pag_tar'];?>"><?=$row_sitemap_page['pag_tit']?></a>
							<?php } ?>
						</li>
			 
				<?php } mysqli_free_result($aym_sql_list_sitemap_page); ?>

			</ul>
		</article>
<?php } mysqli_free_result($aym_sql_list_sitemap_category); ?>	   