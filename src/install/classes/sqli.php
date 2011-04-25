<?php
/**
 * SQLi Class
 * Handles all database interactions for installation
 *
 * @package src/install
 * @author Brian Turchyn
 */

class SQLiInstall extends mysqli {
  private $handle;

  public function __construct($host, $user, $pass, $database) {
    parent::__construct($host, $user, $pass, $database);
    // Check for errors
    if($this->connect_error()) {
      die("Connection error (" . $this->connect_errno() . ") " . $this->connect_error());
    }
  }
}
?>
