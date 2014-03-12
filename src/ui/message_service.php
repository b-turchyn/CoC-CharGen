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

if( isset( $_SESSION['messages'] ) ) {
  $msgs = $_SESSION['messages'];

  if( count( $msgs->getErrors( ) ) > 0 ) {
    ?><div class="errors alert alert-danger"><?php
    foreach ( $msgs->getErrors( ) as $message ) {
      ?><p><?php echo htmlspecialchars( $message ); ?></p><?php
    }
    ?></div><?php
  }

  if( count( $msgs->getWarnings( ) ) > 0 ) {
    ?><div class="errors alert alert-danger"><?php
    foreach ( $msgs->getWarnings( ) as $message ) {
      ?><p><?php echo htmlspecialchars( $message ); ?></p><?php
    }
    ?></div><?php
  }

  $msgs->reset( );

  $_SESSION['messages'] = $msgs;
}

?>
