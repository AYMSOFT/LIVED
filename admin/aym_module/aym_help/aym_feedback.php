<?php # **************************** AYMCORE V: 14.0 ********************
# FORMULARIO PARA AGREGAR UNA SOLICITUD DE SOPORTE / FEEDBACK
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	$action = 'tmp';
	# PROCEDIMIENTO PARA LIMPIAR ARCHIVOS TEMPORALES
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_clear_file_tmp.php';

?>
<h2>Solicitud de Soporte</h2>
<div class="aym_wrap_form">
	<form action="/admin/actionhelp" method="post" name="frm_add_feedback" enctype="multipart/form-data" id="frm_add_feedback" autocomplete="off"> 
		<fieldset>
			<div>
				<label>Módulo a reportar:</label>
				<select name="fun_id" id="fun_id">
					<?php 
						# INCLUSIÓN --> PROCEDIMIENTO PARA LISTAR EL MENU DE OPCIONES
						include $_SERVER['DOCUMENT_ROOT'].'/admin/aym_sql/aym_security/aym_sql_list_menu.php'; 
						while ($row_fun_men=mysqli_fetch_array($aym_sql_list_menu)){ ?>	
						<option value="<?= $row_fun_men['fun_id']?>"><?= $row_fun_men['fun_nam']?></option>
					<?php } mysqli_free_result($aym_sql_list_menu); ?>
				</select>	
			</div>
			
			<h3>Descripción del error</h3>
			<div class="aym_frm_full">
				<div class="aym_ckeditor_toolbar">
					<div class="document-editor__toolbar"></div>
				</div>
				<div class="aym_ckeditor_editor">
					<div name="content" id="editor" data-id="fee_des"></div>
				</div>
			</div>
			<input type="hidden" name="fee_des" id="fee_des"  value=''>


			<h3>Archivos:</h3>
			<div class="dropzone MultipleFiles">
				<div class="fallback">
					<input type="file" name="doc_nom" id="doc_nom" multiple/>
				</div>
			</div>

			<hr>
			<div class="aym_frm_submit">
				<button type="submit">Enviar</button>	
				<input type="hidden" name="action" value="I">		
			</div>
		</fieldset>
	</form>
</div>
<script src="/admin/aym_js/aym_validate/aym_help/aym_validate_feedback.js"></script>
<script src="/admin/aym_js/aym_help/aym_help_function.js"></script>
<script src="/admin/aym_js/aym_help/aym_help_dropzone.js"></script>
<script src="/ckeditor5/build/ckeditor.js"></script>
<script src="/ckeditor5/config_basic.js"></script>	
