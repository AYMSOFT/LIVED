$(window).on("load", function(){
	$('#aym_loading').fadeOut('slow');
});

$(document).ready(function(){

	/*TOGGLE*/
	$('#aym_wrap_header .aym_toggle').on('click', function(){
		$(this).toggleClass('on');
		$('#aym_wrap_menu .aym_principal_ul').toggleClass('open');
		$('body, html').toggleClass('overflow');
	});

    /* ========= FUNCIÓN (UNICAMENTE NÚMEROS) =========== */
    $('body').on('paste input propertychange', '.aym_clean_number', function data_number() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    /* ========= FUNCIÓN (UNICAMENTE NÚMEROS Y PUNTOS) =========== */
    $('body').on('paste input propertychange', '.aym_clean_number_dot, .aym_amount', function data_number() {
        this.value = this.value.replace(/[^0-9'\.]/g, '');
    });

    /* ========= FUNCIÓN (UNICAMENTE NÚMEROS Y COMAS) =========== */
    $('body').on('paste input propertychange', '.aym_clean_number_point, .aym_amount', function data_number() {
        this.value = this.value.replace(/[^0-9'\,]/g, '');
    });

    /* ========= FUNCIÓN (UNICAMENTE NÚMEROS ,COMAS Y PUNTOS) =========== */
    $('body').on('paste input propertychange', '.aym_clean_number_dot_point, .aym_amount', function data_number() {
        this.value = this.value.replace(/[^0-9'\,\.]/g, '');
    });

    /* ========= FUNCIÓN (UNICAMENTE LETRAS) =========== */
    $('body').on('paste input propertychange', '.aym_clean_string', function () {
        this.value = this.value.toUpperCase();
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });
    /*MAYUSCULAS*/
    $('body').on('paste input propertychange', '.aym_clean_mayus', function () {
        this.value = this.value.toUpperCase();
    });

    /*MAYUSCULAS*/
    $('body').on('paste input propertychange', '.aym_clean_string_mayus', function () {
        this.value = this.value.toUpperCase().replace(/[0-9]+/, '');
    });

    /* ========= FUNCIÓN (UNICAMENTE LETRAS Y NUMEROS) =========== */
    $('body').on('paste input propertychange', '.aym_clean_string_number', function data_number() {
        this.value = this.value.toUpperCase();
        this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '');
    });

    /* ========= FUNCIÓN (UNICAMENTE CORREO) =========== */
    $('body').on('paste input propertychange', '.aym_clean_mail', function () {
        this.value = this.value.replace(/[^0-9A-Za-z‘\@\-\_\.]/g, '');
	});


    // ========================================================================= //
    // ================================ CARRUSEL ================================ //
    // ========================================================================= //
    /* CARRUSEL BANNER PRINCIPAL */
    $('#aym_wrap_banner_carousel').owlCarousel({
        loop: $('#aym_wrap_banner_carousel .aym_item').length > 1 ? true : false,
        margin:0,
        nav:false,
        dots:false,
        items:1,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true
    });
    $('#aym_wrap_banner .aym_prev').click(function() { $('#aym_wrap_banner_carousel').trigger('prev.owl.carousel'); });
    $('#aym_wrap_banner .aym_next').click(function() { $('#aym_wrap_banner_carousel').trigger('next.owl.carousel'); });

    /* CAROUSEL DE LOS TRATAMIENTOS */
    $('#aym_carousel_treatment').owlCarousel({
        loop: $('#aym_carousel_treatment .aym_item').length > 1 ? true : false,
        margin:0,
        nav:false,
        dots:true,
        autoplay:false,
        autoplayTimeout:6000,
        autoplayHoverPause:true,
        responsive:{
            0:{items: 3},
            699:{items: 3.5}
        }
    });
    $('#aym_treatment .aym_prev').click(function() { $('#aym_carousel_treatment').trigger('prev.owl.carousel'); });
    $('#aym_treatment .aym_next').click(function() { $('#aym_carousel_treatment').trigger('next.owl.carousel'); });

    /* CAROUSEL DE LAS EXPERIENCIAS */
    var $owl = $('#aym_carousel_experiences');
    $owl.owlCarousel({
        loop: true,
        nav:false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        animateOut: 'rollOut',
        animateSpeed: 500,
        responsive:{
            0:{items: 3},
            699:{items: 4}
        }
    });
    
    // Función para agregar la clase al último elemento visible y mostrar el texto
    function agregarClaseUltimo() {
        var $ultimoElemento = $owl.find('.owl-item.active').last();
        $ultimoElemento.addClass('ultimo');
    
        var $penultimoElemento = $owl.find('.owl-item.active').eq(-2);
        $penultimoElemento.addClass('penultimo');
    
        var $antepenultimoElemento = $owl.find('.owl-item.active').eq(-3);
        $antepenultimoElemento.addClass('antepenultimo');
    
        var $trasantepenultimoElemento = $owl.find('.owl-item.active').eq(-4);
        $trasantepenultimoElemento.addClass('trasantepenultimo');
    
        // Obtiene los textos asociados al último elemento visible
        var activeElement = $ultimoElemento.find('.aym_item');
        var aym_text_1 = activeElement.data('aym_text_1');
        var aym_text_2 = activeElement.data('aym_text_2');
    
        // Actualiza los textos en el contenedor de texto
        $('.aym_text_experiences .aym_text_1').text(aym_text_1);
        $('.aym_text_experiences .aym_text_2').text(aym_text_2);
    }
    
    // Función para quitar la clase del último elemento visible
    function quitarClases() {
        $owl.find('.owl-item').removeClass('ultimo penultimo antepenultimo trasantepenultimo');
    
        // Reinicia el texto en el contenedor de texto
        $('.aym_text_experiences .aym_text_1').text('');
        $('.aym_text_experiences .aym_text_2').text('');
    }
    
    // Agregar las clases a los elementos y mostrar el texto al cargar la página
    agregarClaseUltimo();
    
    // Quitar las clases y reiniciar el texto cuando cambia la posición
    $owl.on('changed.owl.carousel', function(event) {
        quitarClases(); // Quitamos las clases primero
        setTimeout(agregarClaseUltimo, 50); // Luego las volvemos a agregar con un pequeño retraso
    
        // Actualiza el contador de elementos
        var totalItems = event.item.count;
        var currentIndex = (event.item.index % totalItems) + 1;
        $('#aym_count').text(currentIndex + '/' + totalItems);
    });
    
    /* CAROUSEL DE LOS ALIADOS */
    $('#aym_carousel_partners').owlCarousel({
        loop:false,
        margin:0,
        nav:false,
        dots: true,
        autoplay:false,
        autoplayTimeout:6000,
        autoplayHoverPause:true,
        responsive:{
            0:{ items:2},
            699:{ items:4}
        }
    });
    $('#aym_partners .aym_prev').click(function() { $('#aym_carousel_partners').trigger('prev.owl.carousel'); });
    $('#aym_partners .aym_next').click(function() { $('#aym_carousel_partners').trigger('next.owl.carousel'); });

    // ========================================================================= //
    // ================================ ACCORDION ============================== //
    // ========================================================================= //
    $('.aym_title_accordeon').on('click', function(){
        var id =  $(this).data('id');
        $('.aym_title_accordeon, .aym_content_accordeon').removeClass('active');
        $(this).addClass('active');
        $('#aym_content_accordeon_'+id).addClass('active');
	});

    /* CONTADOR DE CARACTERES TEXTAREA */
	$('.aym_frm_textarea textarea').keyup(function(){
		var aym_max = $(this).attr('maxlength');
		var aym_len = $(this).val().length;
		var parent = $(this).parent();
		if (aym_len >= aym_max){
			parent.attr('data-count','0');
		}else{
			var aym_char = aym_max - aym_len;
			if(aym_char > 20){
				parent.attr('data-count', aym_char).removeClass('limit')
			}else{
				parent.attr('data-count', aym_char).addClass('limit');
			}
		}
	});
	$('.aym_frm_textarea textarea').keyup();

    // VOLVER ARRIBA
	aym_return_top();

    // ========================================================================= //
    // ====================== FORMULARIO DE CONTACTO HOME ====================== //
    // ========================================================================= //
    var contenedores = document.querySelectorAll('.aym_content');
    var botonSiguiente = document.getElementById('aym_span_contact_next');
    var botonAnterior = document.getElementById('aym_span_contact_prev');
    var indiceContenedorVisible = 0;
    var aym_nombre = document.getElementById('con_nam')
    var aym_telefono = document.getElementById('con_tel')
    var aym_email = document.getElementById('con_ema')
    var aym_error = document.getElementById('aym_span_error')
    var aym_error_2 = document.getElementById('aym_span_error_2')

    botonSiguiente.addEventListener('click', function() {
        var inputValido = true;
        if (indiceContenedorVisible === 0) {
            if (aym_nombre.value === "") {
                aym_error.style.display = 'block';
                inputValido = false;
            }else{
                aym_error.style.display = 'none';
            }
        } else if (indiceContenedorVisible === 1) {
            if (aym_telefono.value === "" || aym_email.value === "") {
                aym_error_2.style.display = 'block';
                inputValido = false;
            }else{
                aym_error_2.style.display = 'none';
            }
        }
        if (inputValido) {
            // Oculta el contenedor actual
            contenedores[indiceContenedorVisible].classList.remove('aym_active');
            // Calcula el índice del siguiente contenedor
            indiceContenedorVisible = (indiceContenedorVisible + 1) % contenedores.length;
            // Muestra el siguiente contenedor
            contenedores[indiceContenedorVisible].classList.add('aym_active');
        }
        // Verifica si el contenedor actual tiene la clase "aym_active" y el ID "aym_pos_3"
        if (
            contenedores[indiceContenedorVisible].classList.contains('aym_active') &&
            contenedores[indiceContenedorVisible].id === 'aym_pos_3'
        ) {
            // Oculta el span con ID "aym_span_contact"
            document.getElementById('aym_span_contact_next').style.display = 'none';
        } else {
            // Muestra el span con ID "aym_span_contact" en otros casos
            document.getElementById('aym_span_contact_next').style.display = 'flex';
        }
        // Verifica si el contenedor actual tiene la clase "aym_active" y el ID "aym_pos_1"
        if (
            contenedores[indiceContenedorVisible].classList.contains('aym_active') &&
            contenedores[indiceContenedorVisible].id === 'aym_pos_1'
        ) {
            // Oculta el botón "Anterior"
            botonAnterior.style.display = 'none';
        } else {
            // Muestra el botón "Anterior" en otros casos
            botonAnterior.style.display = 'flex';
        }
    });
    botonAnterior.addEventListener('click', function() {
        // Oculta el contenedor actual
        contenedores[indiceContenedorVisible].classList.remove('aym_active');
        // Calcula el índice del contenedor anterior
        indiceContenedorVisible = (indiceContenedorVisible - 1 + contenedores.length) % contenedores.length;
        // Muestra el contenedor anterior
        contenedores[indiceContenedorVisible].classList.add('aym_active');
        // Muestra el span con ID "aym_span_contact" ya que estamos en pasos anteriores
        document.getElementById('aym_span_contact_next').style.display = 'flex';
        // Verifica si el contenedor actual tiene la clase "aym_active" y el ID "aym_pos_1"
        if (
            contenedores[indiceContenedorVisible].classList.contains('aym_active') &&
            contenedores[indiceContenedorVisible].id === 'aym_pos_1'
        ) {
            // Oculta el botón "Anterior"
            botonAnterior.style.display = 'none';
        } else {
            // Muestra el botón "Anterior" en otros casos
            botonAnterior.style.display = 'flex';
        }
    });
});

function aym_return_top(){
	$('.scroll-to-top').click(function(){ $('body,html').animate({ scrollTop:'0px' },1000); });
	$(window).scroll(function(){
	  if($(this).scrollTop() > 0){ $('.scroll-to-top').addClass('active'); }else{ $('.scroll-to-top').removeClass('active'); }
	});
}