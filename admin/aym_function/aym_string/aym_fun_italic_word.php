<?php 

	function aym_italic_word($aym_section){
		$aym_array = explode(' ',$aym_section);
		$aym_italic = array_pop($aym_array);
		$aym_string = implode(' ',$aym_array);
		return $aym_string.' <i>'.$aym_italic.'</i>';
	}

	function aym_italic_first_word($aym_section){
		$aym_array = explode(' ',$aym_section);
		$aym_italic = array_shift($aym_array);
		$aym_string = implode(' ',$aym_array);
		return '<i>'.$aym_italic.'</i> '.$aym_string;
	}

?>