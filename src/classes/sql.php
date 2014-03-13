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

class MySQLQueries extends mysqli {
  // Private instance variables
  private $conn = null; // Connection holder
  private $prefix = "";  // Database table prefixes


  // List of all eras
  const getEras = "SELECT era_id, era_name FROM %seras WHERE deleted_dt IS NULL ORDER BY era_name ASC";
  const getOccupations = "SELECT occupation_id, occupation_name FROM %soccupations ORDER BY occupation_name ASC";

  const getEthnicityCount = 
    "";

  // Count number of first names
  const getFirstNameCount = 
    "SELECT COUNT(*) FROM %snames 
     WHERE isfirst = true
    AND gender = ?
    AND deleted_dt IS NULL";

  // Count number of last names
  const getLastNameCount = 
    "SELECT COUNT(*) FROM %snames 
    WHERE isfirst = false 
    AND deleted_dt IS NULL";

  // Retrieves a specific first name
  const getFirstName = 
    "SELECT name FROM %snames
    WHERE isfirst = true
    AND gender = ?
    LIMIT ?, 1";

  // Retrieves a specific last name
  const getLastName = 
    "SELECT name FROM %snames
    WHERE isfirst = false
    LIMIT ?, 1";

  public function __construct($host, $user, $pass, $database, $prefix) {
		
		$this->prefix = $prefix;
		
    parent::__construct($host, $user, $pass, $database);
    // Check for errors
    if(mysqli_connect_error()) {
      die("Connection error (" . mysqli_connect_errno() . ") " . mysqli_connect_error());
    }
  }

  public function __destruct() {
		mysqli_close($this);
	}

  /**
   * Retrieves the number of ethnicities in the database
   *
   * @return integer >= 0 on success, false on failure
   * @author Brian Turchyn
   */
  public function getEthnicityCount( ) {
    $result = false;
    $stmt = null;
    if( $stmt = $this->prepare($this->preparePrefix(self::getEthnicityCount) ) ) {
      $stmt->execute();
      // Retrieve the result, and return false on failure.
      $stmt->bind_result($res);
      if ( $stmt->fetch() ) {
        $result = $res;
      }
    } else echo $this->error;

    if ( $stmt != null ) {
      $stmt->close();
    }

    return $result;
  }

  /**
   * Retrieves all eras from the database
   *
   * @return array of arrays in key => value layout on success, NULL on failure
   * @author Brian Turchyn
   */
  public function getEras( ) {
    $result = null;
    $stmt = null;

    if( $stmt = $this->prepare($this->preparePrefix(self::getEras) ) ) {
      $stmt->execute();
      // Retrieve the result, and return false on failure.
      $stmt->bind_result($key, $name);
      $result = [];
      while ( $stmt->fetch() ) {
        $result[] = array( 'key' => $key, 'value' => $name );
      }
    } else echo $this->error;

    if ( $stmt != NULL ) {
      $stmt->close();
    }

    return $result;
  }

  /**
   * Retrieves all occupations from the database
   *
   * @return array of arrays in key => value layout on success, NULL on failure
   * @author Brian Turchyn
   */
  public function getOccupations( ) {
    $result = null;
    $stmt = null;

    if( $stmt = $this->prepare($this->preparePrefix(self::getOccupations) ) ) {
      $stmt->execute();
      // Retrieve the result, and return false on failure.
      $stmt->bind_result($key, $name);
      $result = [];
      while ( $stmt->fetch() ) {
        $result[] = array( 'key' => $key, 'value' => $name );
      }
    } else echo $this->error;

    if ( $stmt != NULL ) {
      $stmt->close();
    }

    return $result;
  }


  /**
   * Retrieves all ethnicities from the database
   *
   * @return array of arrays in key => value layout on success, null on failure
   * @author Brian Turchyn
   */
  public function getEthnicities( ) {
    $result = null;
    $stmt = null;

    if( $stmt = $this->prepare($this->preparePrefix(self::getEthnicities) ) ) {
      $stmt->execute();
      // Retrieve the result, and return false on failure.
      $stmt->bind_result($key, $name);
      $result = [];
      while ( $stmt->fetch() ) {
        $result[] = array( 'key' => $key, 'value' => $name );
      }
    } else echo $this->error;

    if ( $stmt != null ) {
      $stmt->close();
    }

    return $result;
  }

  /**
   * Retrieves the number of first names of a particular gender in the database
   *
   * @param string $gender 'M' or 'F' (case-sensitive)
   * @return integer >= 0 on success, false on failure
   * @author Brian Turchyn
   */
  public function getFirstNameCount($gender) {
    $result = false;
    $stmt = null;
    if( $stmt = $this->prepare($this->preparePrefix(self::getFirstNameCount) ) ) {
      $both = 'B';
      $stmt->bind_param("s", $gender);
      $stmt->execute();
      // Retrieve the result, and return false on failure.
      $stmt->bind_result($res);
      if ( $stmt->fetch() ) {
        $result = $res;
      }
    } else echo $this->error;

    $stmt->close();

    return $result;
  }

  /**
   * Retrieves the number of last names in the database
   *
   * @return integer >= 0 on success, false on failure
   * @author Brian Turchyn
   */
  public function getLastNameCount() {
    $result = false;
		$stmt = null;
    if( $stmt = $this->prepare($this->preparePrefix(self::getLastNameCount) ) ) {
      //$stmt->bind_param("ss", $gender, $both);
      $stmt->execute();
      // Retrieve the result, and return false on failure.
      $stmt->bind_result($res);
      if ( $stmt->fetch() ) {
        $result = $res;
      }
    } else echo $this->error;

		$stmt->close();

    return $result;
  }

	/**
	 * Retrieves a specific first name from the database
	 *
	 * @param char $gender Either 'M' or 'F' (case-sensitive)
	 * @param integer $index Optional specific index
	 * @return string on success, boolean false on failure
	 * @author Brian Turchyn
	 */
	public function getFirstName($gender, $index = null) {
		$result = false;
		$stmt = null;

		// Check input. If no indexes for first name is given, generate a random value
		if ( $index == null ) {
			$index = mt_rand(1, $this->getFirstNameCount($gender));
		}
    if( $stmt = $this->prepare($this->preparePrefix(self::getFirstName) ) ) {
      $stmt->bind_param("si", $gender, $index);
      $stmt->execute();
      // Retrieve the result, and return false on failure.
      $stmt->bind_result($res);
      if ( $stmt->fetch() ) {
        $result = $res;
      }
    } else echo $this->error;

		$stmt->close();

	  return $result;
	}
	
	/**
	 * Retrieves a specific last name from the database
	 *
	 * @param integer $index 
	 * @return string on success, boolean false on failure
	 * @author Brian Turchyn
	 */
	public function getLastName($index = null) {
		$result = false;
		$stmt = null;

		// Check input. If no index for last name is given, generate a random value
		if ( $index == null ) {
			$index = mt_rand(1, $this->getLastNameCount());
		}
    if( $stmt = $this->prepare($this->preparePrefix(self::getLastName) ) ) {
      $stmt->bind_param("i", $index);
      $stmt->execute();
      // Retrieve the result, and return false on failure.
      $stmt->bind_result($res);
      if ( $stmt->fetch() ) {
        $result = $res;
      }
    } else echo $this->error;

		$stmt->close();

	  return $result;
	}

	/**
	 * Generates a full name, either a specific index or a random one
	 *
	 * @param char $gender Either 'M' or 'F' (case-sensitive)
	 * @param integer $first optional first name index
	 * @param integer $last optional last name index
	 * @return string on success, false on failure
	 * @author Brian Turchyn
	 */
	public function getFullName($gender, $first = null, $last = null) {
    return $this->getFirstName($gender, $first) . " " . $this->getLastName($last);
  }

	/**
	 * Prepares the query to populate the DB table prefixes
	 *
	 * @param string $query 
	 * @return string query with the database prefix
	 * @author Brian Turchyn
	 */
	private function preparePrefix($query) {
		return preg_replace("/%s/", $this->prefix, $query);
	}
}
?>
