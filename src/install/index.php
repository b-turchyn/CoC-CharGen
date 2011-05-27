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

error_reporting(E_ALL);
ini_set('display_errors','On');

require_once 'classes/sqli.php';

if(isset($_POST['coc_install'])) {
	$sql = new SQLiInstall($_POST['coc_host'], $_POST['coc_user'], $_POST['coc_password'], $_POST['coc_database'], $_POST['coc_prefix']);
	echo $sql->host_info . "<br />";
	
	// Get the SQL files
	$dir = 'tabledata';
	$files = scandir($dir, 0);
	// Iterate through each file
	foreach($files as $key => $value) {
		if(preg_match("/.sql$/", $value)) {
			$res = $sql->runQueryFromFile($value);
			echo preg_replace("/.sql$/", "", $value) . " ==> ";
			if(is_array($res) && $res[0] == 0) {
				echo "<span style=\"color: green\">Passed</span><br />\n";
			} else {
				echo "<span style=\"color: red\">FAILED</span><br />\n";
			}
		}
	}
	
} else {
	?>
	<form method='POST'>
		<label for='coc_host'>Database host:</label> <input type="text" name="coc_host" /><br />
		<label for='coc_user'>Database username:</label> <input type="text" name="coc_user" /><br />
		<label for='coc_password'>Database password:</label> <input type="text" name="coc_password" /><br />
		<label for='coc_database'>Database name:</label> <input type="text" name="coc_database" /><br />
		<label for='coc_prefix'>Table prefix:</label> <input type="text" name="coc_prefix" /><br />
		<input type="submit" name="coc_install" value="Install Database" />
	</form>
	<?php
}
?>
