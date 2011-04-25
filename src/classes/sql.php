<?php

class MySQLQueries {
  // List of all eras
  private const $getEras =
    "SELECT * FROM ?eras ORDER BY name ASC";

  // Count number of first names
  private const $getFirstNameCount =
    "SELECT COUNT(*) FROM ?names " +
    "WHERE isfirstname_sw = true " +
    "AND deleted_dt IS NOT NULL";

  // Count number of last names
  private const $getLastNameCount =
    "SELECT COUNT(*) FROM ?names " +
    "WHERE isfirstname_sw = false " +
    "AND deleted_dt IS NOT NULL";

  // Retrieve first and last name from a random index
  private const $getFullName = 
    "SELECT name FROM ?names " +
    "WHERE isfirstname_sw = true " +
    "LIMIT ?, 1 " +
    "UNION SELECT name FROM ?names " +
    "WHERE isfirstname_sw = false " +
    "LIMIT ?, 1 "
}
?>
