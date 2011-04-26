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
