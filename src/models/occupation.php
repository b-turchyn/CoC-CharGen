<?php
/************************************************************************
 * Call of Cthulhu Character Generator
 * Copyright (C) 2014 Brian Turchyn
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

class Occupation
{
  private static $occupations = NULL;

  static function getOccupations( ) {
    global $sql;

    if( self::$occupations === NULL ) {
      self::$occupations = $sql->getOccupations( );
      array_unshift( self::$occupations, array( 'key' => 'R', 'value' => 'Random' ) );
      array_unshift( self::$occupations, array( 'key' => 'E', 'value' => 'Random Based On Era' ) );
    }

    return self::$occupations;
  }

  static function getFromEra( $era, $lovecraftian ) {
    global $sql;

    return $sql->getOccupationsFromEra( $era, ( $lovecraftian ? true : false ) );
  }

  static function getValue( $occupation ) {
    $result = get( $occupation );

    return ( $result != NULL ? $result['value'] : NULL );
  }

  static function get( $occupation ) {
    $result = NULL;

    foreach ( self::getOccupations( ) as $value ) {
      if( $value['key'] == $occupation ) {
        $result = $value;
        break;
      }
    }

    return $result;
  }
}
?>
