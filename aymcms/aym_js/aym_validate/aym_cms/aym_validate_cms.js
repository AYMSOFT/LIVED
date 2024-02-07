$(document).ready(function() {
	
	/*=========================================================================*/
	/*============================== AGREGAR PAGINAS ==========================*/
	/*=========================================================================*/
	
		$("#frm_add_page").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				lan_id: {required: true, min:1},
				pag_cat_id: {required: true, min:1},
				pag_tit:{required:true,minlength:3, maxlength:100},
				pag_des:{required:true,minlength:3, maxlength:255},
				pag_pos:{required:true,number:true}
			},

			messages: {
				lan_id: { required: "El idioma es obligatorio", min: "Seleccione un Idioma" },
				pag_cat_id: { required: "El campo Categoría es obligatorio", min: "Seleccione una Categoría" },
				pag_tit:{required: " Por favor digite el Título de la Página ", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Titulo No valido"},
				pag_des:{required: " Por favor digite la Descripción de la Página ", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Descripción No valido"},
				pag_pos:{required: " Por favor digite el Orden de la página ", number:"Digite Únicamente números."}
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
		
	/*=========================================================================*/
	/*============================== EDITAR PAGINAS ===========================*/
	/*=========================================================================*/
	
		$("#frm_edit_page").validate({
			onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,
			
			rules: {
				lan_id: {required: true, min:1},
				pag_cat_id: {required: true, min:1},
				pag_tit:{required:true,minlength:3, maxlength:100},
				pag_des:{required:true,minlength:3, maxlength:255},
				pag_pos:{required:true,number:true}
			},

			messages: {
				lan_id: { required: "El idioma es obligatorio", min: "Seleccione un Idioma" },
				pag_cat_id: { required: "El campo Categoría es obligatorio", min: "Seleccione una Categoría" },	
				pag_tit:{required: " Por favor digite el Título de la Página ", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Titulo No valido"},
				pag_des:{required: " Por favor digite la Descripción de la Página ", minlength: "Digite Mínimo 3 Caracteres." , maxlength: "Descripción No valido"},
				pag_pos:{required: " Por favor digite el Orden de la página ", number:"Digite Únicamente números."}
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