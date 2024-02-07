/* **************************** AYMSHOP V: 6.0 ********************
# SCRIPT PARA LAS FUNCIONALIDADES DE DASHBOARD
# © 2020, AYMSOFT SAS
# DIEGO SUAZA MAY/15/20
*/

$(function() {
    $.datepicker.regional['es'] = {
    prevText: '<', prevStatus: 'Ver todo el mes anterior',
    nextText: '>', nextStatus: 'Ver todo el mes siguiente',
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
    'Jul','Ago','Sep','Oct','Nov','Dic'],
    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']};

    $.datepicker.setDefaults($.datepicker.regional['es']);	
    
    $("#aym_dat_fil").daterangepicker({
        initialText : 'Seleccionar periodo...',
        applyButtonText: 'Aplicar',
        clearButtonText: 'Limpiar',
        cancelButtonText: 'Cancelar',
        
        datepickerOptions: {
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
        },
    }); 

    /*------------- FILTRAR ------------- */
	$(`#aym_filter_form`).on('click',function() {
		Buscar();
	});


}); /*------------- FIN READY FUNCTION  -------------*/



// función para los filtros de fecha en el dashboard
function Buscar(){ 	
	var aym_dat_fil =  $('#aym_dat_fil').val();
	var das_cat_id =  $('#das_cat_id').val();
	var com_id =  $('#com_id').val();
    $('#aym_loading').css('display','flex');
    $('#aym_loading').css('opacity', .6);

    // EN LOS SQL QUE FILTREN POR FECHA 
    // COLOCAR LA SIGUIENTE FUNCION
    //# hago un decode de la fecha
    //#$fecha = json_decode($_POST['aym_dat_fil']);
    // Y LE PASO LOS PARAMETTROS AL SP
    //#'".$fecha->{'start'}." 00:00:00','".$fecha->{'end'}." 23:59:59'

	$.ajax({			
		// URL --> COMPLEMENTO QUE LISTA LOS DISTINTOS TIPOS DE FORMULARIO POR TIPO DE SOLICITUD
		url: "/admin/complement/dashboard/list_dashboard",
		cache:false,
		timeout: 60000,
		type: "POST",
		data: {aym_dat_fil:aym_dat_fil, das_cat_id:das_cat_id, com_id:com_id},
		success: function(aym_response){
			$('#aym_response_dashboard').html(aym_response);
			$('#aym_loading').css('display','none');
			return(false);
		},
		error:function(jqXHR, textStatus){
			if(textStatus == 'timeout'){     
				alert(' El tiempo de espera ha superado 1 minuto. \n\n El sistema intentará procesar la solicitud nuevamente');         
			} 
        }
	});
};