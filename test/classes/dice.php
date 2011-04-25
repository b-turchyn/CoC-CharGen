<?php
require_once(dirname(__FILE__) . '/../simpletest/autorun.php');
require_once(dirname(__FILE__) . '/../../src/classes/dice.php');

/**
 * Test class for SingleDie
 *
 * @package testing
 * @author Brian Turchyn
 **/
class TestOfSingleDie extends UnitTestCase {
	
	/**
	 * Checks the minimum number of sides of a die, 
	 * the result of roll() matches the result of getResult(), 
	 * and the value rolled is valid for 1 <= result <= sides
	 *
	 * @return void
	 * @author Brian Turchyn
	 **/
	function testSidesOfDice() {
		for($i = 0; $i <= 100; $i++) {
			$die = new SingleDie($i);
			if ( $i >= 4 ) {
				self::genericDieTest($die, $this);
				$this->assertWithinMargin(1, $die->getResult(), $die->getSides());
			}
			else {
				$this->assertFalse($die->isLoaded());
			}
		}
	}
	
	/**
	 * Checks to ensure blank values for number of sides are not accepted.
	 * This includes both a blank string and null value. 
	 *
	 * @return void
	 * @author Brian Turchyn
	 **/
	function testBlankSidesOfDie() {
		// Blank value
		$die = new SingleDie("");
		$this->assertFalse($die->isLoaded());
		// NULL value
		$die = new SingleDie(null);
		$this->assertFalse($die->isLoaded());
	}
	
	/**
	 * Checks to ensure text values for number of sides are not accepted.
	 *
	 * @return void
	 * @author Brian Turchyn
	 **/
	function testTextSidesOfDie() {
		$die = new SingleDie("apple");
		$this->assertFalse($die->isLoaded());
	}
	
	/**
	 * Checks to ensure boolean values for number of sides are not accepted.
	 *
	 * @return void
	 * @author Brian Turchyn
	 **/
	function testBooleanSidesOfDie() {
		$die = new SingleDie(true);
		$this->assertFalse($die->isLoaded());
		
		$die = new SingleDie(false);
		$this->assertFalse($die->isLoaded());
	}
	
	/**
	 * Helper method to handle the "usual" checks on a die. 
	 *
	 * @return void
	 * @author Brian Turchyn
	 **/
	public static function genericDieTest($die, $class) {
		$class->assertTrue($die->isLoaded());
		$theRoll = $die->roll();
		$class->assertIsA($theRoll, "Integer");
		$class->assertIsA($die->getResult(), "Integer");
		$class->assertEqual($die->getResult(), $theRoll);
	}
} // END class TestOfSingleDie

class TestOfDicePool extends UnitTestCase {
	function testThreeD6Plus3Logic() {
		$pool = new DicePool(array(6,6,6), 3);
		$this->assertTrue($pool->isLoaded());
		$theRoll = $pool->roll();
		$this->assertIsA($theRoll, "Integer");
		$this->assertIsA($pool->getResult(), "Integer");
		$this->assertEqual($theRoll, $pool->getResult());
	}
	
	// TODO: Write Tests for DicePool
}