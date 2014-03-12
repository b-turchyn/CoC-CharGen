<?php
/************************************************************************
 * Call of Cthulhu Character Generator
 * Copyright (C) 2013 Brian Turchyn
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

define("ROOT_DIR", "");
define("CLSPATH", ROOT_DIR . "classes/");
define("CONFIG_FILE", ROOT_DIR . "config.php");
define("CONTROLLERS", ROOT_DIR . "controllers/");
define("MODELS", ROOT_DIR . "models/");
define("UI", ROOT_DIR . "ui/");

require_once UI.'routing.php';
require_once CLSPATH.'message_service.php';

// This may end up redirecting us and we may not even continue.
$controller = delegate( );

require_once CONFIG_FILE;
require_once CLSPATH.'backgrounds.php';
require_once CLSPATH.'dice.php';
require_once CLSPATH.'names.php';
require_once CLSPATH.'occupations.php';
require_once CLSPATH.'stats.php';
require_once CLSPATH.'sql.php';

include $controller;

$sql = new MySQLQueries(Config::getDatabaseHost( ), Config::getDatabaseUser( ), Config::getDatabasePassword( ), Config::getDatabaseName( ), Config::getDatabasePrefix( ));

/*
 *$stats = new StatGenerator();
 *$stats->roll();
 *echo $stats->toString();
 *echo $sql->getFullName("M");
 */

?><?php include 'ui/header.php'; ?>
      <div class="masthead">
        <h3>Call of Cthulhu Character Generator</h3>
      </div>
      <hr>
      <div class="jumbotron">
        <h1>Character Roller</h1>
      </div>
<?php include UI . $view; ?>
<?php include 'ui/footer.php'; ?>
