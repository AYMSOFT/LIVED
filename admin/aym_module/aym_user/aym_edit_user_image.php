<?php
	session_start();
	# VARIABLE
	$_GET['use_id']=$_SESSION['use_id'];

	# COMPONENTE QUE TRAE LOS DATOS DEL USUARIO
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_user/aym_sql_get_user.php';

	$row_nam = explode(" ",$_SESSION['use_nam']);
	$count_nam = count($row_nam);
	$ini_nam = '';
	if($count_nam==1){
		$ini_nam = substr($row_nam[0],0,2);
	}else if($count_nam>1){
		$ini_1 = substr($row_nam[0],0,1);
		$ini_2 = substr($row_nam[1],0,1);
		$ini_nam = $ini_1.$ini_2;
	}
?>	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.css">
<link rel="stylesheet" href="/admin/aym_css/aym_common/aym_style_user_edit_image.css">

<div class="aym_wrap_form">
	<h2>Imagen de perfil</h2>
	<hr>
	<a class="aym_open_file">+ Cargar una nueva imagen</a>
	<form action="#">
		<fieldset>
			<div class="aym_frm_images">
				<div class="aym_frm_image">
					<?php if(!$_SESSION['use_ava']){ ?>
						<span class="aym_uc_<?= substr($_SESSION['use_id'],-1,1);?>"><?= $ini_nam?></span>
					<?php }?>
					<div id="aym_wrap_image_crop"></div>
				</div>
				<input name="doc_nom" class="aym_hidden aym_file" id="use_ima" type="file">
			</div>
			<input name="action" id="action" value="II" type="hidden">
			<input name="use_id" id="use_id" value="<?= $_SESSION['use_id'] ?>" type="hidden">
			<div class="aym_frm_submit">
				<button type="button" class="aym_button_crop disabled">Subir</button>
				<button type="button" id="aym_link_delete" url="/admin/userimage/<?= $_SESSION['use_id'];?>/DIC">Eliminar</button>
			</div>
		</fieldset>
	</form>
</div>
<script>
	aym_change();
	
	$(document).ready(function(){
			
		/*AYMCROP*/
		var aym_avatar = $('#aym_wrap_image_crop').croppie({
			viewport: {
				width: 200,
				height: 200,
				type: 'circle'
			},
			boundary: {
				width: 200,
				height: 200
			},
			mouseWheelZoom: true
		});
		
		/*SI HAY IMAGEN ACTUAL, SE MUESTRA*/
		<?php if($row_get_user['use_ima'] != ''){?>
			aym_avatar.croppie('bind',{
				url: '<?= "data:image/png;base64,".$row_get_user['use_ima']?>',
			}).then(function(){
				aym_avatar.croppie('setZoom', 0);
			});;
		<?php } ?>
		/*AL CARGAR IMAGEN SE PREVISUALIZA*/	
		$('#use_ima').on('change', function() {
			var input = $(this)[0];

			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					aym_avatar.croppie('bind', {
						url: e.target.result
					}).then(function(){
						aym_avatar.croppie('setZoom', 0);
					});
				}
				reader.readAsDataURL(input.files[0]);
			}
		});
	
		/*AL DAR CLICK SE CORTA Y SE ENVIA POR AJAX*/			
		$('.aym_button_crop').on('click', function(){
			var element = $(this);
			if(!$(this).hasClass('disabled') && !$(this).hasClass('exit')){
				$('.aym_frm_image').off('DOMMouseScroll mousewheel','.cr-boundary.uploaded');
				
				aym_avatar.croppie('result', {
					type: 'base64',
				}).then(function(resp) {	
					$('.aym_open_file, .cr-slider-wrap').addClass('disabled');
					element.addClass('disabled').text('Cargando...');
					var action = 'IIC';
					var use_id = $('#use_id').val();
					var fileFormData = new FormData();
					var new_avatar = resp;
					resp = resp.replace('data:image/png;base64,','');

					fileFormData.append('action', action);
					fileFormData.append('use_id', use_id);
					fileFormData.append('use_ima', resp);

					$.ajax({
						// INCLUSIÓN --> COMPLEMENTO QUE ENVIA LA IMAGEN AL SERVIDOR
						url: "/admin/actionuser",
						type: "POST",
						data: fileFormData,
						contentType: false,
						processData: false,
						success: function(aym_response){
							aym_avatar.croppie('destroy');
							var aym_new_avatar = $('#aym_wrap_image_crop').croppie({
								viewport: {
									width: 200,
									height: 200,
									type: 'circle'
								},
								boundary: {
									width: 200,
									height: 200
								},
								url: new_avatar,
								mouseWheelZoom: false
							});
							$('.cr-boundary').addClass('uploaded');
							$('.cr-slider-wrap').addClass('disabled');
							$('.aym_user_name figure').find('img').remove();
							$('.aym_tooltip_menu > figure > span').find('img').remove();
							$('.aym_user_name figure').html(aym_response);
							$('.aym_tooltip_menu > figure > span').html(aym_response);
							$('.aym_button_crop').removeClass('disabled').text('Hecho').addClass('exit');
						},
						error:function(){
							alert("failure");
						}
					});
				});	
			}
			
			if($(this).hasClass('exit')){
				$('.aym_window-closebtn').click();
			}
			
		});	

		
	});
</script>