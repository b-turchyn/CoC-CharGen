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

define("CONFIG_FILE","config.php");
define("CLSPATH", "classes/");

if(!file_exists(CONFIG_FILE)) {
  die("Config file does not exist. Run the installer first!");
}

require_once CONFIG_FILE;
require_once CLSPATH.'backgrounds.php';
require_once CLSPATH.'dice.php';
require_once CLSPATH.'names.php';
require_once CLSPATH.'occupations.php';
require_once CLSPATH.'stats.php';
require_once CLSPATH.'sql.php';

$sql = new MySQLQueries("rs5.websitehostserver.net", "bturchyn_chargen", "dummypass", "bturchyn_chargen", "coc_");

$stats = new StatGenerator();
$stats->roll();
echo $stats->toString();
echo $sql->getFullName("F");

?>
