<?php # **************************** AYM EASY SITE V: 5.1 ********************
# FORMULARIO PARA AGREGAR UN CONTACTO EN EL HOME
# AYMSOFT SAS
# ANDRES CASTRO SEP/21/2023

    $_SESSION['contact']=md5(session_id());
	$_SESSION['use_id']=0;
    
	# PROCEDIMIENTO PARA LIMPIAR ARCHIVOS TEMPORALES
	$action = 'tmp';
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_clear_file_tmp_out.php';
?>
<link rel="stylesheet" href="/aym_css/aym_dropzone/dropzone.css"></link>
<script type="text/javascript" src="/admin/aym_js/aym_dropzone/dropzone.js"></script>
<form action="/send_contact" method="post" name="frm_contact" id="frm_contact" class="aym_form" enctype="multipart/form-data" autocomplete="off">
    <fieldset class="aym_form_contact_home">
    	<div class="aym_content aym_active" id="aym_pos_1">
            <div>
                <span>Paso 1/3</span>
                <input name="con_nam" type="text" id="con_nam" minlength="3" maxlength="150" placeholder="Nombre *"/>
            </div>
            <span class="aym_msn_error" id="aym_span_error">Por favor, ingrese un nombre.</span>
            <ul><li style="background-color: black"></li><li></li><li></li></ul>
        </div> 
        <div class="aym_frm_two_col aym_content" id="aym_pos_2">
            <span>Paso 2/3</span>
            <div class="aym_two_col">
                <div>
                    <input name="con_tel" type="tel" id="con_tel" class="aym_clean_number" minlength="7" maxlength="20" placeholder="Teléfono *"/>
                </div>
                <div>
                    <input name="con_ema" type="email" id="con_ema" minlength="3" maxlength="150" placeholder="Correo Electrónico *"/>
                </div>
            </div>
            <span class="aym_msn_error" id="aym_span_error_2">Por favor, complete todos los campos.</span>
            <ul><li></li><li style="background-color: black"></li><li></li></ul>
        </div> 
        <div class="aym_content" id="aym_pos_3">
            <span class="aym_span_textarea">Paso 3/3</span>
            <div class="aym_frm_textarea">
                <label for="con_com">Déjanos tu comentario *</label>
                <textarea name="con_com" id="con_com" maxlength="255"></textarea>
            </div>
            <div class="aym_frm_submit">
                <input name="submit" type="submit" value="ENVIAR" class="aym_submit"/>
                <input name="token" type="hidden" id="token" value="token" />
                <input name="action" type="hidden" id="action" value="I" />
            </div>
            <ul><li></li><li></li><li style="background-color: black"></li></ul>
        </div>
        <span id="aym_span_contact_next" class="aym_span_next">Siguiente&nbsp;</span>
        <span id="aym_span_contact_prev" class="aym_span_prev">&nbsp;Anterior</span>
	</fieldset> 
</form>
<!-- <script type="text/javascript" src="/aym_js/aym_validate/aym_contact/aym_validate_contact.js"></script> -->
