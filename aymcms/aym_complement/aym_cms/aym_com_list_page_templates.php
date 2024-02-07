<?php # **************************** AYMCMS V: 7.0 ********************
# COMPLEMENTO PARA LISTAR LOS TEMPLATES DE LAS PAGINAS
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ ENE/31/2023 

	session_start(); 

	$carpeta = $_SERVER['DOCUMENT_ROOT']."/aymcms/aym_template/aym_tem_".$_GET['pag_cat_id'];
	if (is_dir($carpeta)) { //Tells whether the filename is a directory
		if ($handle = opendir($carpeta)) { // Open a known directory, and proceed to read its contents
				while (false !== ($file = readdir($handle))) { 
					if ($file != "." && $file != "..") { 
						if ($_GET['pag_tem'] == $file) { //$row_list_page_category['pag_cat_id']
							{echo '<option value="'.$file.'" SELECTED>'.$file.'</option>';}
						} else {
							{echo '<option value="'.$file.'">'.$file.'</option>';}
						}	
					 } # FIN SI 
				} # FIN WHILE
			closedir($handle); 
		} # FIN SI PUEDE ABRIR EL DIRECTORIO
	} # FIN SI EL DIRECTORIO ESTÁ CREADO

?>