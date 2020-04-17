<?php

// namespace Anax;

namespace Saku\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    /**
     * Just assert something is true.
     */
    public function testInstance()
    {
        $newDice = new Dice();
        $this->assertInstanceOf("\Saku\Dice\Dice", $newDice);
    }
    public function testobject()
    {
        $newDice = new Dice();
        $this->assertIsObject($newDice);
    }

    public function testThrow()
    {
        $newDice = new Dice();
        $throw = $newDice->throw();
        $this->assertIsArray($throw);
    }

    public function testThrowGreater()
    {
        $newDice = new Dice();
        $throw = $newDice->throw();
        $this->assertLessThan(array_sum($throw), 4);
    }

    public function testInstanceHand()
    {
        $newDice = new DiceHand();
        $this->assertInstanceOf("\Saku\Dice\DiceHand", $newDice);
    }

    public function testRoll()
    {
        $newDice = new DiceHand();
        $throw = $newDice->roll();
        $this->assertIsArray($throw);
    }

    public function testifOne()
    {
        $newDice = new DiceHand();
        $handd = $newDice->roll();
        $throw = $newDice->ifOne();
        $this->assertIsBool($throw);
        $found = false;
        foreach ($handd as $value) {
            if ($value == 1) {
                $found = true;
                $this->assertEquals(true, $throw);
            } else {
            // $this->assertEquals($throw, false);
            }
        }
    }

    public function testSum()
    {
        $newDice = new DiceHand();
        $newDice->roll();
        $sum = $newDice->sum();
        $this->assertisInt($sum);
    }

    public function testtotalSum()
    {
        $newDice = new DiceHand();
        $newDice->roll();
        $sum = $newDice->sum();
        $totalsum = $newDice->totalsum();
        $newDice2 = new DiceHand();
        $newDice2->roll();
        $totalsum += $newDice2->totalsum();
        $this->assertLessThan($totalsum, $sum);
    }
}
