<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCION PARA LIMPIAR CADENAS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

function aym_clean_especial_characters($string) {
	  $aym_special = array("'", "`", "´", ",", "$", "(", ")", "<", ">", "<?", "<?php", "?>", "^", "¨", "\"");
      $string = strip_tags($string);
	  $string = addslashes($string);
	  $string = str_replace($aym_special, "", $string);
	  
	  //mysql_real_escape_string($string);  si llevaremos esto a mySQL deberímos agregar al final 
      return stripslashes($string);
}
?>