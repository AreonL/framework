<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use AreonL\Dice\{
    Dice,
    DiceHand,
    DiceGraphic
};
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
// use Tests\TestCase;

/**
 * Test cases for the controller Yatzy.
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
    public function testIndexReturnsResponse()
    {
        $controller = new YatzyController();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->index(null);
        var_dump($res);
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testIndexFirstRollResponse()
    {
        $controller = new Yatzy();

        $_SESSION = [
            "firstRoll" => "firstRoll"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->index();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testIndexRollResponse()
    {
        $controller = new Yatzy();

        $_SESSION = [
            "roll" => "roll"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->index();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testCheckAllBoxes()
    {
        $controller = new Yatzy();

        $_SESSION = [
            "select1" => "select1"
        ];

        $exp = false;
        $res = $controller->checkAllBoxes();
        $this->assertEquals($exp, $res);

        $_SESSION = [
            "select1" => "select1",
            "select2" => "select2",
            "select3" => "select3",
            "select4" => "select4",
            "select5" => "select5",
            "select6" => "select6"
        ];

        $res = $controller->checkAllBoxes();
        $this->assertNotEquals($exp, $res);
    }

        /**
     * Check that the controller returns a response.
     */
    public function testGameResponse()
    {
        $controller = new Yatzy();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->game();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testTrueRollInArray()
    {
        $controller = new Yatzy();

        $_SESSION = [
            "check" => [true, false, false, false, false]
        ];

        $res = $controller->roll();
        $this->assertNotEmpty($res["dh"]);
        $this->assertNotNull($res["summa"]);
        $this->assertEquals($_SESSION["rollCounter"], 2);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testBonus()
    {
        $controller = new Yatzy();

        $_SESSION = [
            "summa" => 62,
            "bonus" => 0,
        ];

        $controller->bonus();
        $res = $_SESSION["bonus"];
        $exp = 0;

        $this->assertEquals($res, $exp);

        $_SESSION = [
            "summa" => 63
        ];

        $controller->bonus();
        $res = $_SESSION["bonus"];
        $exp = 50;
        $this->assertEquals($res, $exp);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testSelection()
    {
        $controller = new Yatzy();

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
        $this->assertEquals($_SESSION["check"], $exp);
    }

    /**
     * Mehod for testSelection
     */
    public function selectionNumbers($number, $controller)
    {
        $_SESSION = [
            "selection" => [(string)$number]
        ];
        $controller->selection();
        return $_SESSION["select" . (string)$number];
    }
}
