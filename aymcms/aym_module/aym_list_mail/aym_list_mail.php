<?php # **************************** AYMCMS V: 7.0 ********************
# FORMULARIO PARA LISTAR USUARIOS DE LISTA DE CORREOS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023

	# VARIABLES
	if(!isset($_SESSION['chk_lis_nam'])){if(!isset($_POST['chk_lis_nam'])){$_SESSION['chk_lis_nam']=0;$_SESSION['lis_nam']="";}else{if($_POST['lis_nam']==""){$_SESSION['chk_lis_nam']=0;$_SESSION['lis_nam']="";}else{$_SESSION['chk_lis_nam']=$_POST['chk_lis_nam'];$_SESSION['lis_nam']=$_POST['lis_nam'];}}}
	if(!isset($_SESSION['chk_lis_ema'])){if(!isset($_POST['chk_lis_ema'])){$_SESSION['chk_lis_ema']=0;$_SESSION['lis_ema']="";}else{if($_POST['lis_ema']==""){$_SESSION['chk_lis_ema']=0;$_SESSION['lis_ema']="";}else{$_SESSION['chk_lis_ema']=$_POST['chk_lis_ema'];$_SESSION['lis_ema']=$_POST['lis_ema'];}}}
	if(!isset($_SESSION['chk_lis_dat'])){if(!isset($_POST['chk_lis_dat'])){$_SESSION['chk_lis_dat']=0;$_SESSION['lis_dat_ini']="1900-01-01";$_SESSION['lis_dat_fin']="1900-01-01";}else{if($_POST['lis_dat_ini']=="" || $_POST['lis_dat_fin']==""){$_SESSION['chk_lis_dat']=0;$_SESSION['lis_dat_ini']="1900-01-01";$_SESSION['lis_dat_fin']="1900-01-01";}else{$_SESSION['chk_lis_dat']=$_POST['chk_lis_dat'];$_SESSION['lis_dat_ini']=$_POST['lis_dat_ini']." 00:00:00";$_SESSION['lis_dat_fin']=$_POST['lis_dat_fin']." 23:59:59";}}}
	
?>
<div class="aym_wrap_list">
	<div class="aym_wrap_filter">
		<form name="frm_list_mail" data-module="list_mail" data-file="list_mail" id="frm_list_mail">
			<div class="aym_toggle filter"><?php #INCLUSIÓN ---> FILTROS RESPONSIVE ?></div>
			<nav id="aym_show_filter">
				<div>
					<label for="aym_page_size">Mostrar</label>
					<select name="aym_page_size" id="aym_page_size" class="aym_select">
						<option value="25" <?=$_GET['aym_page_size'] == '25' ? 'selected="selected"' : ''?>>25 Registros</option>
						<option value="50" <?= $_GET['aym_page_size'] == '50' ? 'selected="selected"' : ''?>>50 Registros</option>
						<option value="100" <?=$_GET['aym_page_size'] == '100' ? 'selected="selected"' : ''?>>100 Registros</option>
					</select>
				</div>
			</nav>
			<input type="hidden" name="aym_tex_sea" id="aym_tex_sea" value="<?= $_GET['aym_tex_sea'];?>" />
			<input type="hidden" name="option" id="option" value="<?= $_GET['option'];?>" />
			<input type="hidden" name="aym_page" id="aym_page" value="<?= $_GET['aym_page']; ?>">
			<input type="hidden" name="aym_order" id="aym_order" value="<?= $_GET['aym_order']; ?>">
			<input type="hidden" name="aym_order_type" id="aym_order_type" value="<?= $_GET['aym_order_type']; ?>">
		</form>
	</div>
	<div id="frm_list_mail"></div>
	<div id="aym_list_error"></div>
</div>