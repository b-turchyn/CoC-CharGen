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
$viewVars = array();

// Perform validation
if( isValid( $params, $msgs ) ) {
  $viewVars['era'] = Era::getValue( $params['era'] );

  $viewVars['player_name'] = $params['player_name'];

  // Generate Basic Information
  $gender = ( $params['gender'] === 'B' ? 
    Gender::$GENDERS[mt_rand(1, 2)] :
    Gender::get( $params['gender'] ) );

  $viewVars['name'] = $sql->getFullName( $gender['key'] );
  $viewVars['gender'] = $gender['value'];
  $viewVars['occupation'] = 'TODO';
  $viewVars['nationality'] = 'TODO';
  $viewVars['age'] = 'TODO';
  $viewVars['birthplace'] = 'TODO';
  $viewVars['colleges_degrees'] = 'TODO';
  $viewVars['mental_disorders'] = 'TODO';

  // Generate Stats
  $stats = new StatGenerator( $params['stat_type'] );
  $stats->roll( );
  $viewVars['stats'] = $stats;

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
  $params['player_name'] = getPostVar( 'player_name' );
  $params['era'] = getPostVar( 'era' );
  $params['stat_type'] = getPostVar( 'stat_type' );
  $params['gender'] = getPostVar( 'gender' );
  $params['fail'] = getPostVar( 'fail' );

  return $params;
}

function getPostVar( $key ) {
  return ( isset( $_POST[$key] ) && strlen( $_POST[$key] ) > 0 ? $_POST[$key] : NULL );
}

function isValid( $params, $msgs ) {
  // Check all variables present
  // TODO: Validate valid values provided
  if( $params['player_name'] == NULL ) {
    $msgs->addError( 'Player Name not provided' );
  }

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
