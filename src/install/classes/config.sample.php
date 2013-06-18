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

class Config
{
  /** Prefix of the database tables */
  private static $prefix = "%prefix%";
  /** Host to connect to */
  private static $dbhost = "%dbhost%";
  /** Username to connect to the database / table with */
  private static $dbuser = "%dbuser%";
  /** Password to use to connect to the database */
  private static $dbpass = "%dbpass%";
  /** Database to use on the server */
  private static $dbdatabase = "%dbdatabase%";

  public static function getDatabasePrefix( )
  {
    return self::$prefix;
  }

  public static function getDatabaseHost( )
  {
    return self::$dbhost;
  }

  public static function getDatabaseUser( )
  {
    return self::$dbuser;
  }

  public static function getDatabasePassword( )
  {
    return self::$dbpass;
  }

  public static function getDatabaseName( )
  {
    return self::$dbdatabase;
  }

}
?>