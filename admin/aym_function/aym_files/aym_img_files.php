<?php # ****************************  AYMCORE V: 14.0 ********************
# FUNCION PARA BUSCAR IMAGENES DENTRO DE UN DIRECTORIO
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

function aym_scan_dir($aym_dir){
	// AGREGAMOS DOCUMENT ROOT A LA RUTA
	$aym_dir = $_SERVER['DOCUMENT_ROOT'].$aym_dir;
	// SI EXISTE CARPETA TEMPORAL
	if ( is_dir( $aym_dir ) ) {
		//ESCANEAMOS CARPETA TEMPORAL
		$dir = scandir( $aym_dir );
		//EMPEZAMOS VARIABLE CONTABLE EN 1
		$count = 1;
		//VERIFICAMOS QUE SI TENGA ARCHIVOS
		if ( count( $dir ) > 2 ) {
			foreach ( glob( $aym_dir . "*" ) as $files_dir ) {
				//LIMPIAMOS EL DOCUMEN ROOT
				$files_dir =  str_replace($_SERVER['DOCUMENT_ROOT'], "" , $files_dir);
				//GUARDAMOS EN EL ARRAY
				$array[$count] = $files_dir;
				//+1 CONTADORA
				$count++;
			}
		}
		//RETORNAMOS ARRAY CON NOMBRES DE LOS ARCHIVOS
		return $array;
	}
	else{
		//RETORNAMOS FALSO DONDE NO EXISTA EL DIRECTORIO
		return false;
	}
}


?>

