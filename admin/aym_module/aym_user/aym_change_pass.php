<?php # **************************** AYMCORE V: 14.0 ********************
# FORMULARIO PARA CAMBIAR MI CONTRASEÑA
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
?>

<h2>Seguridad y Privacidad</h2>
<div class="aym_wrap_form">
    <form action="/admin/sendchangepass" name="frm_cha_pas" id="frm_cha_pas" method="post" enctype="multipart/form-data">
        <fieldset>
            <div>
                <label>Usuario</label>
                <input name="use_log" type="text" id="use_log" class="aym_input_inactive" value="<?= $_SESSION['use_log'] ?>" readonly>   
            </div>
            <div>
                <label>Contraseña Actual</label>
              	<input name="use_pwd" type="password" id="use_pwd">
				<input type="checkbox" class="sho_pwd">
            </div>
            <div>
                <label>Contraseña Nueva</label>
                <input name="use_pwd1" type="password" id="use_pwd1" placeholder="Digite su nueva contraseña">
				<input type="checkbox" class="sho_pwd">
            </div>
            <div>
                <label>Repita la Contraseña</label>
                <input name="use_pwd2" type="password" id="use_pwd2" placeholder="Repita su nueva contraseña">
				<input type="checkbox" class="sho_pwd">
            </div>
			<div class="aym_frm_submit">
				<input type="submit" value="Aceptar"> 
				<input type="hidden" name="aym_rec" id="aym_rec" value="0">
              	<input name="action" type="hidden" id="action" value="CL">
			</div>
      	<hr>
       	<span class="aym_text_required">*Todos los campos son obligatorios</span>
        </fieldset>
    </form>
</div>