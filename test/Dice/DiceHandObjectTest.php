<?php

namespace AreonL\Dice;

use PHPUnit\Framework\TestCase;

// /**
//  * Test cases for class Guess.
//  */
// class DiceHandObjectTest extends TestCase
// {
//     /**
//      * Construct object and verify that the object has the expected
//      * properties, use no arguments.
//      */
//     public function testCreateObject()
//     {
//         $dice = new DiceHand();
//         $this->assertInstanceOf("\AreonL\Dice\DiceHand", $dice);
//     }

//     /**
//      * Test function roll, create Dice hand and a Dice pass into
//      * addDice, roll then get sum of dice
//      */
//     public function testFunctionRoll()
//     {
//         $diceHand = new DiceHand();
//         $dice = new DiceCheat();
//         $this->assertInstanceOf("\AreonL\Dice\DiceHand", $diceHand);

//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getSum();
//         $exp = 6;
//         $this->assertEquals($res, $exp);
//     }

//     /**
//      * Add multiple dices into hand and roll, then get sum
//      */
//     public function testRollMultipleDices()
//     {
//         $diceHand = new DiceHand();
//         $dice = new DiceCheat();
//         $this->assertInstanceOf("\AreonL\Dice\DiceHand", $diceHand);

//         $diceHand->addDice($dice);
//         $diceHand->addDice($dice);
//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getSum();
//         $exp = 18;
//         $this->assertEquals($res, $exp);
//     }

//     public function testFunctionRollTrue()
//     {
//         $diceHand = new DiceHand();
//         $dice = new DiceCheat();
//         $this->assertInstanceOf("\AreonL\Dice\DiceHand", $diceHand);

//         $trueDice = [true, false];
//         // Add two dices
//         $diceHand->addDice($dice);
//         $diceHand->addDice($dice);
//         $diceHand->rollTrue($trueDice);
//         $res = $diceHand->getSum();
//         $exp = 12;
//         $this->assertEquals($res, $exp);
//     }

//     public function testFunctionGetHand()
//     {
//         $diceHand = new DiceHand();
//         $dice = new DiceCheat();
//         $this->assertInstanceOf("\AreonL\Dice\DiceHand", $diceHand);

//         $diceHand->addDice($dice);
//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getHand();
//         $exp = "6 (cheating) 6 (cheating) <br>6, 6 = 12";
//         $this->assertEquals($res, $exp);
//     }

//     public function testFunctionGetComputer()
//     {
//         $diceHand = new DiceHand();
//         $dice = new DiceCheat();
//         $this->assertInstanceOf("\AreonL\Dice\DiceHand", $diceHand);

//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getComputer();
//         $exp = "6, ";
//         $this->assertEquals($res, $exp);

//         $diceHand->addDice($dice);
//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getComputer();
//         $exp = "6, 6, 6, ";
//         $this->assertEquals($res, $exp);
//     }

//     public function testFunctionGetSum()
//     {
//         $diceHand = new DiceHand();
//         $dice = new DiceCheat();
//         $this->assertInstanceOf("\AreonL\Dice\DiceHand", $diceHand);

//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getSum();
//         $exp = 6;
//         $this->assertEquals($res, $exp);

//         $diceHand->addDice($dice);
//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getSum();
//         $exp = 18;
//         $this->assertEquals($res, $exp);
//     }

//     public function testFunctionGetSumNumber()
//     {
//         $diceHand = new DiceHand();
//         $dice = new DiceCheat();
//         $this->assertInstanceOf("\AreonL\Dice\DiceHand", $diceHand);

//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getSumNumber(6);
//         $exp = 6;
//         $this->assertEquals($res, $exp);

//         $diceHand->addDice($dice);
//         $diceHand->roll();
//         $res = $diceHand->getSumNumber(6);
//         $exp = 12;
//         $this->assertEquals($res, $exp);
//     }
// }
