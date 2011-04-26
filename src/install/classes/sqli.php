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
/**
 * SQLi Class
 * Handles all database interactions for installation
 *
 * @package src/install
 * @author Brian Turchyn
 */

class SQLiInstall extends mysqli {
  private $handle;

  public function __construct($host, $user, $pass, $database) {
    parent::__construct($host, $user, $pass, $database);
    // Check for errors
    if($this->connect_error()) {
      die("Connection error (" . $this->connect_errno() . ") " . $this->connect_error());
    }
  }
}
?>
