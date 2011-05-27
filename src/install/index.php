<?php
/************************************************************************
 * Call of Cthulhu Character Generator
 * Copyright (C) 2011 Brian Turchyn, Glen Conolly, Tyler Omichinski
 * All references to commercial items copyright their respective owners.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 ************************************************************************/

error_reporting(0);
ini_set('display_errors','Off');

require_once 'classes/sqli.php';

function bufferflush (){
    echo(str_repeat(' ',256));
    // check that buffer is actually set before flushing
    if (ob_get_length()){            
        @ob_flush();
        @flush();
        @ob_end_flush();
    }    
    @ob_start();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>CoC Chargen Installer</title>
	<style type='text/css'>
	body {background:#8CA2D5;font-family: Verdana;font-size:10px;margin: 0;padding: 0;}
	.header {width: 100%; margin: 0; padding: 0;border: 0; background: #5D75AB;}
	.header h1 {text-align:right;margin: 0 0 25px 0;padding:25px;}
	.container {margin: auto; width: 400px;padding: 10px;background:#A0B0D5;position:relative;}
	.label {width: 200px;text-align: right;float:left;height:20px;vertical-align:bottom;padding-top:5px;}
	.input {width: 200px;text-align: left; float:left;height:25px;}
	.status {text-align:center;font-size: 12px;}
	.success {color: green;}
	.failure {color: red;}
	</style>
	
</head>

<body>
	<div class="header"><h1>CoC Chargen Installer</h1></div>
	<div class="container">
<?php

if(isset($_POST['coc_install'])) {
	$sql = new SQLiInstall($_POST['coc_host'], $_POST['coc_user'], $_POST['coc_password'], $_POST['coc_database'], $_POST['coc_prefix']);
	echo "Successfully connected to " . $sql->host_info . "<br />";
	
	$failed = false;
	
	// Get the SQL files
	$dir = 'tabledata';
	$files = scandir($dir, 0);
	// Iterate through each file
	foreach($files as $key => $value) {
		if(preg_match("/.sql$/", $value)) {
			echo preg_replace("/.sql$/", "", $value) . " ==> ";
			bufferflush();
			
			$res = $sql->runQueryFromFile($value);
			
			if($res == null) {
				echo "<span style=\"color: green\">Passed</span><br />\n";
			} else {
				echo "<span style=\"color: red\">FAILED</span><br />\n";
				$failed = true;
			}
		}
	}
	
	if(!$failed) {
		echo "<p class='status success'>Completed successfully!</p>";
	} else {
		echo "<p class='status failed'>One or more install queries failed. Your installation of CoC Chargen may not function properly!</p>";
	}
	
} else {
	?>
	<form method='POST'>
		<div class='label'><label for='coc_host'>Database host:</label></div> <div class='input'><input type="text" name="coc_host" /></div>
		<div class='label'><label for='coc_user'>Database username:</label></div> <div class='input'><input type="text" name="coc_user" /></div>
		<div class='label'><label for='coc_password'>Database password:</label></div> <div class='input'><input type="text" name="coc_password" /></div>
		<div class='label'><label for='coc_database'>Database name:</label></div> <div class='input'><input type="text" name="coc_database" /></div>
		<div class='label'><label for='coc_prefix'>Table prefix:</label></div> <div class='input'><input type="text" name="coc_prefix" /></div>
		<div style='text-align:center'><input type="submit" name="coc_install" value="Install Database" /></div>
	</form>
	<?php
}
?>
	</div>
</body>
</html>