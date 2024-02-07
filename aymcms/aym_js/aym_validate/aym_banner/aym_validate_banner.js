$(document).ready(function() {
	
	/*VALIDACIÓN AGREGAR CATEGORIA*/
	$("#frm_add_banner_category").validate({
		onfocusout: function(element) {$(element).valid()},
		onkeyup: false,
		focusCleanup: true,
		focusInvalid: false,

		rules: {
			lan_id: {required: true, min:1},
			ban_cat_nam: {required: true,minlength:2, maxlength:150},
			ban_cat_des: {required: true,minlength:3, maxlength:255},
			ban_cat_wid:{required:true,minlength:1 ,maxlength:4},
			ban_cat_hei:{required:true,minlength:1, maxlength:4}
		},

		messages: {
			lan_id: { required: "El idioma es obligatorio", min: "Seleccione un Idioma" },
			ban_cat_nam: { required: "Nombre No válido", minlength: "Digite Mínimo 2 Caracteres." },			
			ban_cat_des: { required: "Descripción No válida", minlength: "Digite Mínimo 3 Caracteres." },			
			ban_cat_wid:{required: " Ancho No válido. ", minlength:"Digite maximo 4 Caracteres."},
			ban_cat_hei:{required: " Alto No válido ", minlength:"Digite maximo 4 Caracteres."}
		},				

		// Mensaje de error
		errorPlacement: function(error, element) {				
			element.attr('placeholder', error.text());
			element.val('');
			if(element.is('select')){
				error.insertAfter(element).addClass('aym_placeholder');
				element.on('focus', function () { element.next().remove(); element.unbind('focus'); });
			}
		},
		highlight: function(element) {	
			$(element).parent().addClass('error');
		},
		unhighlight: function(element) {
			$(element).parent().removeClass('error');
		}
	});


	/*VALIDACIÓN AGREGAR BANNER*/
	$("#frm_add_banner").validate({
		onfocusout: function(element) {$(element).valid()},
		onkeyup: false,
		focusCleanup: true,
		focusInvalid: false,
		ignore: '',

		rules: {
			lan_id: {required: true, min:1},
			ban_des: {required: true, minlength:3, maxlength:255},
			ban_pos:{required:true,min:1},
			doc_nom:{required:true},

		},

		messages: {
			lan_id: { required: "El idioma es obligatorio", min: "Seleccione un Idioma" },
			ban_nam: { required: "El campo Nombre es obligatorio", minlength: "Digite Mínimo 3 Caracteres" },
			ban_des: { required: "El campo Descripción es obligatorio", minlength: "Digite Mínimo 3 Caracteres" },	
			ban_pos:{required: " Por favor digite el Orden de la página. ", min:"Digite Únicamente números.."},
			doc_nom:{required: " El archivo es Obligatorio "}
		},				

		// Mensaje de error
		errorPlacement: function(error, element) {				
			element.attr('placeholder', error.text());
			element.val('');
			if(element.is('select')){
				error.insertAfter(element).addClass('aym_placeholder');
				element.on('focus', function () { element.next().remove(); element.unbind('focus'); });
			}
		},
		highlight: function(element) {	
			$(element).parent().addClass('error');
		},
		unhighlight: function(element) {
			$(element).parent().removeClass('error');
		}
	});
	
	/*VALIDACIÓN AGREGAR BANNER*/
	$("#frm_edit_banner").validate({
		onfocusout: function(element) {$(element).valid()},
		onkeyup: false,
		focusCleanup: true,
		focusInvalid: false,
		ignore: '',

		rules: {
			lan_id: {required: true, min:1},
			ban_des: {required: true, minlength:3, maxlength:255},
			ban_pos:{required:true,min:1},

		},

		messages: {
			lan_id: { required: "El idioma es obligatorio", min: "Seleccione un Idioma" },
			ban_nam: { required: "El campo Nombre es obligatorio", minlength: "Digite Mínimo 3 Caracteres" },
			ban_des: { required: "El campo Descripción es obligatorio", minlength: "Digite Mínimo 3 Caracteres" },	
			ban_pos:{required: " Por favor digite el Orden de la página. ", min:"Digite Únicamente números.."},
		},				

		// Mensaje de error
		errorPlacement: function(error, element) {				
			element.attr('placeholder', error.text());
			element.val('');
			if(element.is('select')){
				error.insertAfter(element).addClass('aym_placeholder');
				element.on('focus', function () { element.next().remove(); element.unbind('focus'); });
			}
		},
		highlight: function(element) {	
			$(element).parent().addClass('error');
		},
		unhighlight: function(element) {
			$(element).parent().removeClass('error');
		}
	});
});