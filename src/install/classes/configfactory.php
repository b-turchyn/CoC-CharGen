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
/**
 * ConfigFactory Class
 * Builds and writes out the configuration file used for connecting to the
 * database.
 *
 * @package src/install/classes
 * @author Brian Turchyn
 */

require_once 'io.php';

class ConfigFactory
{
  /**
   * Generates a configuration file, to be written out to a file (eventually).
   * 
   * @param $host The server to connect to
   * @param $user The username to connect with
   * @param $pass The password to connect with
   * @param $database The database to use once connected to the server
   * @param $prefix The prefix to attach to all database tables
   * @return A string containing the config file to write on success, boolean
   *         FALSE on failure. 
   *
   * @author Brian Turchyn
   */
  public function generate( $sampleFile, $host, $user, $pass, $database, $prefix )
  {
    // Retrieve the sample file
    $result = FileIO::getFile( $sampleFile );

    // Did we get the file?
    if( $result != false )
    {
      // DB Prefix
      $result = str_replace( "%prefix%", addslashes( $prefix ), $result );
      $result = str_replace( "%dbhost%", addslashes( $host ), $result );
      $result = str_replace( "%dbuser%", addslashes( $user ), $result );
      $result = str_replace( "%dbpass%", addslashes( $pass ), $result );
      $result = str_replace( "%dbdatabase%", addslashes( $database ), $result );
    }

    return $result;
  }

  public function write( $contents, $filename )
  {
    $result = false;
    // Can we touch the file?
    if ( @touch($filename) ) {
      // Attempt to open the file; no reading required. 
      $handle = @fopen($filename, "w");
      
      // If we're in, attempt to write the contents
      if ( $handle ) {
        $result = @fwrite($handle, $contents);
        if ( $result !== false )
          $result = true;
      }
    }
    return $result;
  }
}
?>