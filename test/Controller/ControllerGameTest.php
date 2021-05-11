<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use AreonL\Dice\{
    Dice,
    DiceHand,
    DiceGraphic
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Http\Request;

/**
 * Test cases for the controller Session.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testReturnsResponse()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);

        $response = $this->get('/game21');

        $response->assertStatus(200);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testIndexResetResponse()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);

        session([
            "reset" => true
        ]);

        $response = $this->get('/game21');

        $response->assertStatus(200);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testIndexRedoResponse()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);

        session([
            "redo" => true
        ]);

        $response = $this->get('/game21');

        $response->assertStatus(200);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testIndexEndResponse()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);

        session([
            "output" => 'end'
        ]);

        $response = $this->get('/game21');

        $response->assertStatus(200);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testIndexPlayGameResponse()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);

        // Make sure dices are in action, making the game playable
        session([
            "dices" => 1
        ]);

        $response = $this->get('/game21');
        $response->assertStatus(200);

        session([
            "dices" => 2
        ]);

        $response = $this->get('/game21');
        $response->assertStatus(200);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testCheckScoreFunction()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);
        // sum = null | No one gains points
        session([
            "sum" => null
        ]);

        $controller->checkScore();
        $res = session('pScore');
        $exp = 0;
        $this->assertEquals($res, $exp);
        $res = session('cScore');
        $this->assertEquals($res, $exp);

        // sum = 21 | Player wins
        session([
            "sum" => 21
        ]);

        $controller->checkScore();
        $res = session('pScore');
        $exp = 1;
        $this->assertEquals($res, $exp);
        $exp = 0;
        $res = session('cScore');
        $this->assertEquals($res, $exp);

        // sum > 21 | Computer wins
        session([
            "sum" => 22
        ]);

        $controller->checkScore();
        $res = session('pScore');
        $exp = 1;
        $this->assertEquals($res, $exp);
        $res = session('cScore');
        $this->assertEquals($res, $exp);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testEndFunction()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);
        $controller->setUp();

        session(['dices' => 2, 'testSum' => 0]);
        $controller->end();
    }

    /**
     * Check that the controller returns a response.
     */
    public function testEndFunctionComputerWinLose()
    {
        $controller = new GameController();
        $this->assertInstanceOf("App\Http\Controllers\GameController", $controller);
        $controller->setUp();

        session(['dices' => 1, 'testSum' => -1]);
        $controller->end();
        $res = session('cLose');
        $this->assertEquals($res, 'cLose');
    }
}
