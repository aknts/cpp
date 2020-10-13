<?php

class Core {

	function listTemplates ($templatesDir) {
	
	$templates = array_diff(scandir($templatesDir), array('..', '.'));
	return $templates;
	
	}
	
	function makeConfig ($template, $ext, $pwd, $sipsrv, $sipsrvport) {
	
		$config = htmlentities(file_get_contents('files/templates/'.$template));
		$config = str_replace("#ext#",$ext,$config);
		$config = str_replace("#pwd#",$pwd,$config);
		$config = str_replace("#sipsrv#",$sipsrv,$config);
		$config = str_replace("#sipsrvport#",$sipsrvport,$config);
		$config = html_entity_decode($config);
		return $config;
	
	}
	
	function writeConfig ($config,$filename) {
	
		$myfile = fopen("files/configurations/".$filename, "w") or die("Unable to open file!");
		fwrite($myfile, $config);
		fclose($myfile);
		
		$myfile = fopen("/tftpboot/".$filename, "w") or die("Unable to open file!");
		fwrite($myfile, $config);
		fclose($myfile);
		
	}
}
?>
