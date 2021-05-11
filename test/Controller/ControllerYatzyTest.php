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
 * Test cases for the controller YatzyController.
 */
class ControllerYatzyTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testReturnsResponse()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);

        $response = $this->get('/yatzy');

        $response->assertStatus(200);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testIndexFirstRollResponse()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);

        session([
            "firstRoll" => "firstRoll"
        ]);

        $response = $this->get('/yatzy');

        $response->assertStatus(200);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testIndexRollResponse()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);

        session([
            "roll" => "roll"
        ]);

        $response = $this->get('/yatzy');

        $response->assertStatus(200);
    }

    // /**
    //  * Check that the controller returns a response.
    //  */
    // public function testGameResponse()
    // {
    //     $controller = new YatzyController();
    //     $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);

    //     // $response = $this->json('POST', '/yatzy/game', ['roll', 'roll']);

    //     // $response->assertStatus(404);
    //     $res = $controller->game();
    //     $res->assertRedirect(201);
    // }

    /**
     * Check that the controller returns a response.
     */
    public function testCheckAllBoxes()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);

        session(['select1' => 'select1']);

        $exp = false;
        $res = $controller->checkAllBoxes();
        $this->assertEquals($exp, $res);

        session([
            'select1' => 'select1',
            "select2" => "select2",
            "select3" => "select3",
            "select4" => "select4",
            "select5" => "select5",
            "select6" => "select6"
        ]);

        $res = $controller->checkAllBoxes();
        $this->assertNotEquals($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testTrueRollInArray()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);

        session([
            "check" => [true, false, false, false, false]
        ]);

        $res = $controller->roll();
        $this->assertNotEmpty($res["dh"]);
        $this->assertNotNull($res["summa"]);
        $this->assertEquals(session("rollCounter"), 2);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testBonus()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);

        session([
            "summa" => 62,
            "bonus" => 0,
        ]);

        $controller->bonus();
        $res = session("bonus");
        $exp = 0;

        $this->assertEquals($res, $exp);

        session([
            "summa" => 63
        ]);

        $controller->bonus();
        $res = session("bonus");
        $exp = 50;
        $this->assertEquals($res, $exp);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testSelection()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $controller);

        $res = $this->selectionNumbers("1", $controller);
        $this->assertNotNull($res);

        $res = $this->selectionNumbers("2", $controller);
        $this->assertNotNull($res);

        $res = $this->selectionNumbers("3", $controller);
        $this->assertNotNull($res);

        $res = $this->selectionNumbers("4", $controller);
        $this->assertNotNull($res);

        $res = $this->selectionNumbers("5", $controller);
        $this->assertNotNull($res);

        $res = $this->selectionNumbers("6", $controller);
        $this->assertNotNull($res);

        $exp = ["0", "1", "2", "3", "4"];
        $this->assertEquals(session("check"), $exp);
    }

    /**
     * Mehod for testSelection
     */
    public function selectionNumbers($number, $controller)
    {
        session([
            "selection" => [(string)$number]
        ]);
        $controller->selection();
        return session("select" . (string)$number);
    }
}
