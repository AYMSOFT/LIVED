<?php # **************************** AYMCORE V: 14.0 ********************
# CARGAR ARCHIVOS MULTIPLES ADM PRODUCTOS
# © 2022, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ OCT/10/2022

	session_start(); 


#===============================================================================================
#===============================================================================================
#===============================================================================================
#========================================== PRODUCTO ===========================================
#===============================================================================================
#===============================================================================================
#===============================================================================================
// CARGAR ARCHIVOS PRODUCTOS
if( $_GET['action'] == 'I' || $_GET['action'] == 'U'){

	$aym_dir = $_SERVER['DOCUMENT_ROOT']."/admin/aym_file_tmp/".$_SESSION['use_id']."/";
	// SUBIR ARCHIVO A CARPETA TEMPORAL
	if (!is_dir($aym_dir)) {
    mkdir($aym_dir, 0755, true);
		}
	foreach($_FILES["doc_nom"]['tmp_name'] as $i => $tmp_name)
	{
		//condicional si el fuchero existe
		if($_FILES["doc_nom"]["name"][$i]) {
			$nombre_archivo_ori = $_FILES['doc_nom']['name'][$i];
			$aym_dir = $aym_dir . $nombre_archivo_ori;
			move_uploaded_file($_FILES['doc_nom']['tmp_name'][$i], $aym_dir); 
		}
	}
}

// ELIMINAR ARCHIVO TEMPORAL PRODUCTOS
if( $_GET['action'] == 'IDE' || $_GET['action'] == 'UDE'){
	$aym_dir = $_SERVER['DOCUMENT_ROOT']."/admin/aym_file_tmp/".$_SESSION['use_id']."/";
	$filename = $aym_dir.$_POST['name'];
	unlink($filename);
}


#===============================================================================================
#===============================================================================================
#===============================================================================================
#================================= CTAEGORIA Y SUBCATEGORIA ====================================
#===============================================================================================
#===============================================================================================
#===============================================================================================

// CARGAR ARCHIVOS CATEGORIA Y AGREGAR
if( $_GET['action'] == 'IC' || $_GET['action'] == 'UC' || $_GET['action'] == 'ISC' || $_GET['action'] == 'USC'){

	$aym_dir = $_SERVER['DOCUMENT_ROOT']."/admin/aym_file_tmp/".$_SESSION['use_id']."/";
	// SUBIR ARCHIVO A CARPETA TEMPORAL
	if (!is_dir($aym_dir)) {
    mkdir($aym_dir, 0755, true);
		}
	foreach($_FILES["doc_nom"]['tmp_name'] as $i => $tmp_name)
	{
		//condicional si el fuchero existe
		if($_FILES["doc_nom"]["name"][$i]) {
			$nombre_archivo_ori = $_FILES['doc_nom']['name'][$i];
			$aym_dir = $aym_dir . $nombre_archivo_ori;
			move_uploaded_file($_FILES['doc_nom']['tmp_name'][$i], $aym_dir); 
		}
	}
}

// ELIMINAR ARCHIVO TEMPORAL CTAEGORIAS Y SUBCATEGORIA
if( $_GET['action'] == 'ICDE' || $_GET['action'] == 'UCDE' || $_GET['action'] == 'ISCDE' || $_GET['action'] == 'USCDE'){
	$aym_dir = $_SERVER['DOCUMENT_ROOT']."/admin/aym_file_tmp/".$_SESSION['use_id']."/";
	$filename = $aym_dir.$_POST['name'];
	unlink($filename);
}



?>

