<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA PAGINAR
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022


if($aym_page_ceil > 1) {
?>
<div class="aym_wrap_paginador">
	<?php
		$initial = $aym_page_ceil > 6 ? (($_GET['aym_page'] - 3 > 0) && ($_GET['aym_page'] < $aym_page_ceil - 3) ? $_GET['aym_page'] - 3 : (($_GET['aym_page'] + 1 > (($aym_page_ceil - 3) > 0 ? $aym_page_ceil - 3 : $aym_page_ceil)) ? $aym_page_ceil - 6 : 0)) : 0;   
		$last = $aym_page_ceil > 6 ? ($_GET['aym_page'] > 3) ? (($_GET['aym_page'] + 3 < $aym_page_ceil) ? $_GET['aym_page'] + 3 : $aym_page_ceil) : 6 : $aym_page_ceil;
		if ($_GET['aym_page'] > 0) { ?>
			<a id="<?= (0) ?>" class="aym_arrow_begin">
				<i class="fa fa-angle-double-left" aria-hidden="true"></i>
			</a>
			<a id="<?= ($_GET['aym_page']-1) ?>" class="aym_arrow_before">
				<i class="fa fa-angle-left" aria-hidden="true"></i>
			</a> 
		<?php }
		for ($initial; $initial < $last; $initial++) { ?>
			<a class="<?= $_GET['aym_page'] == $initial ? 'aym_page_active' : '' ?>" id="<?= $initial ?>"><?= ($initial+1)?></a> 
		<?php }
		if(($_GET['aym_page']+1) < $aym_page_ceil) { ?>
			<a id="<?= ($_GET['aym_page']+1)?>" class="aym_arrow_next">
				<i class="fa fa-angle-right" aria-hidden="true"></i>
			</a> 
			<a id="<?= ($aym_page_ceil - 1)?>" class="aym_arrow_final"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
		<?php } ?>
</div>
<hr>
<?php }  ?>
<div class="aym_info_paginador">Total de registros: <strong> <?= $num_rows;  ?></strong> | Número de registros en esta página: <strong><?= $rows_for_page; ?></strong> | Página No: <strong><?= $_GET['aym_page']+1;  ?></strong> de <strong> <?= $aym_page_ceil ?></strong></div>
<link rel="stylesheet" href="/admin/aym_css/aym_common/aym_style_paginator.css">