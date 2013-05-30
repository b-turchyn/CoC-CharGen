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

define('CFG_FILE', "../config.php");
define('INS_LOCK', "install.lock");

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
?><?php include '../ui/header.php'; ?>
      <div class="masthead">
        <h3>Call of Cthulhu Character Generator</h3>
      </div>
      <hr>
      <div class="jumbotron">
        <h1>Installer</h1>
      </div>
<?php

if ( file_exists ( INS_LOCK ) )
{
        ?>
      <div class="alert alert-error">
        The installer has been locked. Remove install.lock to reinstall.
      </div>
	<?php
}
elseif(file_exists(CFG_FILE)) {
	?>
      <div class="alert alert-error">
	The configuration file currently exists. Remove the configuration file to continue.
      </div>
	<?php
}
// Check if we'll be able to write the config file
elseif(!file_exists(CFG_FILE) && !(touch(CFG_FILE) && unlink(CFG_FILE))) {
	?>
      <div class="alert alert-error">
	Unable to write the config file. Check folder permissions.
      </div>
	<?php
}
// Check if we'll be able to write the install lock
elseif(!file_exists(INS_LOCK) && !(touch(INS_LOCK) && unlink(INS_LOCK))) {
	?>
      <div class="alert alert-error">
	Unable to write the installer lock. Check folder permissions.
      </div>
	<?php
}
elseif(isset($_POST['coc_install'])) {
	$sql = new SQLiInstall($_POST['coc_host'], $_POST['coc_user'], $_POST['coc_password'], $_POST['coc_database'], $_POST['coc_prefix']);
	echo "Successfully connected to " . $sql->host_info . "<br />";
	
	$failed = false;
	
	// Get the SQL files
	$dir = 'tabledata';
	$files = scandir($dir, 0);
	// Iterate through each file
	foreach($files as $key => $value) {
		if(preg_match("/.sql$/", $value)) {
			// Output the current query being run, and flush the buffer
			echo preg_replace("/.sql$/", "", $value) . " ==> ";
			bufferflush();
			
			// Run the query
			$res = $sql->runQueryFromFile($value);
			
			// Display the result
			if($res == null) {
				echo "<span style=\"color: green\">Passed</span><br />\n";
			} else {
				echo "<span style=\"color: red\">FAILED</span><br />\n";
				$failed = true;
			}
		}
	}
	
	// Only write the config and lock the installer if we've succeeded
	if(!$failed) {
		// TODO: Write the configuration file out
		echo (touch(CFG_FILE) ? "Config created" : "Config creation failed!");
	
		// Lock the installer
		echo (touch(INS_LOCK) ? "Lock created" : "Lock creation failed!");
	}
	
	// Display the overall result
	if(!$failed) {
		echo "<p class='status success'>Completed successfully!</p>";
	} else {
		echo "<p class='status failed'>One or more install queries failed. Your installation of CoC Chargen may not function properly!</p>";
	}
	
} else {
	?>
	<form method='POST'>
          <fieldset>
            <legend>Database Options</legend>
            <label for="coc_host">Server host name</label>
            <input type="text" id="coc_host" name="coc_host">
            <label for="coc_user">Database username</label>
            <input type="text" id="coc_user" name="coc_user">
            <label for="coc_password">Database password</label>
            <input type="text" id="coc_password" name="coc_password">
            <label for="coc_database">Database name</label>
            <input type="text" id="coc_database" name="coc_database">
            <label for="coc_prefix">Table prefix</label>
            <input type="text" id="coc_prefix" name="coc_prefix">
          </fieldset>
          <button type="submit" class="btn" name="coc_install" value="Install">Install</button>
	</form>
      <?php
}
?><?php include '../ui/footer.php'; ?>
