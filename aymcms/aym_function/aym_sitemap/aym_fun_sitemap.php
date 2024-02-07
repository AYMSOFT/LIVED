<?php # **************************** AYMCMS V: 7.0 ********************
# FUNCION PARA OBTENER LAS SUBPAGINAS 
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

function aym_sitemap_subpage($aym_pag_id,$pag_cat_nam){
	
	# PROCEDIMIENTO ---> LISTA LAS SUBPAGINAS 
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_sitemap/aym_sql_list_sitemap_subpage.php';

	while ($row_sitemap_subpage=mysqli_fetch_array($aym_sql_list_sitemap_subpage)) { 

		$aym_url = $row_sitemap_subpage['pag_url'] ? $row_sitemap_subpage['pag_url'] : '/'.aym_friendly_url($pag_cat_nam).'/'.aym_friendly_url($row_sitemap_subpage['pag_tit']).'/'.$row_sitemap_subpage['pag_id']; 

?>
		<li class="slide_hide <?=$aym_pag_id == $row_sitemap_subpage['pag_id'] ? 'active' : ' ';?>" id="<?=$row_sitemap_subpage['pag_id']?>" title="<?=$row_sitemap_subpage['pag_des']?>">
			<?php if($row_sitemap_subpage['aym_num_sub_pag'] > 0){ ?>
				<span><?=$row_sitemap_page['pag_tit']?></span>
				<?php aym_sitemap_subpage($row_sitemap_subpage['pag_id'],$pag_cat_nam);?>
			<?php }else{ ?>
				<a href="<?=$aym_url;?>" target="<?=$row_sitemap_subpage['pag_tar'];?>"><?=$row_sitemap_subpage['pag_tit']?></a>
			<?php } ?>
		</li>

<?php 
	} mysqli_free_result($aym_sql_list_sitemap_subpage); 
}
?>