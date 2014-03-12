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

class Gender
{
  public static $MALE = 'Male';
  public static $FEMALE = 'Female';
  public static $RANDOM = 'Random';

  public static $GENDERS = array(
    array( 'key' => 'B', 'value' => 'Random' ),
    array( 'key' => 'M', 'value' => 'Male' ),
    array( 'key' => 'F', 'value' => 'Female' )
  );

}
?>
