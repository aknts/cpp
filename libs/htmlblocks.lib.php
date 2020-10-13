<?php

class Blocks {

	function templatesList ($templates) {
		$code='<select name="template">';
		foreach ($templates as $template) {
			$code.='<option value="'.$template.'">'.$template.'</option>';
		}
	$code.='</select>';
	return $code;
	}

}
?>