<?php # **************************** AYMCORE V: 14.0 ********************
# COMPONENTE PARA BORRAR ARCHIVOS AL SERVIDOR 
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

if($action == 'tmp'){
	$Ruta = $_SERVER[ 'DOCUMENT_ROOT' ] . "/admin/aym_file_tmp/".$_SESSION[ 'use_id' ]."/";
  	// SI EXISTE CARPETA TEMPORAL
  	if (is_dir($Ruta)){
		//ELIMINAMOS ARCHIVOS DE LA CARPETA TEMPORAL
		foreach ( glob( $Ruta . "*" ) as $archivos_carpeta ) {
			unlink( $archivos_carpeta );
		}
		//BORRAMOS CARPETA
		rmdir($Ruta);
  	} 
}
?>