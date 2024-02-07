<?php
	# SESION LISTA DE CORREO
	$_SESSION['list_mail'] = md5(session_id()); 
?>
<script type="text/javascript" src="/aym_js/aym_list_mail/aym_validate_list_mail.js"></script>
<form id="frm_list_mail" name="frm_list_mail">
    <input type="text" name="lis_ema" id="lis_ema" placeholder="Correo electrónico"/>
    <button id="aym_send_list_mail" type="submit" aria-label="Enviar Correo">SUSCRIBIRME</button>
    <input name="action" type="hidden" id="action" value="I" />
    <input name="lis_nam" type="hidden" id="lis_nam" value="USUARIO WEB"/>
</form>
<div id="aym_wrap_message"><div id="aym_message"></div></div>