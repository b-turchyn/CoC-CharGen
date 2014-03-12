<?php
/************************************************************************
 * Call of Cthulhu Character Generator
 * Copyright (C) 2011-2014 Brian Turchyn
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

class Messages {
  private $errors = array();
  private $warnings = array();

  function reset( ) {
    $this->errors = array();
    $this->warnings = array();
  }

  function addError( $message ) {
    $this->errors[] = $message;
  }

  function addWarning( $message ) {
    $this->warnings[] = $message;
  }

  function getErrors( ) {
    return $this->errors;
  }

  function getWarnings( ) {
    return $this->warnings;
  }

  function hasErrors( ) {
    return count( $this->errors ) > 0;
  }

  function hasWarnings( ) {
    return count( $this->warnings ) > 0;
  }
}

if( !isset( $_SESSION['messages'] ) || !($_SESSION['messages'] instanceof Messages) ) {
  $_SESSION['messages'] = new Messages( );
}
?>
