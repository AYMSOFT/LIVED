<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCION PARA LIMPIAR CADENAS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

function aym_clean_string($string) {
	$aym_special = array("\"", "\'");
      $string = strip_tags($string);
      //$string = htmlentities($string);
	  $string = addslashes($string);
	  $string = str_replace($aym_special, "&acute;", $string);
	  
	  //mysql_real_escape_string($string);  si llevaremos esto a mySQL deberímos agregar al final 
      return stripslashes($string);
}

function aym_clean_string_url($string){
 
	// The Regular Expression filter
	$reg_exUrl = "/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?/";
 	
	// Check if there is a url in the text
	if(preg_match($reg_exUrl, $string, $url)){
		// make the urls hyper links
		return preg_replace($reg_exUrl, "", $string);
	}else{
	   // if no urls in the text just return the text
	   return $string;
	}
}
function aym_clean_accent ($string) {
	return strtr($string,'àáâãäâçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

?>