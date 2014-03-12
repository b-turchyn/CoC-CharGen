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

// Gather parameters

$msgs = $_SESSION['messages'];
$params = updateParams( );
$view = 'character_sheet.php';

// Perform validation
if( isValid( $params, $msgs ) ) {
  // Perform logic
} else {
$view = 'char_config.php';
}
// Prepare output
$_SESSION['messages'] = $msgs;

/**
 * Retrieves all necessary parameters from the POST request.
 * @author Brian Turchyn
 */
function updateParams( ) {
  $params = array( );
  $params['era'] = ( isset( $_POST['era'] ) ? $_POST['era'] : NULL );
  $params['stat_type'] = ( isset( $_POST['stat_type'] ) ? $_POST['stat_type'] : NULL );
  $params['gender'] = ( isset( $_POST['gender'] ) ? $_POST['gender'] : NULL );
  $params['fail'] = ( isset( $_POST['fail'] ) ? $_POST['fail'] : NULL );

  return $params;
}

function isValid( $params, $msgs ) {
  // Check all variables present
  if( $params['era'] == NULL ) {
    $msgs->addError( 'Era not provided' );
  }

  if( $params['stat_type'] == NULL ) {
    $msgs->addError( 'Roll Type not provided' );
  }

  if( $params['gender'] == NULL ) {
    $msgs->addError( 'Gender not provided' );
  }

  return !$msgs->hasErrors( );
}

?>
