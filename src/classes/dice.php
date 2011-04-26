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
 * CoC-CharGen
 *
 * @author Brian Turchyn
 * @version 0.01
 **/

/**
 * SingleDie class
 * Emulates a single die with an arbitrary number of sides greater than or equal to 4
 *
 * @author Brian Turchyn
 **/
class SingleDie {
	private $sided = 0;					// Number of sides
	private $currentValue = 1;	// Last rolled value
	private $hasRolled = false;	// Have we rolled before?
	private $loaded = false;		// Is this die valid?
	
	/**
	 * SingleDie constructor
	 * Generates a single die with x number of sides
	 *
	 * @param int Number of sides
	 * @author Brian Turchyn
	 **/
	function __construct($sided) {
		if($sided != null && is_int($sided) && $sided >= 4) {
			$this->sided = $sided;
			$this->loaded = true;
		}
	}
	
	/**
	 * Rolls the die, producing a new random number.
	 *
	 * @return int
	 * @author Brian Turchyn
	 **/
	function roll() {
		$this->currentValue = mt_rand(1, $this->sided);
		$this->hasRolled = true;
		return $this->currentValue;
	}
	
	/**
	 * Returns the last roll made by this die. 
	 *
	 * @return int on success, false on failure
	 * @author Brian Turchyn
	 **/
	function getResult() {
		return ($this->hasRolled ? $this->currentValue : false);
	}
	
	/**
	 * Determines if the current die is valid based on the switch manipulated by the contructor
	 *
	 * @return boolean true on valid, false on invalid
	 * @author Brian Turchyn
	 **/
	function isLoaded() {
		return $this->loaded;
	}
	
	/**
	 * Returns the number of sides that the die has
	 *
	 * @return int >= 4
	 * @author Brian Turchyn
	 **/
	function getSides() {
		return $this->sided;
	}
} // END class SingleDie

/**
 * DicePool class
 * Combines several dice together into a single group. 
 *
 * @author Brian Turchyn
 **/
class DicePool {
	private $pool = array();		// Our pool of dice
	private $add = 0;						// What to add to any roll result
	private $loaded = false;		// Is our dice pool valid?
	private $currentValue = 0;	// The last known good value rolled
	
	/**
	 * Constructor
	 *
	 * @param array of integers for the number of sides each die should have
	 * @param int what should be added to the result
	 * @author Brian Turchyn
	 **/
	function __construct($pool, $add = 0) {
		// Check vars
		$arrayGood = false;
		$addGood = false;
		
		// Load the array. Check it's an array and populate the dice pool
		if(is_array($pool)) {
			if(count($pool) > 0) {
				// This now looks legit. Set the check to true, and flip it
				// to false if a SingleDie fails. 
				$arrayGood = true;
			}
			foreach( $pool as $key => $value) {
				$newDie = new SingleDie($value);
				$this->pool[] = $newDie;
				
				// Check if the SingleDie is valid. If not, bail out. 
				if(!$newDie->isLoaded()) {
					$arrayGood = false;
					break;
				}
			}
		}
		
		// Check if the "add" value is valid.
		// Right now, it just needs to be an integer.
		if(is_int($add)) {
			$this->add = $add;
			// The add value is now considered good
			$addGood = true;
		}
		
		// Consider us loaded only if the array and add were valid
		$this->loaded = ($arrayGood && $addGood);
	}
	
	/**
	 * Rolls the current dice pool if the pool is valid
	 * 
	 * @return int value of all rolls of dice plus the added amount
	 * @author Brian Turchyn
	 **/
	function roll() {
		// Return var. Guilty until proven innocent.
		$result = false;
		
		// Are we all valid?
		if($this->loaded) {
			// Reset the old value to 0.
			$this->currentValue = 0;
			// Run through the dice, roll and add the result
			foreach ( $this->pool as $key => $die ) {
				$this->currentValue += $die->roll();
			}
			// Add the "add" value
			$this->currentValue += $this->add;
		
			// We're all good!
			$result = $this->currentValue;
		}
		return $result;
	}
	
	/**
	 * Returns the last roll made by this die. 
	 *
	 * @return int on success, false on failure
	 * @author Brian Turchyn
	 **/
	function getResult() {
		return ($this->loaded ? $this->currentValue : false);
	}
	
	/**
	 * Determines if the current die is valid based on the switch manipulated by the contructor
	 *
	 * @return boolean true on valid, false on invalid
	 * @author Brian Turchyn
	 **/
	function isLoaded() {
		return $this->loaded;
	}
	
	/**
	 * Returns the number of sides that each die in the dice pool has
	 *
	 * @return array of ints >= 4 on valid pool, boolean false on invalid pool
	 * @author Brian Turchyn
	 **/
	function getSides() {
		$result = false;
		
		if($this->loaded) {
			foreach ($this->pool as $key => $die) {
				$result[] = $die->getSides();
			}
		}
		
		return $result;
	}
} // END class DicePool
?>
