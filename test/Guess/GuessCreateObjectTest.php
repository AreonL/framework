<?php

// namespace Mos\Guess;

// use PHPUnit\Framework\TestCase;

// /**
//  * Test cases for class Guess.
//  */
// class GuessCreateObjectTest extends TestCase
// {
//     /**
//      * Construct object and verify that the object has the expected
//      * properties, use no arguments.
//      */
//     public function testCreateObjectNoArguments()
//     {
//         $guess = new Guess();
//         $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

//         $res = $guess->tries();
//         $exp = 6;
//         $this->assertEquals($exp, $res);
//     }



//     /**
//      * Construct object and verify that the object has the expected
//      * properties, use only first argument.
//      */
//     public function testCreateObjectFirstArgument()
//     {
//         $guess = new Guess(42);
//         $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

//         $res = $guess->tries();
//         $exp = 6;
//         $this->assertEquals($exp, $res);

//         $res = $guess->number();
//         $exp = 42;
//         $this->assertEquals($exp, $res);
//     }



//     /**
//      * Construct object and verify that the object has the expected
//      * properties, use both arguments.
//      */
//     public function testCreateObjectBothArguments()
//     {
//         $guess = new Guess(42, 7);
//         $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

//         $res = $guess->tries();
//         $exp = 7;
//         $this->assertEquals($exp, $res);

//         $res = $guess->number();
//         $exp = 42;
//         $this->assertEquals($exp, $res);
//     }

//     /**
//      * Construct object and verify that the object has the expected
//      * properties, use both arguments.
//      */
//     public function testMakeGuessNormal()
//     {
//         $guess = new Guess(42, 7);
//         $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

//         $res = $guess->makeGuess(50);
//         $exp = "to high...";
//         $this->assertEquals($exp, $res);

//         $res = $guess->makeGuess(40);
//         $exp = "to low...";
//         $this->assertEquals($exp, $res);

//         $res = $guess->makeGuess(42);
//         $exp = "correct!!!";
//         $this->assertEquals($exp, $res);
//     }

//     public function testMakeGuessNoTries()
//     {
//         $guess = new Guess(42, 0);
//         $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

//         $res = $guess->makeGuess(42);
//         $exp = "no guesses left.";
//         $this->assertEquals($exp, $res);
//     }

//     public function testMakeGuessException()
//     {
//         $guess = new Guess(42, 7);
//         $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

//         $this->expectException(GuessException::class);

//         $guess->makeGuess(200);
//         $guess->makeGuess(0);
//     }
// }
