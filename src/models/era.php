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

class Era
{
  public static $ERAS = array(
    array( 'key' => '1890', 'value' => '1890s' ),
    array( 'key' => '1920', 'value' => '1920s' ),
    array( 'key' => '1990', 'value' => '1990s' ),
    array( 'key' => 'dg', 'value' => 'Delta Green' )
  );

  static function getValue( $era ) {
    $result = NULL;

    foreach ( self::$ERAS as $value ) {
      if( $value['key'] === $era ) {
        $result = $value['value'];
        break;
      }
    }

    return $result;
  }
}
?>
