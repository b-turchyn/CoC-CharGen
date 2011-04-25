<?php
class SingleDie {
	private $sided = 0;
	private $currentValue = 1;
	private $hasRolled = false;
	
	function __construct($sided) {
		if($sided != null && is_int($sided) && $sided >= 4) {
			$this->sided = $sided;
		}
	}
	
	function roll() {
		$this->currentValue = mt_rand(1, $sided);
		$this->hasRolled = true;
		return $this->currentValue;
	}
	
	function getResult() {
		return ($this->hasRolled ? $this->currentValue : false);
	}
}

class DicePool {
	private $pool = array();
	private $add = 0;
	private $loaded = false;
	private $currentValue = 0;
	
	function __construct($pool, $add = 0) {
		// Check vars
		$arrayGood = false;
		$addGood = false;
		
		// Load the array. Check it's an array and populate the dice pool
		if(is_array($pool)) {
			foreach( $pool as $key => $value) {
				$this->pool = new SingleDie($value);
				// The array is now considered good
				$arrayGood = true;
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
	
	function getResult() {
		return ($this->loaded ? $this->currentValue : false);
	}
}
?>