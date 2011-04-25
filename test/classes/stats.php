<?php
require_once(dirname(__FILE__) . '/../simpletest/autorun.php');
require_once(dirname(__FILE__) . '/../../src/classes/stats.php');

/**
 * TestOfStatGenerator class
 * Test suite for the stat generator. Most testing is done in the DicePool
 * and SingleDie test suites.
 *
 * @package test
 * @author Brian Turchyn
 */

class TestOfStatGenerator extends UnitTestCase {
  function testForValidConstructor() {
    $stats = new StatGenerator();
    $this->assertTrue($stats->isLoaded());
  }

  function testMultiStatTest() {
    for($i = 1;$i <= 50; $i++)
      $this->statsInRange();
  }

  private function statsInRange() {
    $stats = new StatGenerator();
    $stats->roll();

    // STR
    $this->assertWithinMargin(3,$stats->getSTR(), 18);
    // CON
    $this->assertWithinMargin(3,$stats->getCON(), 18);
    // POW
    $this->assertWithinMargin(3,$stats->getPOW(), 18);
    // DEX
    $this->assertWithinMargin(3,$stats->getDEX(), 18);
    // APP
    $this->assertWithinMargin(3,$stats->getAPP(), 18);
    // SIZ
    $this->assertWithinMargin(3,$stats->getSIZ(), 18);
    // INT
    $this->assertWithinMargin(8,$stats->getINT(), 18);
    // EDU
    $this->assertWithinMargin(3,$stats->getEDU(), 18);
    // SAN
    $this->assertWithinMargin(15,$stats->getSAN(), 90);
    // LUK
    $this->assertWithinMargin(15,$stats->getLUK(), 90);
    // IDEA
    $this->assertWithinMargin(40,$stats->getIDEA(), 90);
    // KNOW
    $this->assertWithinMargin(30,$stats->getKNOW(), 105);
    // HP
    $this->assertWithinMargin(3,$stats->getHP(), 18);
  }
}

?>
