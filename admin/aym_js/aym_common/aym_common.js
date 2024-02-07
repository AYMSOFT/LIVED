function aym_active(aym_link){
	var link = document.querySelector('a[href^="'+aym_link+'"]');
	if (link) {
		link.classList.add("active");
	}
}
$(window).on("load",function(){
	$('#aym_loading').fadeOut();
	
	$('input, select').each(function(){
		var element = $(this);
		var parent = $(this).parent();
		if (element.val() === '') {
			parent.removeClass('filled');	
		}else{
			if(!parent.hasClass('aym_response')){
				parent.addClass('filled');
			}
		}
	})
});


$(function(){

	/*FUNCTIONS INPUTS AND LABELS*/
	$('body').on('focus', 'input, select',function() {
		$(this).parent().addClass('focused filled');
	});
	
	$('body').on('click', 'label',function() {
		$(this).siblings('input, select').focus();
	});
	
	$('body').on('blur change', 'input, select', function() {
		var element = $(this);
		var parent = $(this).parent();
		setTimeout(function(){
			if (element.val() == '') {
				parent.removeClass('filled');	
			}else{
				parent.addClass('filled');
			}
		}, 300);
		parent.removeClass('focused');
	});	
	
	// $('img').each(function(){  
	// 	$(this).attr('src',$(this).attr('src')+ '?' + (new Date()).getTime());  
	// });
	
	$('#aym_tamano_pagina, #lan_id').on('change', function(){
		$('a').each(function(){  
			var attr = $(this).attr('url');
			if (typeof attr !== typeof undefined && attr !== false) {
				$(this).attr('url',$(this).attr('url')+ '?' + (new Date()).getTime());  
			}
		});
	});

	$('a').each(function(){  
		var attr = $(this).attr('url');
		if (typeof attr !== typeof undefined && attr !== false) {
			$(this).attr('url',$(this).attr('url')+ '?' + (new Date()).getTime());  
		}
	});
	
	$('body').click(function(){
		$('.aym_tooltip_menu, .aym_wrap_menu nav.active, #aym_show_filter.active').removeClass('active');
		$('.aym_toggle.on:not(#aym_close_aside,#aym_menu_aside), .filter').removeClass('on');
		if($('#aym_search_results').has('attr', 'style')){
			$('#aym_search_results').fadeOut();
		}
		
	});
	
	$('.aym_user_name, .aym_toggle, #aym_wrap_cog figure, #aym_wrap_list_flight figure, #aym_show_filter, .aym_tooltip_menu').click(function(e){
		e.stopPropagation();
	});
	
	/* ================================================================================ */
	/* ============================ MOSTRAR CONTRASEÑA ================================ */
	/* ================================================================================ */	
	
	$('.sho_pwd').click(function(){
		if($(this).siblings('input').attr('type') === 'password'){
			$(this).siblings('input').attr('type', 'text');
		}else{
			$(this).siblings('input').attr('type', 'password');
		}
	});
	
	
	/* ================================================================================ */
	/* ============================ VENTANA MODAL ===================================== */
	/* ================================================================================ */	
	
	$("body").on("click",'.aym_modal_info',function(e){		
		e.stopPropagation();
		var aym_url = $(this).attr("url");
		AyM_window.load(aym_url);
	});

	$("body").on("click",'.aym_modal_edit',function(e){		
		e.stopPropagation();
		var aym_url = $(this).attr("url");
		AyM_window_Edit.load(aym_url);
	});
	
	
	$("body").on("click",".aym_window-closebtn",function(){
		$(".aym_window-modal").fadeTo(200,0);
	});
	
	/* INFORMACIÓN USUARIO */
	$('#aym_wrap_user .aym_user_name').click(function(){
		$(this).siblings('.aym_tooltip_menu').toggleClass('active');
		if($('#aym_wrap_cog .aym_tooltip_menu').hasClass('active')){
			$('#aym_wrap_cog .aym_tooltip_menu').removeClass('active');
		}
	});
	
	/*AYUDA Y CONFIGURACIÓN*/
	$('#aym_wrap_cog figure').click(function(){
		$(this).siblings('.aym_tooltip_menu').toggleClass('active');
		if($('#aym_wrap_user .aym_tooltip_menu').hasClass('active')){
			$('#aym_wrap_user .aym_tooltip_menu').removeClass('active');
		}
	});
	
	/* INFORMACIÓN VUELOS */
	$('#aym_wrap_list_flight figure').click(function(){
		$('#aym_aside_flight').toggleClass('active');
	});
	
	
	$('#aym_search_flight_aside').on('keyup', function(){
		var aym_tex_sea = $(this).val();
	
		if(aym_tex_sea.length>2 || aym_tex_sea == ''){
			$.ajax({
				// INCLUSIÓN --> COMPLEMENTO QUE LISTA LAS CATEGORIAS DE LOS PROYECTOS
				url: "/admin/aym_complement/aym_flight/aym_com_list_flight_aside.php",
				cache:false,
				timeout: 5000,
				type: "POST",
				data:{aym_tex_sea:aym_tex_sea},
				success: function(aym_response){
					$('#aym_response_flight_aside').html(aym_response);
				},
				error:function(jqXHR, textStatus){
					if(textStatus == 'timeout'){     
						alert(' El tiempo de espera ha superado 5 segundos. \n\n El sistema intentará procesar la solicitud nuevamente');         
					} else {
						alert("Failure");
						location.reload();
					}
				}
			});
		}
	});
	
	
	/*AÑADIR COLUMNAS EN LISTA*/
	$('.aym_wrap_list .aym_toggle.list').click(function(){
		$(this).siblings('.aym_tooltip_menu').toggleClass('active');
		$(this).toggleClass('on');
	});
	
	/*MOSTRAR FILTROS RESPONSIVE*/
	$('.aym_wrap_list .aym_toggle.filter').click(function(){
		//$(this).parent().siblings('#aym_show_filter').toggleClass('active');
		$('#aym_show_filter').toggleClass('active');
		$(this).toggleClass('on');
	});

	/*MOSTRAR ASIDE RESPONSIVE*/
	$('#aym_menu_aside').click(function(){
		$('aside').toggleClass('active');
		$(this).toggleClass('on');
	});
	
	/*CERRAR ASIDE*/
	$('#aym_close_aside').click(function(){
		$('aside, #aym_logo').toggleClass('close');
		$(this).toggleClass('on');
		if(!$(this).hasClass('on')){
			$('#aym_logo img:nth-child(1)').attr('src', '/admin/aym_image/aymhuman_logo_blue.png');
		}else{
			$('#aym_logo img:nth-child(1)').attr('src', '/admin/aym_image/aymhuman_logo_white.png');
		}
	});
	
	/*MOSTRAR SUBMENU RESPONSIVE*/
	$('.aym_wrap_menu .aym_toggle').click(function(){
		$(this).siblings('nav').toggleClass('active');
		$(this).toggleClass('on');
	});
	
	
	
		
	$("[id*=frm_], [id*=frm_]").on('click','.aym_frm_image, .aym_frm_file',function(){
		var input = $(this).siblings('.aym_file');
		input.click();
	});
	
	// Cuando cambie #fichero
	$("[id*=frm_], [id*=frm_]").on('change','.aym_file',function(){
		if($(this).parent().hasClass('aym_frm_images') || $(this).parent().parent().hasClass('aym_frm_images')){
			if(validarExtensionImagen(this)) {
				verImagen(this);
			}
		}else{
			if(validarExtensionFile(this)) {
				verArchivo(this);
			}
		}
	});

	/* -------------- AL CARGAR UNA IMAGEN ------------- */
	$('#con_ima').change(function() {
		$('#aym_image_caption').slideDown('fast');
		$('#aym_image_thumb').slideDown('fast');
	});
	
	/*IMAGEN EN MODAL*/
	$('[id*=frm_], [id^=aym_list_]').on('click','#aym_load_image', function() {
		$('#aym_load_opacity').css('display','block');
		var aym_url = $(this).attr("url");
		AyM_window.img(aym_url);
		$('#aym_load_opacity').css('display','none');
	});
	
	/*JUST NUMBER*/
	$('input[type=number]').on('keypress', function data_number() {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	
	/*MONEY FORMAT WITH DECIMALS*/
	$('body').on('blur', '.aym_amount', function(event) {
		$(event.target).val(function(index, value) {
			if (value.indexOf('.') < 0 && value != '') {
				value += '.00';
			}else if(value.split('.').pop().length < 2  && value != ''){
				value += '0';
			}
			return value.replace(/\D/g, "")
						.replace(/([0-9])([0-9]{2})$/, '$1.$2')
						.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
		});
	});
	
	$('body').on('focus', '.aym_amount', function(event) {
		$(event.target).val(function(index, value) {
			return value.replace(/(\,)/g, "");
		});
		$(this).select();
	});
	
	/*MONEY FORMAT WITHOUT DECIMALS*/
	$('body').on('blur', '.aym_ide', function(event) {
		$(event.target).val(function(index, value) {
			return value.replace(/\D/g, "")
						.replace(/([0-9])([0-9]{3})$/, '$1.$2')
						.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
		});
	});
	$('body').on('focus', '.aym_ide', function(event) {
		$(event.target).val(function(index, value) {
			return value.replace(/(\.)/g, "");
		});
		$(this).select();
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
	
	/* FUNCIÓN QUE AL DARLE CLICK ABRE LA MODAL PARA ACTUALIZAR IMAGEN DE PERFIL */
	
	$('.aym_tooltip_menu figure > span').on('click', function(){
		var aym_url = '/admin/aym_module/aym_user/aym_edit_user_image.php';
		AyM_window.load(aym_url);
	});
	
	
	/* EXTENSION FUNCTION checkForm JQUERY VALIDATE PARA VALIDAR ELEMENTOS EN ARRAY */
	$.extend( $.validator.prototype, {
		checkForm: function () {
		this.prepareForm();
			for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
				if (this.findByName(elements[i].name).length != undefined && this.findByName(elements[i].name).length > 1) {
					for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
						this.check(this.findByName(elements[i].name)[cnt]);
					}
				} else {
					this.check(elements[i]);
				}
			}
		return this.valid();
		}
	});
	
	//=========================================
	//============== FORMATO FECHA ============
	//=========================================
	// CONFIGURAMOS TEXTO EN ESPAÑOL
	$.datepicker.regional['es'] = {
		prevText: '<', prevStatus: 'Ver todo el mes anterior',
		nextText: '>', nextStatus: 'Ver todo el mes siguiente',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss',
		currentText: 'Ahora',
		closeText: 'Listo',
	};

	$.datepicker.setDefaults($.datepicker.regional['es']);// APLICAMOS TEXTO EN ESPAÑOL
	$.timepicker.setDefaults($.datepicker.regional['es']);// APLICAMOS TEXTO EN ESPAÑOL

	// CALENDARIO GENERAL SIN BLOQUEO
	$(".aym_calendar").datepicker({changeMonth: true,changeYear: true,inline: true});
	// CALENDARIO GENERAL CON BLOQUEO AL DIA ACTUAL
	$(".aym_calendar_limit").datepicker({changeMonth: true,changeYear: true,inline: true,minDate:0});
	// PICKER DE SOLO HORAS
	$('.aym_time').timepicker({timeText: '',});
	
	
	// CALENDARIO DEFINIENDO EL ID INICIAL SIN BLOQUEO
	$('[id*=dat_ini]').datepicker({changeMonth: true,changeYear: true,inline: true,});
	// CALENDARIO DEFINIENDO EL ID FINAL SIN BLOQUEO
	$('[id*=dat_fin]').datepicker({changeMonth: true,changeYear: true,inline: true,});
	

	// CALENDARIO CON HORA DEFINIENDO EL ID INICIAL
	$('[id*=dat_tim_ini]').datetimepicker({changeMonth: true,changeYear: true,inline: true,defaultDate: new Date(),});
	// CALENDARIO CON HORA DEFINIENDO EL ID FINAL
	$('[id*=dat_tim_fin]').datetimepicker({changeMonth: true,changeYear: true,inline: true,defaultDate: new Date(),});
	
	
	// CALENDARIO CON HORA DEFINIENDO EL ID INICIAL CON INTERVALO DE 15 MINUTOS
	$('[id*=dat_int_tim_ini]').datetimepicker({changeMonth: true,changeYear: true,inline: true, stepMinute: 15,  hourMin: 8, hourMax: 18 });
	// CALENDARIO CON HORA DEFINIENDO EL ID FINAL CON INTERVALO DE 15 MINUTOS
	$('[id*=dat_int_tim_fin]').datetimepicker({changeMonth: true,changeYear: true,inline: true, stepMinute: 15,  hourMin: 8, hourMax: 18});
	
	
	

	/* ================================================================================ */
	/* ========================= FUNCIONALIDAD DE EDITAR  ============================= */
	/* ================================================================================ */
	
	$("[id^=frm_edit_]").on("click", "#aym_form_edit span", function(){
		var aym_parent = $(this).closest('fieldset');

		if(aym_parent.hasClass('aym_edit')){
			aym_parent.removeClass('aym_edit');
			aym_parent.find('select, input, textarea').each(function(){
				$(this).removeAttr('disabled');
			});
			aym_parent.find('.aym_frm_submit').removeClass('aym_hidden');

		}else{
			aym_parent.addClass('aym_edit');
			aym_parent.find('select, input, textarea').each(function(){
				$(this).attr('disabled','disabled');
			});
			aym_parent.find('.aym_frm_submit').addClass('aym_hidden');
		}
	});


	$('#pay_met_id').on('change', function(){
		var id = $(this).val();
		$('.pay_ref_tra').removeClass('aym_hidden');  
		$('#pay_ref_tra').val('');
		if(id == 3){ // PAGOS EN EFECTIVO	
			var d = new Date();
			var time = d.getTime();
			$('.pay_ref_tra').addClass('aym_hidden');  
			$('#pay_ref_tra').val(time);
		}

	});





});

	
/* DROPIMAGE */
	
	function labelOver(element, event) {
		element.style.backgroundColor = "rgba(46,116,154,0.20)";
		event.preventDefault();
	}

	function labelLeave(element, event) {
		element.style.backgroundColor = "#F0F0F2";
		event.preventDefault();
	}

	function labelDrop(element, event){
		event.preventDefault();
		var file = event.dataTransfer.files[0];
		var input = element.nextElementSibling;
		var fileType = file.type;
		if (file){
			input.files = event.dataTransfer.files;
			$(input).change();
		}

	}
	function aym_change(){
		var chargeImage = document.querySelectorAll(".aym_frm_image, .aym_frm_file");
		var i;
		for(i=0; i<chargeImage.length; i++){
			chargeImage[i].addEventListener("dragover", function(e){
				labelOver(this, e);
			},false);

			chargeImage[i].addEventListener("dragleave", function(e){
				labelLeave(this, e);
			},false);

			chargeImage[i].addEventListener("drop", function(e){
				labelDrop(this, e);
			},false);
		}
	}
	
	
	var extensionesValidasImagen = ".png, .gif, .jpeg, .jpg";
	var extensionesValidasFile = ".pdf, .PDF, .doc, .DOC, .docx, .DOCX, .xls, .XLS, .xlsx, .XLSX, .xlsm, .XLSM, .csv";

	// Validacion de extensiones permitidas

	function validarExtensionImagen(datos) {
		
		var ruta = datos.value;
		var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
		var extensionValida = extensionesValidasImagen.indexOf(extension);
		var aym_parent_fil = $(datos).parent().find('.con_ima_thumb');
		var aym_img = aym_parent_fil.find('img');
		if(extensionValida < 0) {
			$(datos).prev().addClass("aym_error_dashed");
			$(datos).parent().append('<p class="aym_file_msg">El archivo .'+extension+' no es una imagen.</p>');
			$(datos).val('');
			aym_parent_fil.removeClass("aym_thumb_img");
			aym_parent_fil.attr('src', "");
			aym_img.attr('src', "/admin/aym_image/aym_icon/aym_add_image.png");			
			return false;
		} else {
			$(datos).prev().removeClass("aym_error_dashed");
			$(datos).next(".aym_file_msg").remove();
			aym_img.attr('src', "");
			aym_parent_fil.attr('src', ruta);
			aym_parent_fil.addClass("aym_thumb_img");
			return true;
		}
	}
	function validarExtensionFile(datos) {
		
		var ruta = datos.value;
		var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
		var extensionValida = extensionesValidasFile.indexOf(extension);
		var aym_parent_fil = $(datos).parent().find('.con_ima_thumb');
		var aym_img = aym_parent_fil.find('img');
		if(extensionValida < 0) {
			$(datos).prev().addClass("aym_error_dashed");
			$(datos).parent().append('<p class="aym_file_msg">El archivo .'+extension+' no es permitido.</p>');
			$(datos).val('');
			aym_parent_fil.removeClass("aym_thumb_img");
			aym_parent_fil.attr('src', "");
			aym_img.attr('src', "/admin/aym_image/aym_icon/aym_add_image.png");			
			return false;
		} else {
			$(datos).prev().removeClass("aym_error_dashed");
			$(datos).next(".aym_file_msg").remove();
			aym_img.attr('src', "");
			aym_parent_fil.attr('src', ruta);
			aym_parent_fil.addClass("aym_thumb_img");
			return true;
		}
	}
	// Vista preliminar de la imagen.
	function verImagen(datos) {
		var aym_parent_fil = $(datos).parent().find('.con_ima_thumb');

		var aym_img = aym_parent_fil.find('img');
		if (datos.files && datos.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				aym_img.attr('src', e.target.result);
			};
			reader.readAsDataURL(datos.files[0]);
		}
	}	

	// Vista preliminar de ARCHIVOO.
	function verArchivo(datos) {
		var aym_parent_fil = $(datos).parent().find('.con_ima_thumb');

		var aym_img = aym_parent_fil.find('img');
		if (datos.files && datos.files[0]) {
			var reader = new FileReader();
			var extension = datos.value.substring(datos.value.lastIndexOf('.') + 1).toLowerCase();
			reader.onload = function () {
				aym_img.attr('src', '/admin/aym_image/aym_icon/aym_ico_'+extension+'.png');
			};
			reader.readAsDataURL(datos.files[0]);
		}
	}
	
	/*================================================================================== 
	================================ FUNCIÓN TABS  ======================================= 
	==================================================================================== */
	function open_tab(evt, tab) {
		var i, aym_tab_content, aym_tab_link;
		aym_tab_content = document.getElementsByClassName("aym_tab_content");
		for (i = 0; i < aym_tab_content.length; i++) {
			aym_tab_content[i].style.display = "none";
		}
		aym_tab_link = document.getElementsByClassName("aym_tab_link");
		for (i = 0; i < aym_tab_link.length; i++) {
			aym_tab_link[i].className = aym_tab_link[i].className.replace(" active", "");
		}
		document.getElementById(tab).style.display = "block";
		evt.currentTarget.className += " active";
	}

	function search_item(){
		/*========================================
		========== FILTRAR AL ESCRIBIR ============
		========================================= */  

		$('#aym_search_item').keyup(function(){
			if( jQuery(this).val() != ""){
				jQuery(".aym_table_search tbody>tr").hide();
				jQuery(".aym_table_search td:search-word('" + jQuery(this).val() + "')").parent("tr").show();
			}
			else{
				jQuery(".aym_table_search tbody>tr").show();
			}
		});
		jQuery.extend(jQuery.expr[":"], 
		{
			"search-word": function(elem, i, match, array) {
				return (elem.textContent || elem.innerText || jQuery(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
			}
		});
		$('#cat_id').val('0');
	}

	function search_item_category(id){
		/*=====================================================
		========== FILTRAR AL SELECCIONAR CATEGORIA ============
		====================================================== */ 
		if(id === '0'){
			jQuery(".aym_table_search tbody>tr").show();
		}else{
			$('.aym_table_search tbody').children("tr:gt(0)").each(function () {
				// datos de la tabla
				var data = $(this).attr("data-id");
				if(data == id){
					$(this).show();
				}else{
					$(this).hide();
				}
			});
		}
		
	}


	/*=================================================================================
	================================ FORMATO DE NÚMERO ==============================
	================================================================================= */
	function format(input) {
		var num = input.value.replace(/\./g,'');
		if(!isNaN(num)){
			num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			num = num.split('').reverse().join('').replace(/^[\.]/,'');
			input.value = num;
		}
	}




	/*=================================================================================
	================================ ALERTAS EN SISTEMA ===============================
	================================================================================= */

	function aym_push_common(aym_response,aym_request_response){


		try {
			aym_response=JSON.parse(aym_response);
			var aym_duration = 5000;
			if(aym_response.aym_duration)
				aym_duration = aym_response.duration;
			if(aym_response.aym_push){
				switch (aym_response.aym_push) {
				case 'success':
					Alert.success(aym_response.Msg,aym_response.aym_title,{displayDuration: aym_duration, pos: 'top'});
					break;
				case 'error':
					Alert.error(aym_response.Msg,aym_response.aym_title,{displayDuration: aym_duration, pos: 'top'});
					break;
				case 'info':
					Alert.info(aym_response.Msg,aym_response.aym_title,{displayDuration: aym_duration, pos: 'top'});
					break;
				case 'warning':
					Alert.warning(aym_response.Msg,aym_response.aym_title,{displayDuration: aym_duration, pos: 'top'});
					break;
				case 'delete':
					Alert.delete(aym_response.Msg,aym_response.aym_title,{displayDuration: aym_duration, pos: 'top'});
					break;
				default:
					console.log(`Sorry, we are out of ${expr}.`);
				}		
			}	
			console.log(aym_response);
			if(aym_response.aym_modal_close)
					$('.aym_window-closebtn').click();
			if(aym_response.aym_error){
				$('[data_id_padre]').removeClass('error');
				$('[data_id_padre="' + aym_response.aym_error + '"]').addClass('error'); //Pregunta por el div padre para agregar error respuesta json
			}
			//$("#"+aym_request_response).html(aym_response.Msg);
		} catch (error) {
			console.log(aym_response);
		}
		
	}


	var Alert = undefined;
	(function(Alert) {
		var alert, error, trash, info, success, warning, _container;
		info = function(message, title, options) {
			return alert("info", message, title, "fas fa-bullhorn", options);
		};
		warning = function(message, title, options) {
			return alert("warning", message, title, "fas fa-exclamation-triangle", options);
		};
		error = function(message, title, options) {
			return alert("error", message, title, "fas fa-exclamation-circle", options);
		};

		trash = function(message, title, options) {
			return alert("trash", message, title, "fas fa-trash", options);
		};

		success = function(message, title, options) {
			return alert("success", message, title, "fas fa-check", options);
		};
		alert = function(type, message, title, icon, options) {
			var alertElem, messageElem, titleElem, iconElem, innerElem, _container;
			if (typeof options === "undefined") {
			options = {};
			}
			options = $.extend({}, Alert.defaults, options);
			if (!_container) {
			_container = $("#alerts");
			if (_container.length === 0) {
				_container = $("<ul>").attr("id", "alerts").appendTo($("body"));
			}
			}
			if (options.width) {
			_container.css({
				width: options.width
			});
			}
			alertElem = $("<li>").addClass("alert").addClass("alert-" + type);
			setTimeout(function() {
			alertElem.addClass('open');
			}, 1);
			if (icon) {
			iconElem = $("<i>").addClass(icon);
			alertElem.append(iconElem);
			}
			innerElem = $("<div>").addClass("alert-block");
			//innerElem = $("<i>").addClass("fa fa-times");
			alertElem.append(innerElem);
			if (title) {
			titleElem = $("<div>").addClass("alert-title").append(title);
			innerElem.append(titleElem);
			
			}
			if (message) {
			messageElem = $("<div>").addClass("alert-message").append(message);
			//innerElem.append("<i class="fa fa-times"></i>");
			innerElem.append(messageElem);
			//innerElem.append("<em>Click to Dismiss</em>");
		//      innerElemc = $("<i>").addClass("fa fa-times");

			}
			if (options.displayDuration > 0) {
			setTimeout((function() {
				leave();
			}), options.displayDuration);
			} else {
			innerElem.append("<em>Click to Dismiss</em>");
			}
			alertElem.on("click", function() {
			leave();
			});

			function leave() {
			alertElem.removeClass('open');
			alertElem.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
				return alertElem.remove();
			});
			}
			return _container.prepend(alertElem);
		};
		Alert.defaults = {
			width: "",
			icon: "",
			displayDuration: 3000,
			pos: ""
		};
		Alert.info = info;
		Alert.warning = warning;
		Alert.error = error;
		Alert.trash = trash;
		Alert.success = success;
		return _container = void 0;

		})(Alert || (Alert = {}));

		this.Alert = Alert;

		$('#test').on('click', function() {
		Alert.info('Message');
	});

// FUNCION PARA SUBIR A SECCION INPUT CUANDO TENGA ERROR DEL VALIDATE
function SmoothScrollTo(aym_inp_id){
	$("html, body").animate({ scrollTop: $(aym_inp_id).offset().top }, 1200);
}