<?php
require_once(dirname(__FILE__) . '/../simpletest/autorun.php');
require_once(dirname(__FILE__) . '/../../src/classes/dice.php');

class TestOfSingleDie extends UnitTestCase {
	function testMinimumSidesOfDice() {
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
	
	function testBlankSidesOfDie() {
		$die = new SingleDie("");
		$this->assertFalse($die->isLoaded());
	}
	
	function testTextSidesOfDie() {
		$die = new SingleDie("apple");
		$this->assertFalse($die->isLoaded());
	}
	
	function testBooleanSidesOfDie() {
		$die = new SingleDie(true);
		$this->assertFalse($die->isLoaded());
		
		$die = new SingleDie(false);
		$this->assertFalse($die->isLoaded());
	}
	
	public static function genericDieTest($die, $class) {
		$class->assertTrue($die->isLoaded());
		$theRoll = $die->roll();
		$class->assertIsA($theRoll, Int);
		$class->assertIsA($die->getResult(), Int);
		$class->assertEqual($die->getResult(), $theRoll);
	}
}

class TestOfDicePool extends UnitTestCase {
    function testFirstLogMessagesCreatesFileIfNonexistent() {
    }
}