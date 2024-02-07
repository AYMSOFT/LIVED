$(document).ready(function() {
	
		/*VALIDACIÓN AGREGAR USAURIO*/
		$("#frm_add_profile").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				pro_nam: {required: true, minlength: 3},
			},

			messages: {
				pro_nam: { required: "El Nombre del Perfil es obligatorio", minlength: "Nombre del perfil NO Válido."},
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
		
		/*VALIDACIÓN EDITAR USAURIO*/
		$("#frm_edit_profile").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				pro_nam: {required: true, minlength: 3},
			},

			messages: {
				pro_nam: { required: "El Nombre del Perfil es obligatorio", minlength: "Nombre del perfil NO Válido."},
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