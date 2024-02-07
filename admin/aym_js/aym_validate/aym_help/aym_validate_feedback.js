/**************************** AyMfly: 1.0 ********************
# SCRIPT PARA VALIDAR LOS CAMPOS AL AGREGAR FEEDBACK
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/
$(document).ready(function() {
	
	/*VALIDACIÓN AGREGAR FEEDBACK*/
	$("#frm_add_feedback").validate({
		onfocusout: function(element) {$(element).valid()},
		onkeyup: false,
		focusCleanup: true,
		focusInvalid: false,
		ignore: '',

		rules:{
			
			fee_des:{required: true,minlength: 5,},
			fun_id:{required: true, minlength:1}
		},

		messages:{
			fee_des:{required:"Digite una breve descripción del error.", minlength: "La descripción del error es muy corta."},
			fun_id:{required:"Seleccione.", minlength: "Seleccione el módulo que presenta el error"}
		},
		// Mensaje de error
		errorPlacement: function(error, element) {				
			element.attr('placeholder', error.text());
			element.val('');
			
			if (element.attr("name") == "fee_des") {
				element.next().addClass('error');
			}
		},
		highlight: function(element) {	
			$(element).parent().addClass('error');
		},
		unhighlight: function(element) {
			$(element).parent().removeClass('error');
		}
	});
});/*------------- FIN READY FUNCTION  -------------*/
