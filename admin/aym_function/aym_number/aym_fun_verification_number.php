<?php # **************************** AYMHUMAN V: 1.0 ********************
# FUNCION PARA CALCULAR EL DIGITO DE VERIFICACIÓN
# © 2023, AYMSOFT SAS
# ADRIAN LOPEZ RODRIGUEZ AGO/02/2023 

function aym_get_vn($aym_nit) {
    
	if (!is_numeric($aym_nit)){ return false; }
 
    $arr = array(1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19, 8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71);
	
    $x = 0;
    $y = 0;
    $z = strlen($aym_nit);
    $aym_vn = '';
	
    for ($i=0; $i<$z; $i++) {
        $y = substr($aym_nit, $i, 1);
        $x += ($y*$arr[$z-$i]);
    }
	
    $y = $x%11;
    
    if ($y > 1) {
        $aym_vn = 11-$y;
      	return $aym_vn;
    } else {
        $aym_vn = $y;
        return $aym_vn;
    }
}


?>