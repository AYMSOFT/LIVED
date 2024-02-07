<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCION PARA LIMPIAR LAS URL
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

function aym_clean_url($aym_url) {
	$aym_array = array("http://", "https://", "ftp.", "mailto:", "gopher://", "telnet://");
	$aym_url = str_replace($aym_array,"", $aym_url);
	return ($aym_url);  
}
?>