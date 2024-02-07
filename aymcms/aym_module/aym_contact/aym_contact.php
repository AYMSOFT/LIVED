<?php # **************************** AYM EASY SITE V: 5.1 ********************
# FORMULARIO PARA AGREGAR UN CONTACTO
# AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ JUL/18/2013

    $_SESSION['contact']=md5(session_id());
	$_SESSION['use_id']=0;
    
	# PROCEDIMIENTO PARA LIMPIAR ARCHIVOS TEMPORALES
	$action = 'tmp';
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/aym_component/aym_common/aym_clear_file_tmp_out.php';
    
?>
<link rel="stylesheet" href="/aym_css/aym_dropzone/dropzone.css"></link>
<script type="text/javascript" src="/admin/aym_js/aym_dropzone/dropzone.js"></script>
<form action="/send_contact" method="post" name="frm_contact" id="frm_contact" class="aym_form" enctype="multipart/form-data" autocomplete="off">
    <fieldset>
    	<div>
            <label for="con_nam">Nombre *</label>
            <input name="con_nam" type="text" id="con_nam" minlength="3" maxlength="150"/>
        </div>
        
        <div class="aym_frm_two_col">
            <div>
                <label for="con_tel">Teléfono *</label>
                <input name="con_tel" type="tel" id="con_tel" class="aym_clean_number" minlength="7" maxlength="20"/>
            </div>
    
            <div>
                <label for="con_ema">E-Mail *</label>
                <input name="con_ema" type="email" id="con_ema" minlength="3" maxlength="150"/>
            </div>
        </div>
        
        <div class="aym_frm_textarea">
            <label for="con_com">Déjanos tu comentario *</label>
        	<textarea name="con_com" id="con_com" maxlength="255"></textarea>
        </div>
        <div class="aym_frm_submit">
            <input name="submit" type="submit" value="ENVIAR"/>
			<input name="token" type="hidden" id="token" value="token" />
            <input name="action" type="hidden" id="action" value="I" />
        </div>
	</fieldset> 
</form>
<script type="text/javascript" src="/aym_js/aym_validate/aym_contact/aym_validate_contact.js"></script>
