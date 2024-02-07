

function init(){

    $(function() {

        /*========================================================================================
        ===========================VALIDACION DE FORMULARIO DE CONTACTO===========================
        =========================================================================================*/
        $("#frm_contact").validate({
            onfocusout: function(element) {$(element).valid()},
			onkeyup: false,
			focusCleanup: true,
			focusInvalid: false,

            rules:{
                con_nam:{required:true,minlength:3},
                con_ema:{required:true,email:true},
                con_tel:{required:true,minlength:8},
                con_com:{required:true,minlength:3},
            },
    
            messages:{
                con_nam:{required:"Por favor digite su Nombre.",minlength:"Por favor digite un Nombre válido."},
                con_ema:{required:"Por favor digite su Correo.",email:"Por favor digite un Correo válido."},
                con_tel:{required:"Por favor digite un Teléfono.",minlength:"Por favor digite un Teléfono válido."},
                con_com:{required:"Por favor digite su Comentario.",minlength:"Por favor digite un Comentario válido."},
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

}
