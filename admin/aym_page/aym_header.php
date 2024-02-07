<?php # **************************** AYMCORE V: 14.0 ********************
# HEADER 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	# COMPONENTE QUE PROCESA LOS DATOS EN LA BD
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_count_user_dashboard.php';

?>
<header>
	<figure id="aym_menu_aside" class="aym_toggle">
		<span></span>
	</figure>
	<figure id="aym_logo">
		<a href="/admin/welcome"><img src="/admin/aym_image/aymhuman_logo_white.png" alt="AyMsoft SAS"><img src="/admin/aym_image/aym_logo_cohete.png"></a>
		<figure id="aym_close_aside" class="aym_toggle on">
			<span></span>
		</figure>
	</figure>
	<section id="aym_wrap_header">
		<?php if($row_count_user_dashboard['aym_num_das'] > 0){?>
			<div id="aym_wrap_dash">
				<figure>
					<a href="/admin/dashboard"><img src="/admin/aym_image/aym_icon/aym_core.png"></a>
				</figure>
			</div>
		<?php }?>
		<div id="aym_wrap_cog">
			<figure>
				<img src="/admin/aym_image/aym_icon/aym_cog.png">
			</figure>
			<div class="aym_tooltip_menu aym_effects aym_fadein_down">
				<a href="/admin/feedback">Feedback</a>
				<a href="/admin/help">Ayuda</a>
				<a href="/aymhuman/admcompany">Empresas</a>
			</div>
		</div>
		<div id="aym_wrap_user">
			<div class="aym_user_name">
				<?php 
				# ================== OBTENER LAS LETRAS DEL NOMBRE DEL UAURIO / IMAGEN ================== 
				
				$row_nam = explode(" ",$_SESSION['use_nam']);
				$count_nam = count($row_nam);

				# VALIDACIÓN ---> MAS DE UN NOMBRE 
				if($count_nam=="1"){
					$ini_nam = substr($row_nam[0],0,2);
				} else if ($count_nam>1) {
					$ini_1 = substr($row_nam[0],0,1);
					$ini_2 = substr($row_nam[1],0,1);
					$ini_nam = $ini_1.$ini_2;
				}

			 	if(isset($_SESSION['use_ava'])){ ?>
				<figure>
					<style>
						.ico_use{content:url('data:image/png;base64,<?=$_SESSION['use_ava']?>');}
					</style>
					<img class="ico_use" src="data:image/png;base64,<?=$_SESSION['use_ava']?>">
				</figure>
				<?php } else { ?>
				<figure>
					<span class="aym_uc_<?= substr($_SESSION['use_id'],-1,1);?>"><?= $ini_nam?></span>
				</figure>
				<?php } ?>
			</div>
			<div class="aym_tooltip_menu aym_effects aym_fadein_down">
				<figure>
				<?php if(isset($_SESSION['use_ava'])){ ?><span><img class="ico_use" src="data:image/png;base64,<?=$_SESSION['use_ava']?>"></span> <?php }else{ ?><span class="aym_uc_<?= substr($_SESSION['use_id'],-1,1);?>"><?= $ini_nam?></span><?php }?>
					<figcaption>
						<span><?= $_SESSION['use_nam'] ?></span>
						<span><?= $_SESSION['use_log'] ?></span>
					</figcaption>
				</figure>
				<a href="/admin/myaccount">Mi cuenta</a>
				<a href="/admin/changepass">Cambiar contraseña</a>
				<?php if (!isset($_SESSION['logout-microsoft'])) {?>
					<a href="/admin/logout">Salir</a>
				<?php } else {?>
					<a href="https://login.microsoftonline.com/9da6d7d1-698b-4c14-8201-15367a98cd18/oauth2/v2.0/logout?post_logout_redirect_uri=https://www.aymhuman.com/admin/logout-microsoft">Salir</a>
				<?php } ?>
			</div>		
		</div>
	</section>	
</header>