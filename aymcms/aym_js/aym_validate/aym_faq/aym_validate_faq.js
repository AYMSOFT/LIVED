$(document).ready(function() {
	
	/*VALIDACIÓN AGREGAR CATEGORIA*/
	$("#frm_add_faq").validate({
		onfocusout: function(element) {$(element).valid()},
		onkeyup: false,
		focusCleanup: true,
		focusInvalid: false,

		rules: {
			faq_cat_id: {required: true},
			faq_que: {required: true,minlength:3, maxlength:255}
		},

		messages: {
			faq_cat_id: { required: "Categoria No válida"},
			faq_que: { required: "Pregunta No válida", minlength: "Digite Mínimo 3 Caracteres.", maxlength: "Digite Mínimo 255 Caracteres." }
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
	
	/*VALIDACIÓN AGREGAR CATEGORIA*/
	$("#frm_add_faq_category").validate({
		onfocusout: function(element) {$(element).valid()},
		onkeyup: false,
		focusCleanup: true,
		focusInvalid: false,

		rules: {
			faq_cat_nam: {required: true,minlength:2, maxlength:150},
			faq_cat_des: {required: true,minlength:3, maxlength:255}
		},

		messages: {
			faq_cat_nam: { required: "Nombre No válido", minlength: "Digite Mínimo 2 Caracteres.", maxlength: "Digite Mínimo 150 Caracteres." },
			faq_cat_des: { required: "Descripción No válida", minlength: "Digite Mínimo 3 Caracteres.", maxlength: "Digite Mínimo 255 Caracteres."}
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