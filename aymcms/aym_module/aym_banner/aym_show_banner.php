<?php # **************************** AYMCMS V: 7.0 ********************
# MODULO PARA MOSTRAR LOS BANNERS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# INCLUSION -> LISTAR BANNERS
	include $_SERVER['DOCUMENT_ROOT'].'/aymcms/aym_sql/aym_banner/aym_sql_show_banner.php';
	while($row_list_banner = mysqli_fetch_array($aym_sql_list_banner)){ 

	if (!empty($row_list_banner['ban_url'])) { 
?>
			<a class="aym_item " href="<?=$row_list_banner['ban_url'];?>" target="<?=$row_list_banner['ban_tar'];?>" title="<?=$row_list_banner['ban_des'];?>">
				<figure>
					<img src="/aym_image/aym_banner/<?=$row_list_banner['ban_id'];?>.jpg" alt="<?=$row_list_banner['ban_des'];?>"> 
				</figure>
				<article class="aym_banner_icon aym_banner_icon_<?=$i;?>">
					<strong><?=$row_list_banner['ban_cap'];?></strong>	
				</article>
			</a>
			
		<?php } else { ?>
			<figure class="aym_item">
				<img src="/aym_image/aym_banner/<?=$row_list_banner['ban_id'];?>.jpg" alt="<?=$row_list_banner['ban_des'];?>">
			</figure> 	
		<?php } ?>
<?php }mysqli_free_result($aym_sql_list_banner);?>