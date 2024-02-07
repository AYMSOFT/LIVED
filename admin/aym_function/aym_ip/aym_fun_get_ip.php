<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCION PARA OBTENER LA IP DE UN USUARIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

function aym_get_ip(){

    if (isset($_SERVER["HTTP_CLIENT_IP"])){
        return $_SERVER["HTTP_CLIENT_IP"];
    } 
	
	elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
  	
	elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
        return $_SERVER["HTTP_X_FORWARDED"];
    } 
	
	elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
	
    elseif (isset($_SERVER["HTTP_FORWARDED"])){
        return $_SERVER["HTTP_FORWARDED"];
    }
	
    else {
        return $_SERVER["REMOTE_ADDR"];
    }

    #return '180.255.255.255';
}# --> FIN DEL PROCESO

?>