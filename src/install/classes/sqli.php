<?php
/************************************************************************
 * Call of Cthulhu Character Generator
 * Copyright (C) 2011 Brian Turchyn, Glen Conolly, Tyler Omichinski
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
 * SQLi Class
 * Handles all database interactions for installation
 *
 * @package src/install
 * @author Brian Turchyn
 */

require_once dirname(__FILE__) . '/io.php';

class SQLiInstall extends mysqli
{
	/** Holds the table prefix for all tables */
  private $prefix;
  /** Host to connect to */
  private $dbhost;
  private $dbuser;
  private $dbpass;
  private $dbdatabase;

  public function __construct($host, $user, $pass, $database, $prefix)
  {
		
		$this->prefix = $prefix;
		$this->dbhost = $host;
		$this->dbuser = $user;
		$this->dbpass = $pass;
		$this->dbdatabase = $database;
		
    parent::__construct ( $host, $user, $pass, $database );
    // Check for errors
    if ( mysqli_connect_error ( ) )
    {
      die (
      	"<div class=\"alert alert-error\">Connection error (" .
      	mysqli_connect_errno() .
      	") " .
      	mysqli_connect_error() .
      	"</div>"
      );
    }
  }

	/**
	 * Runs a SQL query from the tabledata/ folder
	 *
	 * @param string $filename 
	 * @param string $paramtypes Bind_param based parameter types
	 * @param string $paramvalues The values to bind in
	 * @return An array. Index 0 is the error code (0 on success). Index 1 is
	 * 		   the error text on failure, or the number of rows affected on
	 *		   success.
	 * @author Brian Turchyn
	 */
	public function runQueryFromFile ( $filename, $paramtypes = null, $paramvalues = null )
	{
		// Just in case the database connection has been lost, try to connect once
		// before continuing. If it fails after this, then tough.
		if ( !$this->ping( ) )
		{
			$this->__construct ( $this->dbhost, $this->dbuser, $this->dbpass, $this->dbdatabase, $this->prefix );
		}

		// Get query from the file
		$querytext = sprintf ( FileIO::getFile ( "tabledata/" . $filename ), $this->prefix );
		// Prepare the statement
		if ( $stmt = $this->prepare ( $querytext ) )
		{
			// If we have parameters, bind them to the prepared statement
			if ( $paramtypes && $paramvalues )
			{
				$stmt->bind_param( $types, $values );
			}
			// Let 'er rip!
			$stmt->execute( );
			// Did an error occur?
			if ( $stmt->errno == 0 )
			{
				@$stmt->bind_result ( $res );
				$stmt->fetch( );
			}
			else // An error occurred during the execution of the statement
			{
				$res = array ( $stmt->errno, $stmt->error );
			}
			$stmt->close( );
		}
		else // Failed to prepare the SQL statement
		{
			$res = array ( $this->errno, $this->error );
		}

		// We're done. Return the result.
		return $res;
	}

	/**
	 * Upon destruction of this class, ensure that the current database
	 * connection has been closed cleanly.
	 * 
	 * @author Brian Turchyn
	 */
	public function __destruct( )
	{
		mysqli_close ( $this );
	}
}
?>
