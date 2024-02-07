<?php # **************************** AYMCORE V: 14.0 ********************
# MÓDULO RECUPERAR MI CONTRASEÑA
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

if (isset($_SESSION['user_log_in'])) { unset($_SESSION['user_log_in']);}
if (isset($_SESSION['usu_id'])) { unset($_SESSION['usu_id']);}
?>
<div id="aym_form_forgot_pass">
    <form name="frm_forgot_pass" id="frm_forgot_pass" method="post"  action="/admin/recovery_password" enctype="multipart/form-data" autocomplete="off">
        <h1>Recuperar Contraseña</h1>
        <fieldset class="aym_frm_content">
            <div class="aym_frm_two_col">
                <span class="aym_col_1">Email:</span>
                <span class="aym_col_2">
                <input name="use_log" type="text" id="use_log" value="" onblur="if(this.value=='') this.value='';" onfocus="if(this.value=='') this.value='';"/></span> 
            </div>
            <div class="aym_clear"></div> 
            <div class="aym_frm_two_col">
                <div class="aym_col_1">&nbsp;</div>
                <div class="aym_col_2"><input type="submit" value="Aceptar" class="val_log_out"/></div>
            </div>
            <div class="aym_clear"></div>
        </fieldset>
    </form>
    <p>&nbsp;</p>
    <div class="aym_separator"></div> 
    <div class="aym_frm_message_left"><a href="/admin/login">Iniciar Sesión</a> </div>
    <div class="aym_frm_message_right"><a href="/admin" target="_blank">Acerca de <?= $_SESSION['abo_nam'] ?></a> | <a href="/ayuda" target="_blank">Ayuda</a> | <a href="/terminos" target="_blank">Términos</a></div>
</div>