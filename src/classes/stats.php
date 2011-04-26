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

require_once(dirname(__FILE__) . '/dice.php');
/**
 * StatGenerator class
 * Uses a collection of dice pools to generate the basic stats for a 
 * character. Standard dice rules have been hard-coded. 
 *
 * @package src
 * @author Brian Turchyn
 */
class StatGenerator {
  private $strPool; // Strength
  private $conPool; // Constitution
  private $sizPool; // Size
  private $dexPool; // Dexterity
  private $appPool; // Appearance
  private $sanPool; // Sanity
  private $intPool; // Intelligence
  private $powPool; // Power
  private $eduPool; // Education

  private $loaded = false; // Check for all valid dice pools. 
  /**
   * Constructor
   * Generates all needed dice pools
   */
  public function __construct() {

    // 3d6 dice pools
    $this->strPool = new DicePool(array(6,6,6),0);
    $this->conPool = new DicePool(array(6,6,6),0);
    $this->powPool = new DicePool(array(6,6,6),0);
    $this->dexPool = new DicePool(array(6,6,6),0);
    $this->appPool = new DicePool(array(6,6,6),0);

    // 2d6+6 dice pools
    $this->sizPool = new DicePool(array(6,6),6);
    $this->intPool = new DicePool(array(6,6),6);

    // 3d6+3 dice pools
    $this->eduPool = new DicePool(array(6,6,6),3);

    // Check if we're all valid
    $this->loaded =
      ( $this->strPool->isLoaded() && $this->conPool->isLoaded() &&
      $this->powPool->isLoaded() && $this->dexPool->isLoaded() &&
      $this->appPool->isLoaded() && $this->sizPool->isLoaded() &&
      $this->intPool->isLoaded() && $this->eduPool->isLoaded() );
  }

  /**
   * Rolls a set of stats by triggering the underlying dice pools. 
   *
   * @return true on success, false on failure
   * @author Brian Turchyn
   */
  public function roll() {
    $result = false;
    // Are we valid?
    if($this->loaded) {
      // Do the rolls!
      $this->strPool->roll();
      $this->conPool->roll();
      $this->powPool->roll();
      $this->dexPool->roll();
      $this->appPool->roll();
      $this->sizPool->roll();
      $this->intPool->roll();
      $this->eduPool->roll();
      $result = true;
    }
    return $result;
  }

  /**
   * Determines if the current stat pool is valid
   * by checking the loaded variable.
   *
   * @return value of $this->loaded
   * @author Brian Turchyn
   */
  public function isLoaded() {
    return $this->loaded;
  }

  /**
   * Getter for the value of the STR dice pool
   *
   * @return int a value between 3 and 18, false on failure
   * @author Brian Turchyn
   */
  public function getSTR() {
    return ($this->loaded ? $this->strPool->getResult() : false);
  }

  /**
   * Getter for the value of the CON dice pool
   *
   * @return int a value between 3 and 18, false on failure
   * @author Brian Turchyn
   */
  public function getCON() {
    return ($this->loaded ? $this->conPool->getResult() : false);
  }

  /**
   * Getter for the value of the POW dice pool
   *
   * @return int a value between 3 and 18, false on failure
   * @author Brian Turchyn
   */
  public function getPOW() {
    return ($this->loaded ? $this->powPool->getResult() : false);
  }

  /**
   * Getter for the value of the DEX dice pool
   *
   * @return int a value between 3 and 18, false on failure
   * @author Brian Turchyn
   */
  public function getDEX() {
    return ($this->loaded ? $this->dexPool->getResult() : false);
  }

  /**
   * Getter for the value of the APP dice pool
   *
   * @return int a value between 3 and 18, false on failure
   * @author Brian Turchyn
   */
  public function getAPP() {
    return ($this->loaded ? $this->appPool->getResult() : false);
  }

  /**
   * Getter for the value of the SIZ dice pool
   *
   * @return int a value between 8 and 18, false on failure
   * @author Brian Turchyn
   */
  public function getSIZ() {
    return ($this->loaded ? $this->sizPool->getResult() : false);
  }

  /**
   * Getter for the value of the INT dice pool
   *
   * @return int a value between 8 and 18, false on failure
   * @author Brian Turchyn
   */
  public function getINT() {
    return ($this->loaded ? $this->intPool->getResult() : false);
  }

  /**
   * Getter for the value of the EDU dice pool
   *
   * @return int a value between 6 and 21, false on failure
   * @author Brian Turchyn
   */
  public function getEDU() {
    return ($this->loaded ? $this->eduPool->getResult() : false);
  }

  /**
   * Getter for the value of SAN (ie. 5xPOW)
   *
   * @return int a value between 15 and 90, false on failure
   * @author Brian Turchyn
   */
  public function getSAN() {
    return ($this->loaded ? $this->powPool->getResult() * 5 : false);
  }

  /**
   * Getter for the value of LUK (ie. 5xPOW)
   *
   * @return int a value between 15 and 90, false on failure
   * @author Brian Turchyn
   */
  public function getLUK() {
    return ($this->loaded ? $this->powPool->getResult() * 5 : false);
  }

  /**
   * Getter for the value of IDEA (ie. 5xINT)
   *
   * @return int a value between 40 and 90, false on failure
   * @author Brian Turchyn
   */
  public function getIDEA() {
    return ($this->loaded ? $this->intPool->getResult() * 5 : false);
  }

  /**
   * Getter for the value of KNOW (ie. 5xEDU)
   *
   * @return int a value between 30 and 105, false on failure
   * @author Brian Turchyn
   */
  public function getKNOW() {
    return ($this->loaded ? $this->eduPool->getResult() * 5 : false);
  }

  /**
   * Getter for the derived value of hit points (ie. (STR + SIZ) / 2)
   *
   * @return int a value between 3 and 18, false on failure
   */
  public function getHP() {
    return ($this->loaded ?
            ($this->strPool->getResult() + $this->sizPool->getResult() ) / 2
            : false);
  }
}
?>
