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

function delegate( ) {
  // Initial check -- we have a configuration file!
  if(!file_exists(CONFIG_FILE)) {
    header( "HTTP/1.1 307 Temporary Redirect" );
    header( "Location: install/" );

  } elseif( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    // POST requests
    if( isset( $_POST['generate'] ) ) {
    } else {
      header( "HTTP/1.1 404 Not Found" );
      die( );
    }
  } else { // GET requests
    // Default route
    $result = UI . 'char_config.php';
  }
  return $result;
}
?>
