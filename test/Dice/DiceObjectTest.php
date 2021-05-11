<?php

namespace AreonL\Dice;

use PHPUnit\Framework\TestCase;

// /**
//  * Test cases for class Guess.
//  */
// class DiceObjectTest extends TestCase
// {
//     /**
//      * Construct object and verify that the object has the expected
//      * properties, use no arguments.
//      */
//     public function testCreateObject()
//     {
//         $dice = new Dice();
//         $this->assertInstanceOf("\AreonL\Dice\Dice", $dice);
//     }

//     /**
//      * Contruct object and make sure that an argument with diffrent faces
//      * is working.
//      */
//     public function testConstructMultipleFaces()
//     {
//         $dice = new Dice(100);
//         $this->assertInstanceOf("\AreonL\Dice\Dice", $dice);

//         $dice = new Dice(2);
//         $this->assertInstanceOf("\AreonL\Dice\Dice", $dice);
//     }

//     /**
//      * Test function roll multiple times
//      */
//     public function testFunctionRoll()
//     {
//         $dice = new Dice();
//         $this->assertInstanceOf("\AreonL\Dice\Dice", $dice);
//         $exp = [1,2,3,4,5,6];
//         $res = $dice->roll();
//         $this->assertContains($res, $exp);

//         $res = $dice->roll();
//         $this->assertContains($res, $exp);

//         $res = $dice->roll();
//         $this->assertContains($res, $exp);
//     }

//     public function testFunctionGetLastRoll()
//     {
//         $dice = new Dice();
//         $this->assertInstanceOf("\AreonL\Dice\Dice", $dice);

//         $exp = $dice->roll();
//         $res = $dice->getLastRoll();
//         $this->assertEquals($res, $exp);
//     }

//     public function testFunctionAsString()
//     {
//         $dice = new Dice();
//         $this->assertInstanceOf("\AreonL\Dice\Dice", $dice);

//         $res = $dice->asString();
//         $this->assertEmpty($res);

//         $dice->roll();
//         $res = $dice->asString();
//         $this->assertNotEmpty($res);
//     }
// }
