<?php # **************************** AYMCORE V: 14.0 ********************
# FUNCION PARA CONVERTIR LAS URL EN AMIGABLES
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022 

function aym_friendly_url($aym_url) {
	

	# CONVERTIR A MINUSCULA
	$aym_url = mb_strtolower($aym_url);
	
	
	# REEMPLAZO DE CARACTERES
	$aym_fin = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde;', 'á', 'é', 'í', 'ó', 'ú', 'ñ',  'á', 'é', 'í', 'ó', 'ú', '&Ntilde;', 'Á', 'É', 'Í', 'Ó', 'U', 'N', '---','--', '.-', ',-', '.', '/', '¿', '?', '%', '&');
	$aym_rep = array('a', 'e', 'i', 'o', 'u', 'n','a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'n','a', 'e', 'i', 'o', 'u', 'n', '-','-','-', '-', '', '', '', '', '', 'y');
	$aym_url = str_replace($aym_fin, $aym_rep, $aym_url);
	
	# AGREGAR LOS GUINES 
	$aym_fin = array(' ', '&', '\r\n', '\n', '+'); 
	$aym_url = str_replace ($aym_fin, '-', $aym_url);
	
	
	
	return $aym_url;
	
}
?>