$(window).resize(function(){
	//alert("Ubicar Menu de Configuracion al reducir la pantalla");
	var aym_width = $(".aym_configuracion").width();
	var aym_position = $(".aym_configuracion").position();
	//alert(aym_position.left);
	var aym_position_left = aym_position.left-aym_width-110;
	if($.browser.mozilla || $.browser.msie){
    	var aym_position_left = aym_position.left-aym_width-110;
	}
	$(".aym_menu_configuracion").css("margin-left",aym_position_left);
});
$(function(){
	
	/*ALINEAR EL MENU DE CONFIGURACION*/
	var aym_width = $(".aym_configuracion").width();
	var aym_position = $(".aym_configuracion").position();
	var aym_position_left = aym_position.left-aym_width-146;
	if($.browser.mozilla || $.browser.msie){
    	var aym_position_left = aym_position.left-aym_width-110;
	}
	$(".aym_menu_configuracion").css("margin-left",aym_position_left);
	
	/*OCULTOS TODOS LOS MENUS DEL HEADER*/
	$(".aym_menu_configuracion").css("margin-top","-102px");
	$(".aym_menu_sesion").css("margin-top","-151px");
	
	/*ACTIVO EL MENU DE CONFIGURACIÓN*/
	$(".aym_configuracion").click(function(){
		$(".aym_sesion_usuario").css("background","none");
		$(this).css("background","#6CB33F");
		if($(".aym_menu_configuracion").is(":visible")){
			$(".aym_menu_configuracion").animate({"margin-top":"-102px",opacity:"hide"},400);
			$(".aym_configuracion").css("background","none");
		}
		else{
			if($(".aym_menu_sesion").is(":visible")){
				$(".aym_menu_sesion").animate({"margin-top":"-151px",opacity:"hide"},400);
				$(".aym_sesion_usuario").css("background","none");
			}
			$(".aym_menu_configuracion").animate({"margin-top":"0",opacity:"show"},500);
		}
	});
	
	/*ACTIVO EL MENU DE USUARIOS*/
	$(".aym_sesion_usuario").click(function(){
		$(".aym_configuracion").css("background","none");
		$(this).css("background","#6CB33F");
		
		if($(".aym_menu_sesion").is(":visible")){
			$(".aym_menu_sesion").animate({"margin-top":"-151px",opacity:"hide"},400);
			$(".aym_sesion_usuario").css("background","none");
		}
		else{
			if($(".aym_menu_configuracion").is(":visible")){
				$(".aym_menu_configuracion").animate({"margin-top":"-102px",opacity:"hide"},400);
				$(".aym_configuracion").css("background","none");
			}
			$(".aym_menu_sesion").animate({"margin-top":"0",opacity:"show"},500);
		}
	});
	
});