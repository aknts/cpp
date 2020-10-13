<?php

include ("libs/core.lib.php");
include ("libs/htmlblocks.lib.php");

$core = new Core;
$blocks = new Blocks;

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$csv = array_key_exists('csv', $_POST) ? $_POST['csv'] : NULL;
	$csv = explode("\n", str_replace("\r", "", $csv));
	$csv = array_filter($csv);
	$keys = array('template','ext','pwd','mac','sipsrv','sipsrvport');
	
	foreach ($csv as $entry) {
		$entry = explode(",",$entry);
		$entry = array_combine($keys,$entry);
		$config = $core->makeConfig($entry['template'],$entry['ext'],$entry['pwd'],$entry['sipsrv'],$entry['sipsrvport']);
		// Static filename, needs to be fixed to support multiple vendors
		$core->writeConfig($config,'SEP'.$entry['mac'].'.cnf.xml');
	}

    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;	

}

session_destroy();
ob_flush();


?>
<html>
	<head>
		<title>Provisioning tool for Cisco 79xx</title>
	</head>
	<body>
		<div>
		Installation folder: /var/www/html/cpp<br />
		Tftp folder: /tftpboot<br />
		<?php
			$templatesDir = 'files/templates/';
			$templates = array_slice(scandir($templatesDir),2);
			echo "Available templates<br />";
			foreach ($templates as $value) {
				echo $value.'<br />';
			} 
		?>
		</div>
		<br />
		<form action="<?php basename(__FILE__, '.php') ?>" method="post">
			<b>Insert csv</b><br />
			<label><i>Format: Template filename,Extension number,Extension SIP password,Device's MAC address,SIP server ip,SIP server listening port</i></label><br />
			<textarea name="csv" style="width:600px; height:200px" ></textarea>
			<br/>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>
