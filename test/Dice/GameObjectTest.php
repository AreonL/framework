<?php

namespace AreonL\Dice;

use PHPUnit\Framework\TestCase;

// /**
//  * Test cases for class Guess.
//  */
// class GameObjectTest extends TestCase
// {
//     /**
//      * Construct object and verify that the object has the expected
//      * properties, use no arguments.
//      */
//     public function testCreateObject()
//     {
//         $game = new Game();
//         $this->assertInstanceOf("\AreonL\Dice\Game", $game);
//     }

//     public function testFunctionSetUp()
//     {
//         $game = new Game();
//         $this->assertInstanceOf("\AreonL\Dice\Game", $game);

//         $exp = "\Psr\Http\Message\ResponseInterface";
//         $res = $game->setUp();
//         $this->assertNotNull($_SESSION["sum"]);
//         $this->assertNull($_SESSION["win"]);
//         $this->assertNull($_SESSION["lose"]);
//         $this->assertNotNull($_SESSION["pScore"]);
//         $this->assertNotNull($_SESSION["cScore"]);
//         $this->assertInstanceOf($exp, $res);
//     }

//     public function testFunctionPlayGame()
//     {
//         $game = new Game();
//         $this->assertInstanceOf("\AreonL\Dice\Game", $game);

//         $game->setUp();
//         $exp = "\Psr\Http\Message\ResponseInterface";
//         $res = $game->playGame();
//         $this->assertInstanceOf($exp, $res);
//     }

//     public function testPlayGameTwoDices()
//     {
//         $game = new Game();
//         $this->assertInstanceOf("\AreonL\Dice\Game", $game);

//         $game->setUp();
//         $_SESSION["dices"] = "2";
//         $exp = "\Psr\Http\Message\ResponseInterface";
//         $res = $game->playGame();
//         $this->assertInstanceOf($exp, $res);
//     }

//     public function testFunctionCheckScore()
//     {
//         $game = new Game();
//         $this->assertInstanceOf("\AreonL\Dice\Game", $game);

//         $game->setUp();
//         $_SESSION["sum"] = 21;
//         $game->checkScore();
//         $exp = 1;
//         $res = $_SESSION["pScore"];
//         $this->assertEquals($res, $exp);

//         $_SESSION["sum"] = 22;
//         $game->checkScore();
//         $exp = 1;
//         $res = $_SESSION["cScore"];
//         $this->assertEquals($res, $exp);
//     }

//     public function testFunctionEnd()
//     {
//         $game = new Game();
//         $this->assertInstanceOf("\AreonL\Dice\Game", $game);

//         $game->setUp();

//         $exp = "\Psr\Http\Message\ResponseInterface";
//         $res = $game->end();
//         $this->assertInstanceOf($exp, $res);
//     }

//     public function testEndComputer()
//     {
//         $game = new Game();
//         $this->assertInstanceOf("\AreonL\Dice\Game", $game);

//         $game->setUp();

//         $_SESSION["testSum"] = -1;
//         $game->end();
//         $exp = 1;
//         $res = $_SESSION["pScore"];
//         $this->assertEquals($exp, $res);

//         $_SESSION["testSum"] = 0;
//         $game->end();
//         $exp = 1;
//         $res = $_SESSION["cScore"];
//         $this->assertEquals($exp, $res);
//     }

//     public function testFunctionRedo()
//     {
//         $game = new Game();
//         $this->assertInstanceOf("\AreonL\Dice\Game", $game);

//         $game->setUp();

//         $exp = "\Psr\Http\Message\ResponseInterface";
//         $res = $game->redo();
//         $this->assertInstanceOf($exp, $res);
//         $this->assertEquals($_SESSION["sum"], 0);
//         $this->assertNull($_SESSION["win"]);
//         $this->assertNull($_SESSION["lose"]);
//     }
// }
