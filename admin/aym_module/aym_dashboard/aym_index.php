<?php # **************************** AYMCORE V: 1.0 ********************
# CONTENEDOR PRINCIPAL DEL MODULO DE DASHBOARD
# © 2017, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2017 
	# VALIDACION  --> VARIABLES DE CONTROL	

	session_start();
	if (!isset($_GET['url_pag'])) {$_GET['url_pag'] = "aym_dashboard"; }	

	#INCLUSIÓN --> PROCEDIMIENTO QUE LISTA TODAS LAS CATEGORIAS DASHBOARD
	include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/admin/aym_sql/aym_dashboard/aym_sql_list_all_dashboard_category.php';

	#INCLUSIÓN --> PROCEDIMIENTO QUE LISTA TODAS LAS EMPRESAS
	include_once $_SERVER[ 'DOCUMENT_ROOT' ].'/aymhuman/aym_sql/aym_company/aym_sql_list_all_company.php';
	
?>
<link rel="stylesheet" href="/admin/aym_css/aym_module/aym_style_dashboard.css?<?= time();?>">
<section id="aym_wrap_page">
	<div class="aym_wrap_menu aym_wrap_menu_dashboard">
		<figure class="aym_toggle nine">
			<span></span>
			<span></span>
			<span></span>
		</figure>
		<nav class="aym_effects aym_fadein_down"> 
			<ul>
				<li><a href="/admin/dashboard" class="<?= $_GET['url_pag']=="aym_dashboard" ? 'active' : '' ?>"><figure><img src="/admin/aym_image/aym_icon/aym_core.png"></figure>Dashboard</a></li>
				<?php /*<li><a href="/admin/exportdashboard" target="_blank"><figure><img src="/admin/aym_image/aym_icon/aym_ico_pdf.png"></figure>Exportar</a></li>*/?>
				<li> </li>
			</ul>
		</nav>
	</div>
	<h2>Resumen de Actividad</h2>
	<div class="aym_wrap_list">
		<div class="aym_wrap_filter">
			<form>
				<div class="aym_toggle filter"><?php #INCLUSI�N ---> FILTROS RESPONSIVE ?></div>
				<nav id="aym_show_filter">
					<?php /* SI ES UN USUARIO EMPRESA SE DEBE ENVIAR OCULTO EL ID DE LA EMPRESA ASIGNADA AL USUARIO */?>
					<div>
						<label>Empresa</label>
						<select name="com_id" id="com_id">
							<?php /*<option value="0">Todas</option> */?>
							<?php while($row_list_company = mysqli_fetch_array($aym_sql_list_all_company)){?>
								<option value="<?=$row_list_company['com_id']?>"><?=$row_list_company['com_leg_nam']?></option>
							<?php }mysqli_free_result($aym_sql_list_all_company);?>
						</select>
					</div>
					<div>
						<label>Categoría</label>
						<select name="das_cat_id" id="das_cat_id">
							<option value="0">Todas</option>
							<?php while($row_dash_category = mysqli_fetch_array($aym_sql_list_all_dashboard_category)){?>
								<option value="<?=$row_dash_category['das_cat_id']?>"><?=$row_dash_category['das_cat_nam']?></option>
							<?php }mysqli_free_result($aym_sql_list_all_dashboard_category);?>
						</select>
					</div>
					<div class="aym_date_block">
						<div class="aym_dashboard_date">
							<div>  
								<input type="text" name="aym_dat_fil" id="aym_dat_fil" value='<?= json_encode(array("start"=>date('Y-m-d',strtotime(date('d-m-Y').'-1 day')),"end"=>date('Y-m-d')));?>' readonly>
							</div>
						</div>
					</div>
					<div>
						<span class="aym_btn_filter" id="aym_filter_form">Aplicar</span>
					</div>
				</nav>
			</form>
		</div>
	</div> 
    <?php 
		# PAGINA PARA MOSTRAR PAGINA
		require $_SERVER['DOCUMENT_ROOT'].'/admin/aym_module/aym_dashboard/'.$_GET['url_pag'].'.php';
	?>
</section>   

<!-- FILTROS DE FECHAS -->
<link 	rel="stylesheet" href="/admin/aym_css/aym_datetimepicker/aym_datetimepicker.css">
<script src="/admin/aym_js/aym_datetimepicker/moment.js"></script>
<script src="/admin/aym_js/aym_datetimepicker/jquery.comiseo.daterangepicker.js"></script>
<!-- FUNCION QUE MUETRA LOS DASHBOARD -->
<script src="/admin/aym_js/aym_dashboard/aym_dashboard_function.js?<?=time()?>"></script>