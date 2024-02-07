$(function(){
	
	/* ==========================================================================
	=================================LOGIN ====================================== 
	============================================================================ */
	
	/*VALIDACIÓN INICIO DE SESIÓN*/
	$("#aym_frm_login").validate({
		/*CAMPOS PARA VALIDAR EN INICIO DE SESIÓN*/
		rules:{
			use_log:{required:true,email:true},
			use_pwd:{required:true,minlength: 8}
		},
		/*MENSAJES DE VALIDACIÓN PARA INICIO DE SESIÓN*/
		messages:{
			use_log:{required:"Por favor digite su correo electrónico.", email:"Por favor digite un correo electrónico válido."},
			use_pwd:{required:"Por favor digite su contraseña", minlength:"La contraseña debe ser de al menos 8 carácteres."}
		},
		errorPlacement: function(error, element) {
			element.attr("placeholder", error.text());
		}
	});
	/*FIN VALIDACIÓN INICIO DE SESIÓN*/

	/*VALIDACIÓN OLVIDÓ SU CONTRASEÑA*/
	$("#aym_form_request_pass").validate({
		rules: {
			use_log:{required: true,email: true}
		},
		messages:{
			use_log:{required: "Por favor digite su email.",email: "Por favor digite un email válido"}
		},
		
		errorPlacement: function(error, element) {
			element.attr("placeholder", error.text());
		}
	});
	
	/*VALIDACIÓN OLVIDÓ SU CONTRASEÑA*/
	$("#aym_form_change_pass").validate({
		rules: {
			use_log:{required: true,email: true},
			use_pwd1:{required:true,minlength: 8},
			use_pwd2:{required:true,minlength: 8,equalTo: '#use_pwd1'}
		},
		messages:{
			use_log:{required: "Por favor digite su email.",email: "Por favor digite un email válido"},
			use_pwd1:{required:"Por favor digite su contraseña", minlength:"La contraseña debe ser de al menos 8 carácteres."},
			use_pwd2:{required:"Por favor repita su contraseña", minlength:"La contraseña debe ser de al menos 8 carácteres.", equalTo: "Contraseñas no coinciden."},
		},
		
		errorPlacement: function(error, element) {
			element.attr("placeholder", error.text());
		}
	});
	
	/*VALIDACIÓN CAMBIO DE CONTRASEÑA*/
	$("#frm_cha_pas").validate({
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
		
		errorPlacement: function(error, element) {
			element.attr("placeholder", error.text());
		}
	});
})