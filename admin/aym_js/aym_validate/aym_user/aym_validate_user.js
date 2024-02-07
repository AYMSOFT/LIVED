/* **************************** AYMCORE V: 14.0 ********************
# SCRIPT PARA VALIDAR USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/

/* BEGIN READY FUNCTION */
$(document).ready(function() {
	
		/*VALIDACIÓN AGREGAR USAURIO*/
		$("#frm_add_user").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				use_typ_id: {required: true, min:1},
				use_nam: {required: true},
				use_log: {required: true, email:true},
				use_pwd: {required: true, minlength: 8},
				use_pwd2: {required: true,equalTo:'#use_pwd'}
			},

			messages: {
				use_typ_id: { required: "El campo Tipo Usuario es obligatorio", min: "Seleccione un Tipo de usuario" },
				use_nam: { required: "El Nombre de Usuario es obligatorio"},
				use_log: { required: "La Cuenta es un campo obligatorio", email: "La Cuenta debe ser un email" },
				use_pwd: { required: "La Contraseña es un campo obligatorio", minlength: "La Contraseña debe contener al menos 8 Caracteres"},
				use_pwd2:{required: "Por favor Confirme su Contraseña.",equalTo: "Las Contraseñas No Coinciden."}
			},				

			// Mensaje de error
			errorPlacement: function(error, element) {				
				element.attr('placeholder', error.text());
				element.val('');
			},
			highlight: function(element) {	
				$(element).parent().addClass('error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('error');
			}
		});
		
		/*VALIDACIÓN EDITAR USUARIO*/
		$("#frm_edit_user").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				use_typ_id: {required: true, min:1},
				use_nam: {required: true},
				use_log: {required: true, email:true},
				sta_id: {required: true},
			},

			messages: {
				use_typ_id: { required: "El campo Tipo Usuario es obligatorio", min: "Seleccione un Tipo de usuario" },
				use_nam: { required: "El Nombre de Usuario es obligatorio"},
				use_log: { required: "La Cuenta es un campo obligatorio", email: "La Cuenta debe ser un email" },
				sta_id: { required: "Seleccione el estado del usuario"},
			},				

			// Mensaje de error
			errorPlacement: function(error, element) {				
				element.attr('placeholder', error.text());
				element.val('');
			},
			highlight: function(element) {	
				$(element).parent().addClass('error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('error');
			}
		});
	
		/*VALIDACIÓN RESTAURAR CONTRASEÑA*/
		$("#frm_restore_pass").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				use_nam:{required:true,minlength:3},
				use_pwd:{required:true,minlength:8},
				use_pwd2:{required:true,equalTo: '#use_pwd'}
			},
			
			messages:{
				use_nam:{required: "Por favor digite el correo eléctronico del usuario.",minlength: "digite minimo 3 caracteres."},
				use_pwd:{required: "Por favor digite su Contraseña.",minlength: "Minimo 8 Caracteres."},
				use_pwd2:{required: "Por favor repita su Contraseña.",equalTo: "Las Contraseña no Coinciden."}
			},
			
			// Mensaje de error
			errorPlacement: function(error, element) {				
				element.attr('placeholder', error.text());
				element.val('');
			},
			highlight: function(element) {	
				$(element).parent().addClass('error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('error');
			}
		});

		/*VALIDACIÓN CAMBIO DE CONTRASEÑA*/
		$("#frm_cha_pas").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			rules: {
				use_log:{required: true,email: true},
				use_pwd:{required:true,minlength: 8},
				use_pwd1:{required:true,minlength: 8},
				use_pwd2:{required:true,minlength: 8,equalTo: '#use_pwd1'}
			},
			messages:{
				use_log:{required: "Por favor digite su email.",email: "Por favor digite un email válido"},
				use_pwd:{required:"Por favor digite su contraseña", minlength:"La contraseña debe ser de al menos 8 carácteres."},
				use_pwd1:{required:"Por favor digite su contraseña", minlength:"La contraseña debe ser de al menos 8 carácteres."},
				use_pwd2:{required:"Por favor repita su contraseña", minlength:"La contraseña debe ser de al menos 8 carácteres.", equalTo: "Contraseñas no coinciden."},
			},
			
			// Mensaje de error
			errorPlacement: function(error, element) {				
				element.attr('placeholder', error.text());
				element.val('');
			},
			highlight: function(element) {	
				$(element).parent().addClass('error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('error');
			}
		});
		
});