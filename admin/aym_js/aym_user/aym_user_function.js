/* **************************** AYMCORE V: 14.0 ********************
# SCRIPT PARA LA ADMINISTRACIÓN DE USUARIOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022
*/

/* BEGIN READY FUNCTION */
$(document).ready(function() {

	/* AL CAMBIAR EL TIPO DE USUARIO, MUSTRA / OCULTA CAMPOS */
	$('#frm_add_user #use_typ_id, #frm_edit_user #use_typ_id').on('change',function(){
	
		var use_typ_id = $(this).val(); 
		
		// CONCICIONAL PARA MOSTRAR OPCIONES 
		$('input[name=cli_id]').val('0');
		$('#emp_tex').val('');
		$('.aym_search_employee').addClass('aym_hidden');
		$('.aym_office').addClass('aym_hidden');
		$('input[name=off_id]').val('0').change();
		$('#use_nam').parent().show();

		if(use_typ_id==1){ // 1 = USUARIO 
			$('.aym_office').removeClass('aym_hidden');
		}else if(use_typ_id==2){ // 2 = EMPLEADO
			$('.aym_search_employee').removeClass('aym_hidden');
			$('#use_nam').val('');
			$('#use_nam').parent().hide();
		}
	});
	
	
	/* AL PRESIONAR EL CANDADO, DESBLOQUEA LA CUENTA DE USUARIO */
	$('#frm_edit_user #aym_unlock_uselog').on('click', function(){

		$(this).toggleClass('unlock');

		if($(this).hasClass('unlock')){
			$('#use_log').removeAttr('readonly');
		}else{
			$('#use_log').attr('readonly', 'true');

		}
	});
	
 
	/* ELIMINAR EL REGISTRO */ 
	$('#aym_list_user').on('click','#aym_delete a.aym_ico_delete',function() {
		var use_id = (this).id;
		new AyM_window('¿Está seguro que desea eliminar este registro?', {
		title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
		titleClass: 'anim warning',
		modal: true,
		buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
		callback: function(id) { 
				if (id > 0) { 
					return false; 
				} else {
					var aym_url = '/admin/actionuser';
					var aym_request_response = 'aym_list_error';
					var aym_data = new Object();
					aym_data.use_id = use_id;
					aym_data.sta_id = $(this).is(':checked') ? 1 : 0;
					aym_data.action = "D";
					aym_data.aym_page =  $("#aym_page").val();
					aym_data.aym_page_size = $("#aym_page_size").val();
					aym_data.aym_order = $("#aym_order").val();
					aym_data.aym_order_type = $("#aym_order_type").val();
					aym_process_component(aym_data,aym_url,aym_request_response); 
				}
			}
		});
	});
	
	/*  ACCION PARA ACTUALIZAR ESTADO */	
	$(".aym_wrap_list").on('click', '.aym_checkbox_status',function() { 

		var object = $(this);
		var aym_url = '/admin/actionuser';
		var aym_request_response = 'aym_list_error';
		var aym_data = new Object();
		aym_data.use_id = object.attr('data-id');
		aym_data.sta_id = $(this).is(':checked') ? 1 : 0;
		aym_data.action = "US";
		aym_data.aym_page =  $("#aym_page").val();
		aym_data.aym_page_size = $("#aym_page_size").val();
		aym_data.aym_order = $("#aym_order").val();
		aym_data.aym_order_type = $("#aym_order_type").val();
		aym_process_component(aym_data,aym_url,aym_request_response); 

	});
	
	/* ACCION DEL CAMBIO TIPO DE USUARIO Y ESTADO */
	
	$("[id^=frm_list_] #use_typ_id,[id^=frm_list_] #sta_id").change(function() {
		$('#aym_load_opacity').css('display','block');
		$('.aym_wrap_list').addClass('preloader');
		var aym_data_module = $('[id^=frm_list_]').attr('data-module');
		var aym_data = $('[id^=frm_list_]').serialize();
		var aym_url = "/admin/complement/"+aym_data_module;
		var aym_request_response = 'aym_list_'+aym_data_module; 
		aym_process_list(aym_data,aym_url,aym_request_response);
	});
	
	
	
	/* CLICK EN LISTA DE RESULTADOS BUSQUEDA */	
	$("#frm_list_user #aym_search_results").on("click", ".aym_user_result", function(){
		var use_des = $(this).find("input").val();
		var use_id = $(this).attr("id");
		var aym_page_size = $('#aym_page_size').val();
		var aym_page = $('#aym_page').val();
		var aym_order = $('#aym_order').val();
		var aym_order_type = $('#aym_order_type').val();
		var use_typ_id = $('#use_typ_id').val();
		var sta_id = $('#sta_id').val();
		$("#aym_search_results").hide();
		$("input[name=aym_tex_sea]").val(use_des);
		window.location.href = '/admin/admuser/aym_edit_user/'+use_id+'/'+sta_id+'/'+use_typ_id+'/'+aym_order+'/'+aym_order_type+'/'+aym_page_size+'/'+aym_page;
	});

	
	/* VALIDA LAS FUNCIONES SELECCIONADAS*/
	$('#frm_per_on_off button').click(function(){
		new AyM_window('¿Seguro que desea Asignar / Quitar los perfiles seleccionados a este usuario?', {
			title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
			titleClass: 'anim warning',
			modal: true,
			buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
			callback: function(id) { 
				if (id > 0) { 
					return false; 
				} else {
					$('#frm_per_on_off').submit();
				}
			} 
		});
	});
	
	/* VALIDA SI VAN VACIAS TODAS LAS FUNCIOONES */
	$('#frm_per_on_off input[type=checkbox]').click(function(){
		
		var element = $(this);
		var cont = 0;
		
		$('#frm_per_on_off input[type=checkbox]').each(function(){
			if($(this).is(':checked')){
				cont++;
			}
		});
		
		if(cont < 1){
			new AyM_window('¿Seguro que desea dejar sin perfiles a este usuario?', {
				title: '<span>ATENCIÓN</span> <img src="/admin/aym_image/aym_icon/aym_ico_alert.png">',
				titleClass: 'anim warning',
				modal: true,
				buttons: [{id: 0, label: 'Si', val: 0}, {id: 1, label: 'No', val:1}], 
				callback: function(id) { 
					if (id > 0) { 
						element.click();
						return false; 
					} else {
						$('#frm_per_on_off').submit();
						return;
					}
				} 
			});
		}
	});
	
	$("#frm_restore_pass #aym_search_results").on("click", ".aym_user_result", function(){
		var use_nam = $(this).find("input").val();
		var use_id = $(this).attr("id");
		$("#aym_search_results").hide();
		$("input[name=use_nam]").val(use_nam);
		$("input[name=use_id]").val(use_id);
		showUserDetails($(this), $(this).text());
	});

	function showUserDetails(var_this, email){
		$("#aym_user_detail").removeClass('aym_hidden');
		$("#aym_user_detail").html('');
		$("#aym_user_detail").html('<label>Email:</label><input class="aym_read_only" name="use_ema" type="email" value="'+email+'" readonly/>');
		$('.aym_hide').toggleClass('aym_hide');
	}




	 /* =========== BUSCAR EMPLEADOS =============== */
	 $('.aym_search_employee #emp_tex').keyup(function(){
		var emp_tex = $('#emp_tex').val();
		$('#cli_id').val(0);
		var res = "";
		if(emp_tex.length>3){
			$.ajax({
				type: 'POST',
				url: '/aymhuman/complement/employee/search_employee',
				data:{aym_tex_sea: emp_tex, emp_sta:1},// 0 INACTIVO -- 1 ACTIVO -- 2 TODOS
				success: function(respuesta){
					if(respuesta===""){
                        res = "<p class='aym_no_result'>No se encontraron resultados.</p>";
					} else {
						res = respuesta;
					}
					$(".aym_search_employee #aym_search_results").html(res);
					$(".aym_search_employee #aym_search_results").show();						
				}
			});
		} else {
			$(".aym_search_employee #aym_search_results").hide();
		}
    });
    
    /* AL SELECCIONAR AL EMPLEADO */
	$(".aym_search_employee #aym_search_results").on("click", ".aym_employee_result", function(){
		var emp_nam = $(this).find('span').eq(0).text();
		var emp_id = $(this).attr("id");
		$(".aym_search_employee #aym_search_results").hide();
		$("#emp_tex").val(emp_nam);
        $("#cli_id").val(emp_id);    
	});
	
	
}); 
/* FIN READY FUNCTION */